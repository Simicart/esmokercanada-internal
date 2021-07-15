<?php
namespace Magestore\Customercredit\Block\Adminhtml\Product\View;

/**
 * Interceptor class for @see \Magestore\Customercredit\Block\Adminhtml\Product\View
 */
class Interceptor extends \Magestore\Customercredit\Block\Adminhtml\Product\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Framework\Stdlib\ArrayUtils $arrayUtils, \Magestore\Customercredit\Helper\Creditproduct $helperData, \Magestore\Customercredit\Helper\Data $customercreditData, \Magento\Framework\ObjectManagerInterface $objectManager, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Framework\Locale\FormatInterface $localeFormat, \Magento\Backend\Model\Session\Quote $sessionQuote, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $arrayUtils, $helperData, $customercreditData, $objectManager, $jsonEncoder, $localeFormat, $sessionQuote, $priceCurrency, $data);
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
