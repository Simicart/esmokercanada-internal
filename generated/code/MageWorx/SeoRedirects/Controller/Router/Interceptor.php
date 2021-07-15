<?php
namespace MageWorx\SeoRedirects\Controller\Router;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Router
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoRedirects\Helper\CustomRedirect\Data $helperData, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirectFinder $customRedirectFinder, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder, \Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\UrlInterface $url, \Magento\Framework\App\ResponseInterface $response)
    {
        $this->___init();
        parent::__construct($helperData, $customRedirectFinder, $storeManager, $urlFinder, $actionFactory, $url, $response);
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
