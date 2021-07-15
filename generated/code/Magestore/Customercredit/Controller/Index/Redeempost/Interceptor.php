<?php
namespace Magestore\Customercredit\Controller\Index\Redeempost;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Index\Redeempost
 */
class Interceptor extends \Magestore\Customercredit\Controller\Index\Redeempost implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Customer\Model\Session $customerSession, \Magestore\Customercredit\Model\CreditcodeFactory $creditcodeFactory, \Magestore\Customercredit\Model\CustomercreditFactory $customercreditFactory, \Magestore\Customercredit\Model\TransactionFactory $transactionFactory)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $customerSession, $creditcodeFactory, $customercreditFactory, $transactionFactory);
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
