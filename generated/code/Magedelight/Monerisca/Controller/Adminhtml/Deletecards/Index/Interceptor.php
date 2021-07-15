<?php
namespace Magedelight\Monerisca\Controller\Adminhtml\Deletecards\Index;

/**
 * Interceptor class for @see \Magedelight\Monerisca\Controller\Adminhtml\Deletecards\Index
 */
class Interceptor extends \Magedelight\Monerisca\Controller\Adminhtml\Deletecards\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magedelight\Monerisca\Model\CardsFactory $cards)
    {
        $this->___init();
        parent::__construct($context, $cards);
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
