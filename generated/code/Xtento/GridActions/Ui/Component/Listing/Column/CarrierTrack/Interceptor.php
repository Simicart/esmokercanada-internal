<?php
namespace Xtento\GridActions\Ui\Component\Listing\Column\CarrierTrack;

/**
 * Interceptor class for @see \Xtento\GridActions\Ui\Component\Listing\Column\CarrierTrack
 */
class Interceptor extends \Xtento\GridActions\Ui\Component\Listing\Column\CarrierTrack implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Framework\Escaper $escaper, \Magento\Shipping\Model\Config $shippingConfig, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Shipping\Helper\Data $shippingHelper, \Magento\Sales\Model\OrderFactory $orderFactory, \Xtento\GridActions\Helper\Module $moduleHelper, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $escaper, $shippingConfig, $scopeConfig, $shippingHelper, $orderFactory, $moduleHelper, $components, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepare');
        return $pluginInfo ? $this->___callPlugins('prepare', func_get_args(), $pluginInfo) : parent::prepare();
    }
}
