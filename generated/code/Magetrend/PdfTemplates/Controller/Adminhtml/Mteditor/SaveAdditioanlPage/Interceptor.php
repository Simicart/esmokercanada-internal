<?php
namespace Magetrend\PdfTemplates\Controller\Adminhtml\Mteditor\SaveAdditioanlPage;

/**
 * Interceptor class for @see \Magetrend\PdfTemplates\Controller\Adminhtml\Mteditor\SaveAdditioanlPage
 */
class Interceptor extends \Magetrend\PdfTemplates\Controller\Adminhtml\Mteditor\SaveAdditioanlPage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magetrend\PdfTemplates\Model\MtEditorManager $mtEditorManager, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Framework\Session\SessionManagerInterface $session, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Json\Helper\Data $jsonHelper, \Magetrend\PdfTemplates\Helper\Data $moduleHelper, \Magetrend\PdfTemplates\Model\TypeManager $typeManager)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $mtEditorManager, $fileFactory, $resultJsonFactory, $session, $filesystem, $jsonHelper, $moduleHelper, $typeManager);
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
