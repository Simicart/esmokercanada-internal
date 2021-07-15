<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 29/09/2015
 * Time: 21:05
 */

namespace Magenest\UltimateFollowupEmail\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

use Magenest\UltimateFollowupEmail\Model\RuleFactory;

class Mail extends Action
{

    protected $mailFactory;

    protected $_resultLayoutFactory;

    /**
     * @param \Magento\Backend\App\Action\Context               $context
     * @param \Magento\Framework\Registry                       $coreRegistry
     * @param  \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory
     */


    public function __construct(
        Context $context,
        Registry $coreRegistry,
        MailFactory $mailFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    ) {
        $this->_context     = $context;
        $this->coreRegistry = $coreRegistry;
        $this->mailFactory  = $mailFactory;

        $this->_resultLayoutFactory = $resultLayoutFactory;

        // $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }//end __construct()


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
    }//end execute()
    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_UltimateFollowupEmail::mail');
    }//end _isAllowed()
}//end class
