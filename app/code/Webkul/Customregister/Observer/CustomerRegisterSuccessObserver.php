<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Customregister
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\Customregister\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Webkul Customregister CustomerRegisterSuccessObserver Observer.
 */
class CustomerRegisterSuccessObserver implements ObserverInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $_messageManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface   $objectManager
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Store\Model\StoreManagerInterface  $storeManager
     * @param \Magento\Framework\Message\ManagerInterface $messageManager,
     * @param CollectionFactory                           $collectionFactory
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        CustomerRepositoryInterface $customerRepository,
        CustomerInterfaceFactory $customerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Magento\Customer\Model\Customer\Mapper $customerMapper
    ) {
        $this->_objectManager = $objectManager;
        $this->_storeManager = $storeManager;
        $this->_messageManager = $messageManager;
        $this->_responseFactory = $responseFactory;
        $this->_customerRepository = $customerRepository;
        $this->_customerMapper = $customerMapper;
        $this->_customerDataFactory = $customerDataFactory;
        $this->_dataObjectHelper = $dataObjectHelper;
    }

    /**
     * customer register event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $data = $observer['account_controller'];
        try {
            $paramData = $data->getRequest()->getParams();
            $customer = $observer->getCustomer();
            $customerId = $customer->getId();
            $message = __('Thank you for registering with %1.', $this->_storeManager->getStore()->getFrontendName());
            if(isset($paramData['wk_custom_register'])){
              if($paramData['wk_custom_register'] == 1 && !empty($paramData['wk_custom_register'])){
                 $savedCustomerData = $this->_customerRepository->getById($customerId);
                 $_customer = $this->_customerDataFactory->create();
                  $paramData = array_merge(
                      $this->_customerMapper->toFlatArray($savedCustomerData),
                      $paramData
                  );
                  $paramData['id'] = $customerId;
                  $this->_dataObjectHelper->populateWithArray(
                      $_customer,
                      $paramData,
                      '\Magento\Customer\Api\Data\CustomerInterface'
                  );
                  //save customer
                 $this->_customerRepository->save($_customer);
                 $this->_messageManager->addSuccess($message);
                 $this->_responseFactory->create()->setRedirect($paramData['success_url'])->sendResponse();
                 exit();
              }
           }
        } catch (\Exception $e) {
            $this->_messageManager->addError($e->getMessage());
        }
    }

}
