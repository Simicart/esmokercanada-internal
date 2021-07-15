<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\External\Save;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\External\Save
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\TransferStock\External\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magestore\InventorySuccess\Model\ResourceModel\TransferStock\TransferStockProductFactory $transferStockProductResourceFactory, \Magestore\InventorySuccess\Model\TransferStock\TransferActivityProductFactory $transferActivityProductFactory, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone, \Magento\Backend\Model\Auth\Session $adminSession, \Magestore\InventorySuccess\Model\TransferStock\Email\EmailNotificationFactory $emailNotificationFactory)
    {
        $this->___init();
        parent::__construct($context, $transferStockProductResourceFactory, $transferActivityProductFactory, $timezone, $adminSession, $emailNotificationFactory);
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
