<?php
namespace Magestore\InventorySuccess\Controller\LowStockNotification\Download;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\LowStockNotification\Download
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\LowStockNotification\Download implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magestore\InventorySuccess\Model\ResourceModel\LowStockNotification\Notification\Product\CollectionFactory $productCollectionFactory, \Magestore\InventorySuccess\Model\ResourceModel\LowStockNotification\Notification\CollectionFactory $notificationCollectionFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\App\Response\Http\FileFactory $fileFactory)
    {
        $this->___init();
        parent::__construct($context, $productCollectionFactory, $notificationCollectionFactory, $filesystem, $fileFactory);
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
