<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 29/09/2015
 * Time: 23:19
 */

namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Mail;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    protected $_status;

    protected $_mailFactory;


    /**
     * Grid constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory
     * @param \Magenest\UltimateFollowupEmail\Model\System\Config\Source\Mail\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magenest\UltimateFollowupEmail\Model\System\Config\Source\Mail\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_mailFactory = $mailFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }//end __construct()


    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('post_filter');
    }//end _construct()

    public function _prepareFilterButtons()
    {
        parent::_prepareFilterButtons();

        $this->setChild(
            'emulate_collecting',
            $this->getLayout()->createBlock(
                'Magento\Backend\Block\Widget\Button'
            )->setData(
                [
                    'label' => __('Emulate Collecting Mails'),
                    'onclick' => 'location.href="' . $this->getUrl('ultimatefollowupemail/emulate/collect') . '"',
                    'class' => 'action-primary',
                ]
            )->setDataAttribute(['action' => 'emulate_collecting_redirect'])
        );
        $this->setChild(
            'emulate_sending',
            $this->getLayout()->createBlock(
                'Magento\Backend\Block\Widget\Button'
            )->setData(
                [
                    'label' => __('Emulate Sending Mails'),
                    'onclick' => 'location.href="' . $this->getUrl('ultimatefollowupemail/emulate/send') . '"',
                    'class' => 'action-primary',
                ]
            )->setDataAttribute(['action' => 'emulate_sending_redirect'])
        );
    }

    public function getMainButtonsHtml()
    {
        $html = $this->getEmulateButtonsHtml();
        $html .= parent::getMainButtonsHtml();
        return $html;
    }

    protected function getEmulateButtonsHtml()
    {
        return $this->getChildHtml('emulate_collecting') . $this->getChildHtml('emulate_sending');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_mailFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }//end _prepareCollection()


    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => $this->_status->getOptionArray(),
            ]
        );
        $this->addColumn(
            'rule_id',
            [
                'header' => __('Rule ID'),
                'index' => 'rule_id',
                'type' => 'abc',
            ]
        );
        $this->addColumn(
            'recipient_name',
            [
                'header' => __('Recipient Name'),
                'index' => 'recipient_name',
                'type' => 'abc',
            ]
        );
        $this->addColumn(
            'recipient_email',
            [
                'header' => __('Recipient Email'),
                'index' => 'recipient_email',
                'type' => 'abc',
            ]
        );

        $this->addColumn(
            'send_date',
            [
                'header' => __('Send At'),
                'index' => 'send_date',
                'type' => 'datetime',
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created at'),
                'index' => 'created_at',
                'type' => 'datetime',
            ]
        );

        $this->addColumn(
            'action',
            [
                'header' => __('Action'),
                'type' => 'action',
                'index' => 'id',

                'actions' => [

                    [
                        'caption' => __('Send now'),
                        'url' => ['base' => '*/mail/send'],
                        'field' => 'id',
                    ],
                    [
                        'caption' => __('Cancel'),
                        'url' => ['base' => '*/mail/cancel'],
                        'field' => 'id',
                    ],
                ],

            ]
        );
        $this->addColumn(
            'preview',
            [
                'header' => __('Preview'),

                'index' => 'id',
                'sortable' => false,
                'filter' => false,
                'no_link' => true,
                'renderer' => 'Magenest\UltimateFollowupEmail\Block\Adminhtml\Mail\Grid\Renderer\Preview',
            ]
        );
        $this->addColumn(
            'Log',
            [
                'header' => __('Log'),
                'index' => 'log',
            ]
        );


        $block = $this->getLayout()->getBlock('grid.bottom.links');

        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }//end _prepareColumns()


    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('mail');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('ultimatefollowupemail/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );
        $statuses = $this->_status->getOptionArray();
        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('ultimatefollowupemail/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses,
                    ],
                ],
            ]
        );

        return $this;
    }//end _prepareMassaction()


    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('ultimatefollowupemail/*/grid', ['_current' => true]);
    }//end getGridUrl()


    /**
     * @param \Magenest\UltimateFollowupEmail\Model\Mail|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'ultimatefollowupemail/*/preview',
            ['id' => $row->getId()]
        );
    }//end getRowUrl()
}//end class
