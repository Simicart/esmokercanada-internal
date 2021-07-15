<?php
namespace MageWorx\OrdersGrid\Ui\Component\Listing\Columns\TaxCode;

/**
 * Interceptor class for @see \MageWorx\OrdersGrid\Ui\Component\Listing\Columns\TaxCode
 */
class Interceptor extends \MageWorx\OrdersGrid\Ui\Component\Listing\Columns\TaxCode implements \Magento\Framework\Interception\InterceptorInterface
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
