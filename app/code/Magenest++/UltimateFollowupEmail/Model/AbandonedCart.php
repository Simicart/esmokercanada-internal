<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 15/10/2015
 * Time: 10:10
 */

namespace Magenest\UltimateFollowupEmail\Model;

use Magenest\UltimateFollowupEmail\Model\ResourceModel\AbandonedCart as ResourceModel;
use Magenest\UltimateFollowupEmail\Model\ResourceModel\AbandonedCart\Collection;

class AbandonedCart extends \Magento\Framework\Model\AbstractModel
{

    // the cart is new, it has not pass the abandoned time (1 hour by default)
    const  STATUS_NEW = 0;

    // the cart is abandoned
    const  STATUS_ABANDONED = 1;

    // the cart i recovered after abandoned
    const  STATUS_RECOVERED = 2;

    // the cart is converted to order
    const  STATUS_CONVERTED = 3;

    protected $_eventprefix = 'ultimatefollowupemail_abandoned_cart';


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ResourceModel $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }//end __construct()
}//end class
