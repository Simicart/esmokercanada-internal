<?php
namespace Magento\Weee\Model\Sales\Pdf\Weee;

/**
 * Interceptor class for @see \Magento\Weee\Model\Sales\Pdf\Weee
 */
class Interceptor extends \Magento\Weee\Model\Sales\Pdf\Weee implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Tax\Helper\Data $taxHelper, \Magento\Tax\Model\Calculation $taxCalculation, \Magento\Tax\Model\ResourceModel\Sales\Order\Tax\CollectionFactory $ordersFactory, \Magento\Weee\Helper\Data $_weeeData, array $data = [])
    {
        $this->___init();
        parent::__construct($taxHelper, $taxCalculation, $ordersFactory, $_weeeData, $data);
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
