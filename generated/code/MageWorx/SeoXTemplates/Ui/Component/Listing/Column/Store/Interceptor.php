<?php
namespace MageWorx\SeoXTemplates\Ui\Component\Listing\Column\Store;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Ui\Component\Listing\Column\Store
 */
class Interceptor extends \MageWorx\SeoXTemplates\Ui\Component\Listing\Column\Store implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Framework\Escaper $escaper, \Magento\Store\Model\StoreManagerInterface $storeManager, array $components = [], array $data = [], $storeKey = 'store_id')
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $systemStore, $escaper, $storeManager, $components, $data, $storeKey);
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
