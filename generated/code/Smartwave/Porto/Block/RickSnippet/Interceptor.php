<?php
namespace Smartwave\Porto\Block\RickSnippet;

/**
 * Interceptor class for @see \Smartwave\Porto\Block\RickSnippet
 */
class Interceptor extends \Smartwave\Porto\Block\RickSnippet implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $productContext, \Magento\Review\Model\Review\SummaryFactory $reviewSummaryFactory, \Magento\Framework\View\Element\Template\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($productContext, $reviewSummaryFactory, $context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toHtml');
        return $pluginInfo ? $this->___callPlugins('toHtml', func_get_args(), $pluginInfo) : parent::toHtml();
    }
}
