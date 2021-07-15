<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\LowStockNotification\Notification\Index;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\LowStockNotification\Notification\Index
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\LowStockNotification\Notification\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magestore\InventorySuccess\Model\ResourceModel\LowStockNotification\Rule\ProductFactory $ruleProductResourceFactory, \Magento\Framework\App\Response\Http\FileFactory $fileFactory)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $resultLayoutFactory, $resultForwardFactory, $coreRegistry, $dateFilter, $dataPersistor, $ruleProductResourceFactory, $fileFactory);
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
