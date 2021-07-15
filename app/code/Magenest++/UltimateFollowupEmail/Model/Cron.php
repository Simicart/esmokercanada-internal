<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 30/09/2015
 * Time: 15:32
 */

namespace Magenest\UltimateFollowupEmail\Model;

use Psr\Log\LoggerInterface as Logger;

class Cron
{
    const XML_PATH_ENABLE = 'ultimatefollowupemail/mandrill/enable';

    protected $birthdayModel;

    protected $abandonedCartModel;

    protected $logger;

    protected $mailFactory;

    /**
     * @var SmsFactory
     */
    protected $smsFactory;

    protected $notificationFactory;

    protected $helper;

    /**
     * @var Processor\WishlistReminder
     */
    protected $wishlistReminder;


    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\Processor\Birthday $birthdayProcessors,
        Logger $loggerInterface,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        \Magenest\UltimateFollowupEmail\Model\NotificationFactory $notificationFactory,
        \Magenest\UltimateFollowupEmail\Helper\Connector $helper,
        \Magenest\UltimateFollowupEmail\Model\Processor\AbandonedCart $abandonedCart,
        \Magenest\UltimateFollowupEmail\Model\Processor\WishlistReminder $wishlistReminder
    ) {
        $this->birthdayModel      = $birthdayProcessors;
        $this->abandonedCartModel = $abandonedCart;
        $this->wishlistReminder = $wishlistReminder;

        $this->mailFactory = $mailFactory;
        $this->smsFactory  = $smsFactory;

        $this->helper              = $helper;
        $this->logger              = $loggerInterface;
        $this->notificationFactory = $notificationFactory;
    }//end __construct()


    /**
     * invoke both hourly and daily. it is useful for testing purpose
     */
    public function collectMail()
    {
        $this->collectAbandonedCarts();
        $this->collectBirthDayMails();
    }//end emulate()


    /**
     * collect the abandoned cart
     */
    public function collectAbandonedCarts()
    {
        $this->abandonedCartModel->run();
    }//end hourly()


    public function collectBirthDayMails()
    {
        $this->birthdayModel->run();
    }//end daily()

    public function collectWishlistReminderMails()
    {
        $this->wishlistReminder->run();
    }//end daily()

    /**
     * send email to notify the customer about updated item
     */
    public function updateItem()
    {
        $obj =  \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magenest\UltimateFollowupEmail\Model\Processor\Downloadable $processor */
        $processor =  $obj->create('Magenest\UltimateFollowupEmail\Model\Processor\Downloadable');
        $processor->run();
    }


    public function sendScheduledMail()
    {
        $enableMandrill = $this->helper->getEnableMandrill();
        $mailCollection = $this->mailFactory->create()->getCollection()->getMailsNeedToBeSent();

        if ($mailCollection->getSize() > 0) {
            /** @var  $mail \Magenest\UltimateFollowupEmail\Model\Mail */
            foreach ($mailCollection as $mail) {
                // push the mail to the notification box of customer
                $now = (new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);

                $notification = $this->notificationFactory->create()->setData(
                    [
                     'mail_id'         => $mail->getId(),
                     'severity'        => '0',
                     'is_read'         => 0,
                     'is_trash'        => 0,
                     'store_id'        => 0,
                     'recipient_email' => $mail->getData('recipient_email'),
                     'subject'         => $mail->getData('subject'),
                     'send_date'       => $now,
                    ]
                )->save();

                if ($enableMandrill) {
                    // send email via mandrill
                    $this->helper->sendEmail($mail);
                } else {
                    $mail->send();
                }

                // if enable nexmo then send information via nexmo
            }//end foreach
        }//end if
    }//end sendScheduledMail()


    /**
     * Schedule send SMS message using NexMo service
     */
    public function scheduleSendSMS()
    {
        $smsCollection = $this->smsFactory->create()->getCollection()->getSmsNeedToBeSent();

        if ($smsCollection->getSize() > 0) {
            /*
                * @var $sms \Magenest\UltimateFollowupEmail\Model\Sms
            */
            foreach ($smsCollection as $sms) {
                try {
                    $sms->send();
                } catch (\Exception $e) {
                    $this->logger->critical($e->getMessage());
                }
            }
        }
    }//end scheduleSendSMS()
}//end class
