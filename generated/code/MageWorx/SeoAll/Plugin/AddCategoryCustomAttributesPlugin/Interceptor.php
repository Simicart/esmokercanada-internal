<?php
namespace MageWorx\SeoAll\Plugin\AddCategoryCustomAttributesPlugin;

/**
 * Interceptor class for @see \MageWorx\SeoAll\Plugin\AddCategoryCustomAttributesPlugin
 */
class Interceptor extends \MageWorx\SeoAll\Plugin\AddCategoryCustomAttributesPlugin implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Eav\Model\Config $eavConfig, $data = [])
    {
        $this->___init();
        parent::__construct($eavConfig, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMeta');
        return $pluginInfo ? $this->___callPlugins('getMeta', func_get_args(), $pluginInfo) : parent::getMeta();
    }

    /**
     * {@inheritdoc}
     */
    public function prepareMeta($meta)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepareMeta');
        return $pluginInfo ? $this->___callPlugins('prepareMeta', func_get_args(), $pluginInfo) : parent::prepareMeta($meta);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributesMeta(\Magento\Eav\Model\Entity\Type $entityType)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAttributesMeta');
        return $pluginInfo ? $this->___callPlugins('getAttributesMeta', func_get_args(), $pluginInfo) : parent::getAttributesMeta($entityType);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultMetaData($result)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDefaultMetaData');
        return $pluginInfo ? $this->___callPlugins('getDefaultMetaData', func_get_args(), $pluginInfo) : parent::getDefaultMetaData($result);
    }
}
