<?php
namespace MageWorx\SeoRedirects\Ui\Component\Listing\Column\TargetIdentifier;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Ui\Component\Listing\Column\TargetIdentifier
 */
class Interceptor extends \MageWorx\SeoRedirects\Ui\Component\Listing\Column\TargetIdentifier implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\UrlInterface $urlBuilder, \MageWorx\SeoRedirects\Model\Redirect\Source\Category $categoryOptions, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Cms\Model\ResourceModel\Page\CollectionFactory $pageCollectionFactory, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($eventManager, $urlBuilder, $categoryOptions, $productCollectionFactory, $pageCollectionFactory, $context, $uiComponentFactory, $components, $data);
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
