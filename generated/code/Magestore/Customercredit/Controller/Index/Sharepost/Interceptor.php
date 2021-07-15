<?php
namespace Magestore\Customercredit\Controller\Index\Sharepost;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Index\Sharepost
 */
class Interceptor extends \Magestore\Customercredit\Controller\Index\Sharepost implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magestore\Customercredit\Helper\Account $accountHelper, \Magestore\Customercredit\Helper\Data $creditHelper, \Magento\Customer\Model\Session $customerSession, \Magestore\Customercredit\Model\CustomercreditFactory $customercreditFactory, \Magestore\Customercredit\Model\TransactionFactory $transactionFactory, \Magestore\Customercredit\Model\CreditcodeFactory $creditcodeFactory, \Magento\Customer\Model\CustomerFactory $customerFactory)
    {
        $this->___init();
        parent::__construct($context, $accountHelper, $creditHelper, $customerSession, $customercreditFactory, $transactionFactory, $creditcodeFactory, $customerFactory);
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
