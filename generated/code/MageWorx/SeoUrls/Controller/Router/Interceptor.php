<?php
namespace MageWorx\SeoUrls\Controller\Router;

/**
 * Interceptor class for @see \MageWorx\SeoUrls\Controller\Router
 */
class Interceptor extends \MageWorx\SeoUrls\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoUrls\Helper\Data $helperData, \MageWorx\SeoUrls\Helper\SeoUrlParser $seoUrlParser, \MageWorx\SeoUrls\Helper\SeoUrlBuilder $seoUrlBuilder, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder, \Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\UrlInterface $url, \Magento\Framework\App\ResponseInterface $response)
    {
        $this->___init();
        parent::__construct($helperData, $seoUrlParser, $seoUrlBuilder, $storeManager, $urlFinder, $actionFactory, $url, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
