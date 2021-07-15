<?php
namespace Magento\InventorySales\Model\IsProductSalableCondition\IsProductSalableConditionChain;

/**
 * Interceptor class for @see \Magento\InventorySales\Model\IsProductSalableCondition\IsProductSalableConditionChain
 */
class Interceptor extends \Magento\InventorySales\Model\IsProductSalableCondition\IsProductSalableConditionChain implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(array $conditions)
    {
        $this->___init();
        parent::__construct($conditions);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(string $sku, int $stockId) : bool
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($sku, $stockId);
    }
}
