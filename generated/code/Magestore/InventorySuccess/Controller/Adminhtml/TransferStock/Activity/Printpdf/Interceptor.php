<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Activity\Printpdf;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Activity\Printpdf
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\Activity\Printpdf implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magestore\InventorySuccess\Model\ResourceModel\TransferStock\TransferActivityProduct\CollectionFactory $_collection, \Magento\Framework\File\Csv $csvProcessor, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Stdlib\StringUtils $string)
    {
        $this->___init();
        parent::__construct($context, $_collection, $csvProcessor, $fileFactory, $filesystem, $string);
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
