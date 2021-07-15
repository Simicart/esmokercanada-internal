<?php
namespace Magento\Sales\Model\Order\Pdf\Total\DefaultTotal;

/**
 * Interceptor class for @see \Magento\Sales\Model\Order\Pdf\Total\DefaultTotal
 */
class Interceptor extends \Magento\Sales\Model\Order\Pdf\Total\DefaultTotal implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Tax\Helper\Data $taxHelper, \Magento\Tax\Model\Calculation $taxCalculation, \Magento\Tax\Model\ResourceModel\Sales\Order\Tax\CollectionFactory $ordersFactory, array $data = [])
    {
        $this->___init();
        parent::__construct($taxHelper, $taxCalculation, $ordersFactory, $data);
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
