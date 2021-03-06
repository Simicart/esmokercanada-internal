<?php
namespace Magenest\UltimateFollowupEmail\Controller\Adminhtml\Chart;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
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
        $resultPage->setActiveMenu('Magenest_UltimateFollowupEmail::ultimatefollowupemail');
        $resultPage->getConfig()->getTitle()->prepend(__('Charts'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_UltimateFollowupEmail::ultimatefollowupemail');
    }
}
