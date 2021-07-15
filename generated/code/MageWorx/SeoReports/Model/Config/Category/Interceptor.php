<?php
namespace MageWorx\SeoReports\Model\Config\Category;

/**
 * Interceptor class for @see \MageWorx\SeoReports\Model\Config\Category
 */
class Interceptor extends \MageWorx\SeoReports\Model\Config\Category implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getConfig');
        return $pluginInfo ? $this->___callPlugins('getConfig', func_get_args(), $pluginInfo) : parent::getConfig();
    }
}
