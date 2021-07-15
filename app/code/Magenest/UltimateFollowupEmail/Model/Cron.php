<?php
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

    protected $mandrillConnector;

    /**
     * @var Processor\WishlistReminder
     */
    protected $wishlistReminder;


    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\Processor\Birthday $birthdayProcessors,
        Logger $loggerInterface,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        \Magenest\UltimateFollowupEmail\Helper\MandrillConnector $mandrillConnector,
        \Magenest\UltimateFollowupEmail\Model\Processor\AbandonedCart $abandonedCart,
        \Magenest\UltimateFollowupEmail\Model\Processor\WishlistReminder $wishlistReminder
    ) {
        $this->birthdayModel = $birthdayProcessors;
        $this->abandonedCartModel = $abandonedCart;
        $this->wishlistReminder = $wishlistReminder;
        $this->mailFactory = $mailFactory;
        $this->smsFactory = $smsFactory;
        $this->mandrillConnector = $mandrillConnector;
        $this->logger = $loggerInterface;
    }


    public function collectMail()
    {
        $this->collectAbandonedCarts();
        $this->collectBirthDayMails();
    }

    public function collectAbandonedCarts()
    {
        $this->abandonedCartModel->run();
    }


    public function collectBirthDayMails()
    {
        $this->birthdayModel->run();
    }

    public function collectWishlistReminderMails()
    {
        $this->wishlistReminder->run();
    }

    /**
     * send email to notify the customer about updated item
     */
    public function updateItem()
    {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magenest\UltimateFollowupEmail\Model\Processor\Downloadable $processor */
        $processor = $obj->create('Magenest\UltimateFollowupEmail\Model\Processor\Downloadable');
        $processor->run();
    }


    public function sendScheduledMail()
    {
        $enableMandrill = $this->mandrillConnector->getEnableMandrill();
        $mailCollection = $this->mailFactory->create()->getCollection()->getMailsNeedToBeSent();

        if ($mailCollection->getSize() > 0) {
            if ($enableMandrill) {
                $this->mandrillConnector->sendEmails($mailCollection);
            } else {
                /** @var  $mail \Magenest\UltimateFollowupEmail\Model\Mail */
                foreach ($mailCollection as $mail) {
                    $mail->send();
                }
            }
        }
    }


    /**
     * Schedule send SMS message using NexMo service
     */
    public function scheduleSendSMS()
    {
        $smsCollection = $this->smsFactory->create()->getCollection()->getSmsNeedToBeSent();

        if ($smsCollection->getSize() > 0) {
            /** @var $sms \Magenest\UltimateFollowupEmail\Model\Sms */
            foreach ($smsCollection as $sms) {
                $sms->send();
            }
        }
    }
}
