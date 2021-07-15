<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Activity\View;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Activity\View
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Activity\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Framework\Module\Manager $moduleManager, \Magento\Backend\Model\Auth\Session $adminSession, \Magestore\InventorySuccess\Model\Locator\LocatorFactory $locatorFactory)
    {
        $this->___init();
        parent::__construct($context, $moduleManager, $adminSession, $locatorFactory);
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
