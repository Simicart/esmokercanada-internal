<?php
namespace Magento\CatalogInventory\Observer\QuantityValidatorObserver;

/**
 * Interceptor class for @see \Magento\CatalogInventory\Observer\QuantityValidatorObserver
 */
class Interceptor extends \Magento\CatalogInventory\Observer\QuantityValidatorObserver implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\CatalogInventory\Model\Quote\Item\QuantityValidator $quantityValidator)
    {
        $this->___init();
        parent::__construct($quantityValidator);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($observer);
    }
}
