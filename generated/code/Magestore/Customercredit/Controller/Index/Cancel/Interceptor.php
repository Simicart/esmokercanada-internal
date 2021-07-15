<?php
namespace Magestore\Customercredit\Controller\Index\Cancel;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Index\Cancel
 */
class Interceptor extends \Magestore\Customercredit\Controller\Index\Cancel implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magestore\Customercredit\Helper\Account $accountHelper, \Magestore\Customercredit\Model\CustomercreditFactory $customercredit, \Magento\Customer\Model\Session $customersesion, \Magestore\Customercredit\Model\CreditcodeFactory $creditcode, \Magestore\Customercredit\Model\TransactionFactory $transaction)
    {
        $this->___init();
        parent::__construct($context, $accountHelper, $customercredit, $customersesion, $creditcode, $transaction);
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
