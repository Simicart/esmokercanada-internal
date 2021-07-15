<?php
namespace Magestore\Customercredit\Controller\Index\Sendemail;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Index\Sendemail
 */
class Interceptor extends \Magestore\Customercredit\Controller\Index\Sendemail implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magestore\Customercredit\Helper\Account $accountHelper, \Magestore\Customercredit\Model\CustomercreditFactory $customercreditFactory, \Magento\Customer\Model\Session $customersesion)
    {
        $this->___init();
        parent::__construct($context, $accountHelper, $customercreditFactory, $customersesion);
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
