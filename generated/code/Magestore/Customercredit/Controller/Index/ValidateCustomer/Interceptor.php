<?php
namespace Magestore\Customercredit\Controller\Index\ValidateCustomer;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Index\ValidateCustomer
 */
class Interceptor extends \Magestore\Customercredit\Controller\Index\ValidateCustomer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Customer\Model\Session $customerSession, \Magento\Customer\Model\CustomerFactory $customer, \Magestore\Customercredit\Helper\Account $accountHelper, \Magestore\Customercredit\Helper\Data $creditHelper, \Magestore\Customercredit\Model\CreditcodeFactory $creditcode, \Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $customerSession, $customer, $accountHelper, $creditHelper, $creditcode, $storeManager);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}