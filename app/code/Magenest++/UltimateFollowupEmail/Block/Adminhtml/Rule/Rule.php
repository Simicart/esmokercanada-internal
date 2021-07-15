<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 29/09/2015
 * Time: 23:11
 */

namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Rule;

class Rule extends \Magento\Backend\Block\Widget\Grid\Container
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;


    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;

        parent::__construct($context, $data);
    }//end __construct()


    /**
     * Initialize add new review
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_addButtonLabel = __('New Rule');
        parent::_construct();

        $this->_blockGroup = 'Magenest_UltimateFollowupEmail';
        $this->_controller = 'adminhtml_rule';

        $this->_headerText = __('Follow up email rules');
    }//end _construct()
}//end class
