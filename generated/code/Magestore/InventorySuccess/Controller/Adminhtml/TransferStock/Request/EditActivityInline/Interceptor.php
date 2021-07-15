<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Request\EditActivityInline;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Request\EditActivityInline
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Request\EditActivityInline implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Magestore\InventorySuccess\Model\Locator\LocatorFactory $locatorFactory, \Magestore\InventorySuccess\Model\TransferStock\TransferActivityProductFactory $transferActivityProductFactory, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone, \Magento\Backend\Model\Auth\Session $adminSession)
    {
        $this->___init();
        parent::__construct($context, $jsonFactory, $locatorFactory, $transferActivityProductFactory, $productFactory, $timezone, $adminSession);
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
