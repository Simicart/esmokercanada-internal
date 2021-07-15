<?php
namespace MageWorx\SeoMarkup\Helper\DataProvider\Product;

/**
 * Interceptor class for @see \MageWorx\SeoMarkup\Helper\DataProvider\Product
 */
class Interceptor extends \MageWorx\SeoMarkup\Helper\DataProvider\Product implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoMarkup\Helper\Product $helperData, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder, \Magento\Framework\Registry $registry, \Magento\Catalog\Model\ResourceModel\Category $resourceCategory, \Magento\Review\Model\ReviewFactory $reviewFactory, \Magento\Review\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory, \Magento\Review\Model\ResourceModel\Rating\Option\Vote\CollectionFactory $ratingVoteCollectionFactory, \Magento\Framework\App\Helper\Context $context, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone, \Magento\Framework\Stdlib\DateTime $dateTime, \MageWorx\SeoAll\Helper\MagentoVersion $helperVersion)
    {
        $this->___init();
        parent::__construct($helperData, $storeManager, $imageBuilder, $registry, $resourceCategory, $reviewFactory, $reviewCollectionFactory, $ratingVoteCollectionFactory, $context, $timezone, $dateTime, $helperVersion);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductCanonicalUrl($product)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductCanonicalUrl');
        return $pluginInfo ? $this->___callPlugins('getProductCanonicalUrl', func_get_args(), $pluginInfo) : parent::getProductCanonicalUrl($product);
    }
}
