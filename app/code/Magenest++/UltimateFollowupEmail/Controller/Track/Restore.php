<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 23/10/2015
 * Time: 10:38
 */

namespace Magenest\UltimateFollowupEmail\Controller\Track;

use Magenest\UltimateFollowupEmail\Controller\Track as TrackController;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Encryption\Encryptor;

class Restore extends TrackController
{

    protected $checkoutSession;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    protected $_urlBuilder;

    protected $_encryptor;

    protected $customerFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Customer\Model\Session $customerSession,
        CustomerFactory $customerFactory,
        Encryptor $encryptor
    ) {
    
        parent::__construct($context, $checkoutSession, $customerSession);
        $this->_encryptor = $encryptor;
        $this->customerFactory = $customerFactory;
    }


    public function execute()
    {
        $resumeRequest = $this->getRequest()->getParam('utc');
        $userAutoLoginKey = base64_decode($this->getRequest()->getParam('u'));

        $cartId = $resumeRequest;

        $quote = $this->_objectManager->create('Magento\Quote\Model\Quote')->load($cartId);

        if (!$this->checkoutSession) {
            $this->checkoutSession = $this->_objectManager->create('\Magento\Checkout\Model\Session');
        }

        //customer autologin
        if ($userAutoLoginKey) {
            if (!$this->customerSession->isLoggedIn()) {
                $customerKey = $this->_encryptor->decrypt($userAutoLoginKey);
                $customerId = substr($customerKey, 0, 1);
                $customerEmail = substr($customerKey, 1);
                $customer = $this->customerFactory->create()->load($customerId);
                if ($customer->getId() && $customer->getEmail() === $customerEmail) {
                    $this->customerSession->setCustomerAsLoggedIn($customer);
                }
            }
        }
        //
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $this->checkoutSession->replaceQuote($quote);
        $resultRedirect->setPath('checkout/cart/index');
        return $resultRedirect;
    }//end executes()
}//end class
