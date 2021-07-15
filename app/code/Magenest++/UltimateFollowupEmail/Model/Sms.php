<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 15/06/2016
 * Time: 10:13
 */

namespace Magenest\UltimateFollowupEmail\Model;

/**
 * Class Sms
 *
 * @package Magenest\UltimateFollowupEmail\Model
 */
class Sms extends \Magento\Framework\Model\AbstractModel
{
    const STATUS_PENDING   = 1;
    const STATUS_SENT      = 2;
    const STATUS_FAIL      = 3;
    const STATUS_CANCELLED = 4;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magenest\UltimateFollowupEmail\Helper\Nexmo
     */
    protected $nexmoHelper;


    /**
     * @param \Magento\Framework\Model\Context                   $context
     * @param \Magento\Framework\Registry                        $registry
     * @param ResourceModel\Sms                                       $resource
     * @param ResourceModel\Sms\Collection                            $resourceCollection
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface         $storeManager
     * @param \Magenest\UltimateFollowupEmail\Helper\Nexmo       $nexmoHelper
     * @param array                                              $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Sms $resource,
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Sms\Collection $resourceCollection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magenest\UltimateFollowupEmail\Helper\Nexmo $nexmoHelper,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;

        $this->storeManager = $storeManager;

        $this->nexmoHelper = $nexmoHelper;

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }//end __construct()


    public function send()
    {
        $this->nexmoHelper->send($this);
    }//end send()


    public function getMobileNumber()
    {
    }//end getMobileNumber()


    public function getContent()
    {
    }//end getContent()
}//end class
