<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 14/10/2015
 * Time: 13:58
 */
namespace Magenest\UltimateFollowupEmail\Model\Aggregator;

class AbandonedCart implements AggregatorInterface
{
    const ABANDONED_CART_PERIOD = "ultimatefollowupemail/abandonedcart/time_range";

    protected $_resource;

    protected $_quotesFactory;
    protected $_ruleFactory;

    protected $_abandonedCartFactory;
    protected $guestFactory;

    /** @var  $_abandonedCartResource \Magenest\UltimateFollowupEmail\Model\ResourceModel\AbandonedCart */
    protected $_abandonedCartResource;

    protected $_scopeConfig;
    protected $_abandonedCartTime = "60";

    /**
     * @var \Magenest\UltimateFollowupEmail\Helper\Data
     */
    protected $helper;
    public function __construct(
        \Magento\CatalogRule\Model\RuleFactory $ruleFactory,
        \Magento\Reports\Model\ResourceModel\Quote\CollectionFactory $quotesFactory,
        \Magenest\UltimateFollowupEmail\Model\AbandonedCartFactory $abandonedCartFactory,
        \Magenest\UltimateFollowupEmail\Model\GuestFactory $guestFactory,
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\AbandonedCart $abandonedCartResource,
        \Magenest\UltimateFollowupEmail\Helper\Data $dataHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
    
        $this->_quotesFactory = $quotesFactory;

        $this->_abandonedCartFactory = $abandonedCartFactory;
        $this->guestFactory = $guestFactory;

        $this->_ruleFactory = $ruleFactory;
        $this->_abandonedCartResource = $abandonedCartResource;

        $this->_scopeConfig = $scopeConfig;

        $this->helper = $dataHelper;

        $abandonedCartPeriod = $this->helper->getAbandonedCartPeriod();
        $this->_abandonedCartTime =$abandonedCartPeriod;
    }

    /**
     * collect abandoned cart
     */

    public function collect()
    {
        $this->_collectAbandonedCart();

        $this->collectGuestAbandonedCart();

        //get all the abandoned cart with is_procecced is 0
        $abandonedCarts = $this->_abandonedCartFactory->create()->getCollection()->addFieldToFilter('is_processed', [
            ['eq' =>0],
            ['null' => true]
        ])
            -> addFieldToFilter('email', ['notnull'=>true])->addFieldToFilter('type', ['neq' => 'anonymous']);
        $size = $abandonedCarts->getSize();
        return $abandonedCarts;
    }


    /**
     * Get abandoned cart of customer
     * @return array
     */
    public function _collectAbandonedCart()
    {
        $abandonedCarts = $this->_abandonedCartResource->getAbandonedCartForInsertOperation($this->_abandonedCartTime);

        //insert it in to record
        foreach ($abandonedCarts as $quote) {
            $abandonedCart = $this->_abandonedCartFactory->create();
            $abandonedCart->setData('quote_id', $quote['entity_id'])->setData('email', $quote['customer_email'])
                ->setData('type', 'customer')->save();
        }
        return $abandonedCarts;
    }

    /**
     * Get abandoned cart of guest
     * @return array
     */
    public function collectGuestAbandonedCart()
    {
        $abandonedCarts = $this->_abandonedCartResource->getAbandonedCartOfGuest($this->_abandonedCartTime);

        //insert it in to record
        foreach ($abandonedCarts as $quote) {
            $abandonedCart = $this->_abandonedCartFactory->create();

            $quoteId = $quote['entity_id'];
            $guestCapture = $this->guestFactory->create()->getCollection()->addFieldToFilter('quote_id', $quoteId)->getFirstItem();

            if ($guestCapture->getId()) {
                $email = $guestCapture->getEmail();
                $abandonedCart->setData('quote_id', $quoteId)->setData('email', $email)->setData('type', 'guest')->save();
            } else {
                $abandonedCart->setData('quote_id', $quoteId)->setData('type', 'anonymous')->save();
            }
        }

        return $abandonedCarts;
    }
}
