<?php
namespace Magebees\Urlrewrite\Controller\Adminhtml\Importurlrewrite;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->_setActiveMenu('Magebees_Urlrewrite::import');
        $resultPage->getConfig()->getTitle()->prepend(__('Import/Export URL Rewrites'));
        $resultPage->getConfig()->getTitle()->prepend(__('Import URL Rewrites'));
        $resultPage->addBreadcrumb(__('Import URL Rewrites'), __('Import URL Rewrites'));
        return $resultPage;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magebees_Urlrewrite::import');
    }
}
