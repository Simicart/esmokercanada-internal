<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\Stocktaking\Cancel;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\Stocktaking\Cancel
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\Stocktaking\Cancel implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Framework\Module\Manager $moduleManager, \Magestore\InventorySuccess\Api\Helper\SystemInterface $systemHelper, \Magestore\InventorySuccess\Api\Stocktaking\StocktakingManagementInterface $stocktakingManagement, \Magestore\InventorySuccess\Model\StocktakingFactory $stocktakingFactory, \Magestore\InventorySuccess\Model\ResourceModel\Stocktaking $stocktakingResource, \Magestore\InventorySuccess\Api\StockActivity\StockChangeInterface $stockChange, \Magento\Backend\Model\Auth\Session $adminSession, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\File\Csv $csvProcessor)
    {
        $this->___init();
        parent::__construct($context, $moduleManager, $systemHelper, $stocktakingManagement, $stocktakingFactory, $stocktakingResource, $stockChange, $adminSession, $fileFactory, $filesystem, $csvProcessor);
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
