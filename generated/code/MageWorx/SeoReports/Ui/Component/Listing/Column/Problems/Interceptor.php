<?php
namespace MageWorx\SeoReports\Ui\Component\Listing\Column\Problems;

/**
 * Interceptor class for @see \MageWorx\SeoReports\Ui\Component\Listing\Column\Problems
 */
class Interceptor extends \MageWorx\SeoReports\Ui\Component\Listing\Column\Problems implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoReports\Model\ConfigInterface $reportConfig, \Magento\Framework\ObjectManagerInterface $objectManager, \MageWorx\SeoReports\Helper\Data $helperData, \Magento\Backend\Model\UrlInterface $backendUrl, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($reportConfig, $objectManager, $helperData, $backendUrl, $context, $uiComponentFactory, $components, $data);
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
