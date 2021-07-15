<?php
namespace MageWorx\SeoReports\Ui\Component\Listing\Column\Actions;

/**
 * Interceptor class for @see \MageWorx\SeoReports\Ui\Component\Listing\Column\Actions
 */
class Interceptor extends \MageWorx\SeoReports\Ui\Component\Listing\Column\Actions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\UrlInterface $urlBuilder, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, $editUrl, $idForEdit = 'id', $useStoreForEditUrl = true, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($storeManager, $urlBuilder, $context, $uiComponentFactory, $editUrl, $idForEdit, $useStoreForEditUrl, $components, $data);
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
