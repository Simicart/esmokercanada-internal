<?php
namespace Magento\Catalog\Ui\Component\Listing\Columns\AttributeSetId;

/**
 * Interceptor class for @see \Magento\Catalog\Ui\Component\Listing\Columns\AttributeSetId
 */
class Interceptor extends \Magento\Catalog\Ui\Component\Listing\Columns\AttributeSetId implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $components, $data);
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
