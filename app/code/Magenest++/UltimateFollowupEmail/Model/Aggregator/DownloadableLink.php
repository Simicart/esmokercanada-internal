<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 09/12/2016
 * Time: 14:25
 */

namespace Magenest\UltimateFollowupEmail\Model\Aggregator;

class DownloadableLink implements AggregatorInterface
{

    /**
     * @var \Magenest\UltimateFollowupEmail\Helper\Order
     */
    protected $orderHelper;

    /**
     * @var \Magenest\UltimateFollowupEmail\Model\LinkFactory
     */
    protected $linkFactory;

    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\LinkFactory $linkFactory,
        \Magenest\UltimateFollowupEmail\Helper\Order $orderHelper
    ) {
        $this->orderHelper = $orderHelper;
        $this->linkFactory = $linkFactory;
    }
    public function collect()
    {
        $output =[];
      //get all the pending link record
        //get all the order and customer
        //get all the rule to crate
        //get all the email chain
        //get all the sms chain
        $linkCollection = $this->linkFactory->create()->getCollection()->addFieldToFilter(
            'state',
            'pending'
        );

        if ($linkCollection->getSize() > 0) {
            foreach ($linkCollection as $linkBean) {
                $productId = $linkBean->getProductId();
                $linkId    = $linkBean->getId();

                $targets = $this->orderHelper->getCustomersByProduct($productId);

                if (count($targets) > 0) {
                    foreach ($targets as $target) {
                        $target['link_id'] = $linkId;
                        $output[]=$target;
                    }
                }
            }
        }

        return $output;
    }
}
