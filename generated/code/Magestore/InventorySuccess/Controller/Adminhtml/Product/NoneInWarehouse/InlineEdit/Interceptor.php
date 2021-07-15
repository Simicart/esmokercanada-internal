<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\Product\NoneInWarehouse\InlineEdit;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\Product\NoneInWarehouse\InlineEdit
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\Product\NoneInWarehouse\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Cms\Api\PageRepositoryInterface $pageRepository, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory)
    {
        $this->___init();
        parent::__construct($context, $pageRepository, $jsonFactory);
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
