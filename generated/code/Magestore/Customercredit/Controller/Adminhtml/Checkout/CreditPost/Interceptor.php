<?php
namespace Magestore\Customercredit\Controller\Adminhtml\Checkout\CreditPost;

/**
 * Interceptor class for @see \Magestore\Customercredit\Controller\Adminhtml\Checkout\CreditPost
 */
class Interceptor extends \Magestore\Customercredit\Controller\Adminhtml\Checkout\CreditPost implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Backend\Model\Session\Quote $sessionQuote, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Framework\Json\Helper\Data $helperJson, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magestore\Customercredit\Model\CustomercreditFactory $customercreditFactory)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $sessionQuote, $checkoutSession, $helperJson, $priceCurrency, $customercreditFactory);
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
