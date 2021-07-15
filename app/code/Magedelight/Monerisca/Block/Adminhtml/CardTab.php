<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Block\Adminhtml;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;

class CardTab extends \Magento\Backend\Block\Template implements TabInterface
{
    public $coreRegistry;
    public $allcardcollection;
    public $cards;
    // @codingStandardsIgnoreStart
    public $_template = 'tab/savedCards.phtml';
    // @codingStandardsIgnoreEnd
    public $monerisConfig;
    public $xmlApi;
    public $soapApi;
    public $monerisHelper;
    public $customerFactory;
    public $jsonEncoder;
    public $customerid;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magedelight\Monerisca\Model\Cards $allcardcollection,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Json\Encoder $jsonEncoder,
        array $data = []
    ) {
        $this->_allcardcollection = $allcardcollection;
        $this->coreRegistry = $registry;
        $this->monerisHelper = $monerisHelper;
        $this->customerFactory = $customerFactory;
        $this->jsonEncoder = $jsonEncoder;
        parent::__construct($context, $data);
    }
    public function getCustomerId()
    {
        $customerId = $this->coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
        if (empty($customerId)) {
            $customerId = $this->customerid;
        }

        return $customerId;
    }
    public function getTabLabel()
    {
        return __('Saved Moneris Cards For CA');
    }
    public function getTabTitle()
    {
        return __('Saved Moneris Cards For CA');
    }
    public function setCustomerId($customerid)
    {
        $this->customerid = $customerid;
    }
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }

        return false;
    }
    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }

        return true;
    }
    public function getTabClass()
    {
        return '';
    }
    public function getTabUrl()
    {
        return '';
    }
    public function isAjaxLoaded()
    {
        return false;
    }
    public function getCards()
    {
        $customerId = $this->getCustomerId();
        $result = [];
        if (!empty($customerId)) {
            $result = $this->_allcardcollection->getCollection()
                ->addFieldToFilter('customer_id', $customerId)
                ->getData();
        }

        return $result;
    }

    public function getFormatedAddress($card)
    {
        return $this->monerisHelper->getFormatedAddress($card);
    }

    public function getCardsInJson()
    {
        return $this->jsonEncoder->encode($this->getCards());
    }

    public function getDeleteActionUrl()
    {
        return $this->getUrl('md_monerisca/cards/delete', ['id' => $this->getCustomerId()]);
    }

    public function getEditCardAction()
    {
        return $this->getUrl('md_monerisca/cards/edit', ['id' => $this->getCustomerId()]);
    }

    public function getAddAction()
    {
        return $this->getUrl('md_monerisca/cards/add', ['id' => $this->getCustomerId()]);
    }
}
