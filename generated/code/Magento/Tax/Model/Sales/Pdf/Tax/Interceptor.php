<?php
namespace Magento\Tax\Model\Sales\Pdf\Tax;

/**
 * Interceptor class for @see \Magento\Tax\Model\Sales\Pdf\Tax
 */
class Interceptor extends \Magento\Tax\Model\Sales\Pdf\Tax implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Tax\Helper\Data $taxHelper, \Magento\Tax\Model\Calculation $taxCalculation, \Magento\Tax\Model\ResourceModel\Sales\Order\Tax\CollectionFactory $ordersFactory, \Magento\Tax\Model\Config $taxConfig, array $data = [])
    {
        $this->___init();
        parent::__construct($taxHelper, $taxCalculation, $ordersFactory, $taxConfig, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTitleDescription()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTitleDescription');
        return $pluginInfo ? $this->___callPlugins('getTitleDescription', func_get_args(), $pluginInfo) : parent::getTitleDescription();
    }
}
