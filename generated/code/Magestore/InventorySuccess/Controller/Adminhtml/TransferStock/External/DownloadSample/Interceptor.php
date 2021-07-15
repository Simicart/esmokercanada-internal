<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\External\DownloadSample;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\External\DownloadSample
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\External\DownloadSample implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Framework\File\Csv $csvProcessor, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Filesystem\File\WriteFactory $fileWriteFactory, \Magento\Framework\Filesystem\Driver\File $driverFile)
    {
        $this->___init();
        parent::__construct($context, $csvProcessor, $fileFactory, $filesystem, $fileWriteFactory, $driverFile);
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
