<?php
namespace Magestore\Customercredit\Block\Product\View;

/**
 * Interceptor class for @see \Magestore\Customercredit\Block\Product\View
 */
class Interceptor extends \Magestore\Customercredit\Block\Product\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Framework\Stdlib\ArrayUtils $arrayUtils, \Magestore\Customercredit\Helper\Creditproduct $creditproductHelper, \Magestore\Customercredit\Helper\Data $customercreditData, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Framework\Locale\FormatInterface $localeFormat, \Magento\Customer\Model\Session $customerSession, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $arrayUtils, $creditproductHelper, $customercreditData, $objectManager, $jsonEncoder, $priceCurrency, $localeFormat, $customerSession, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImage');
        return $pluginInfo ? $this->___callPlugins('getImage', func_get_args(), $pluginInfo) : parent::getImage($product, $imageId, $attributes);
    }
}
