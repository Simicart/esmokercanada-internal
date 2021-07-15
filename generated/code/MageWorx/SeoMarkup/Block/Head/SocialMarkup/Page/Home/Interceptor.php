<?php
namespace MageWorx\SeoMarkup\Block\Head\SocialMarkup\Page\Home;

/**
 * Interceptor class for @see \MageWorx\SeoMarkup\Block\Head\SocialMarkup\Page\Home
 */
class Interceptor extends \MageWorx\SeoMarkup\Block\Head\SocialMarkup\Page\Home implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \MageWorx\SeoMarkup\Helper\Website $helperWebsite, \Magento\Framework\View\Element\Template\Context $context, \MageWorx\SeoMarkup\Model\OpenGraphConfigProvider $openGraphConfigProvider, \MageWorx\SeoMarkup\Model\TwitterCardsConfigProvider $twCardsConfigProvider, \Magento\Cms\Model\Page $pageModel, array $data)
    {
        $this->___init();
        parent::__construct($registry, $helperWebsite, $context, $openGraphConfigProvider, $twCardsConfigProvider, $pageModel, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getPreparedUrl() : string
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPreparedUrl');
        return $pluginInfo ? $this->___callPlugins('getPreparedUrl', func_get_args(), $pluginInfo) : parent::getPreparedUrl();
    }
}
