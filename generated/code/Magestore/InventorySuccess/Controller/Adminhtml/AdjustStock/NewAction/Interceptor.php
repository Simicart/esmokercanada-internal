<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\AdjustStock\NewAction;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\AdjustStock\NewAction
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\AdjustStock\NewAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Framework\Module\Manager $moduleManager, \Magestore\InventorySuccess\Api\Helper\SystemInterface $systemHelper, \Magestore\InventorySuccess\Api\AdjustStock\AdjustStockManagementInterface $adjustStockManagement, \Magestore\InventorySuccess\Model\AdjustStockFactory $adjustStockFactory, \Magestore\InventorySuccess\Model\ResourceModel\AdjustStock $adjustStockResource, \Magestore\InventorySuccess\Api\StockActivity\StockChangeInterface $stockChange, \Magento\Backend\Model\Auth\Session $adminSession, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\File\Csv $csvProcessor, \Magento\Framework\Filesystem\File\WriteFactory $fileWriteFactory, \Magento\Framework\Filesystem\Driver\File $driverFile, \Magestore\InventorySuccess\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($context, $moduleManager, $systemHelper, $adjustStockManagement, $adjustStockFactory, $adjustStockResource, $stockChange, $adminSession, $fileFactory, $filesystem, $csvProcessor, $fileWriteFactory, $driverFile, $helper);
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
