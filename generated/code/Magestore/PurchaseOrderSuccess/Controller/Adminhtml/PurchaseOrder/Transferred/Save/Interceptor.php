<?php
namespace Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Transferred\Save;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Transferred\Save
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Transferred\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\PurchaseOrderSuccess\Controller\Adminhtml\Context $context, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\PurchaseOrderService $purchaseOrderService, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\Item\Transferred\TransferredService $transferredService, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->___init();
        parent::__construct($context, $purchaseOrderService, $transferredService, $timezone);
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
