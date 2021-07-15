<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 15/02/2017
 * Time: 18:32
 */
namespace Magenest\UltimateFollowupEmail\Controller\Capture;

class Guest extends \Magento\Framework\App\Action\Action
{

    protected $context;

    protected $checkoutSession;

    protected $logger;

    protected $date;

    protected $guestFactory;

    protected $timezone;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magenest\UltimateFollowupEmail\Model\GuestFactory $guestFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
    
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->date = $date;

        $this->timezone = $timezone;

        $this->guestFactory = $guestFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();

        if (isset($params['email'])) {
            $email = $params['email'];

            $quoteIdHash = $params['quote_id'];

            $quoteId = $this->checkoutSession->getQuoteId();



            //whether the abandoned cart record exist

            $isAbandonedCartExist = false;

            $cartCollection = $this->guestFactory->create()->getCollection()->addFieldToFilter('quote_id', $quoteId);


            if ($cartCollection->getSize() > 0) {
                $isAbandonedCartExist = true;
            }

            if (!$isAbandonedCartExist) {
                $this->guestFactory->create()->setData(['email' => $email, 'quote_id' => $quoteId])->save();
            } else {
                $abandonedCart = $cartCollection->getFirstItem();
                $abandonedCart->addData(['email' => $email])->save();
            }
        }
    }
}
