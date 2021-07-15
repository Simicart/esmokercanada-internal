<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\Save;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\Save
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirectHelper $customRedirectHelper, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirectRepository $customRedirectRepository, \Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoRedirects\Model\Redirect\Source\CustomRedirect\RedirectTypeRequestKey $redirectTypeRequestKeyOptions, \MageWorx\SeoRedirects\Model\Redirect\Source\CustomRedirect\RedirectTypeTargetKey $redirectTypeTargetKeyOptions, \MageWorx\SeoRedirects\Model\Redirect\Source\RedirectTypeEntity $redirectTypeEntityOptions, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Catalog\Model\ProductFactory $productFactory, \Magento\Catalog\Model\CategoryFactory $categoryFactory, \MageWorx\SeoAll\Model\ResourceModel\Category $resourceCategory, \Magento\Cms\Model\PageFactory $pageFactory, \MageWorx\SeoRedirects\Model\ResourceModel\Redirect\CustomRedirect\CollectionFactory $redirectCollectionFactory, \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder, \Magento\Backend\App\Action\Context $context, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->___init();
        parent::__construct($customRedirectHelper, $customRedirectRepository, $registry, $resultPageFactory, $redirectTypeRequestKeyOptions, $redirectTypeTargetKeyOptions, $redirectTypeEntityOptions, $storeManager, $productFactory, $categoryFactory, $resourceCategory, $pageFactory, $redirectCollectionFactory, $urlFinder, $context, $timezone);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
