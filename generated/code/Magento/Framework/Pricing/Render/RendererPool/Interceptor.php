<?php
namespace Magento\Framework\Pricing\Render\RendererPool;

/**
 * Interceptor class for @see \Magento\Framework\Pricing\Render\RendererPool
 */
class Interceptor extends \Magento\Framework\Pricing\Render\RendererPool implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function createAmountRender(\Magento\Framework\Pricing\Amount\AmountInterface $amount, ?\Magento\Framework\Pricing\SaleableInterface $saleableItem = null, ?\Magento\Framework\Pricing\Price\PriceInterface $price = null, array $data = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createAmountRender');
        return $pluginInfo ? $this->___callPlugins('createAmountRender', func_get_args(), $pluginInfo) : parent::createAmountRender($amount, $saleableItem, $price, $data);
    }
}
