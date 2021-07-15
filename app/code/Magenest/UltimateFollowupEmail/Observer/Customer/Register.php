<?php
namespace Magenest\UltimateFollowupEmail\Observer\Customer;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Logger;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class Register extends \Magenest\UltimateFollowupEmail\Model\Processor\UltimateFollowupEmail implements ObserverInterface
{

    protected $type = 'customer_registration';


    /**
     * Handler for 'customer_logout' event.
     *
     * @param  Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            /** @var  $customer \Magento\Customer\Model\Data\Customer */
            $customer = $observer->getEvent()->getCustomer();
            $customer = ObjectManager::getInstance()->create(Customer::class)->setData($customer->__toArray());
            $firstName = $customer->getFirstname();
            $lastName = $customer->getLastname();
            $customerEmail = $customer->getEmail();

            $customer->getGender();

            $this->_emailTarget = $customer;

            // Set data used to send email
            $this->_emailTarget->setData('customer_email', $customerEmail);
            $this->_emailTarget->setData('customer_firstname', $firstName);
            $this->_emailTarget->setData('customer_lastname', $lastName);
            $this->run();
        } catch (\Exception $e) {
            ObjectManager::getInstance()->get(LoggerInterface::class)->critical($e);
        }
    }

    public function run()
    {
        $this->createFollowUpEmail();
    }

    public function isValidate($rule)
    {
        $isValidate = false;

        $customer = $this->_emailTarget;
        if ($customer instanceof \Magento\Customer\Model\Customer) {
            $isValidate = $this->validateCustomerGroupAndWebsite($customer->getGroupId(), $customer->getWebsiteId());
        }
        if ($isValidate) {
            $gender    = $this->_emailTarget->getGender();
            $condition = unserialize($this->_activeRule->getConditionsSerialized());

            if ($condition['gender']) {
                if ($gender == $condition['gender']) {
                    $isValidate = true;
                } else {
                    $isValidate = false;
                }
            }
        }

        return $isValidate;
    }


    public function prepareMail()
    {
        if (!$this->_activeMail) {
            return;
        }

        $this->_vars = [
                        'customerFistName' => $this->_emailTarget->getFirstname(),
                        'customerLastName' => $this->_emailTarget->getLastname(),
                        'customerName'     => $this->_emailTarget->getFirstname().' '.$this->_emailTarget->getLastname(),
                       ];
    }


    public function postCreateMail()
    {
    }
}
