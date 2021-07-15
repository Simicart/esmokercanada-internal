<?php
namespace Magestore\Customercredit\Controller\Index\VerifySender;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Index\VerifySender
 */
class Interceptor extends \Magestore\Customercredit\Controller\Index\VerifySender implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Customer\Model\Session $customerSession, \Magento\Customer\Model\CustomerFactory $customer, \Magestore\Customercredit\Helper\Account $accountHelper, \Magestore\Customercredit\Helper\Data $creditHelper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magestore\Customercredit\Model\CustomercreditFactory $customercredit)
    {
        $this->___init();
        parent::__construct($context, $customerSession, $customer, $accountHelper, $creditHelper, $storeManager, $customercredit);
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
