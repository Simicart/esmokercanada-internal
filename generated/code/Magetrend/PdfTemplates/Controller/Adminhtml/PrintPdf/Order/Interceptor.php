<?php
namespace Magetrend\PdfTemplates\Controller\Adminhtml\PrintPdf\Order;

/**
 * Interceptor class for @see \Magetrend\PdfTemplates\Controller\Adminhtml\PrintPdf\Order
 */
class Interceptor extends \Magetrend\PdfTemplates\Controller\Adminhtml\PrintPdf\Order implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magetrend\PdfTemplates\Model\Template $template, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magetrend\PdfTemplates\Helper\Data $moduleHelper, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Stdlib\DateTime\DateTime $dateTime)
    {
        $this->___init();
        parent::__construct($context, $template, $orderRepository, $moduleHelper, $fileFactory, $filesystem, $dateTime);
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
