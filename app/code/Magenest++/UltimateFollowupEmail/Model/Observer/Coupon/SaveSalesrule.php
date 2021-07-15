<?php
namespace Magenest\UltimateFollowupEmail\Model\Observer\Coupon;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\SalesRule\Model\Rule;

class SaveSalesrule implements ObserverInterface
{
    public function execute(EventObserver $observer)
    {
        /** @var Rule $rule */
        $rule = $observer->getEvent()->getData('rule');
        if ($rule->getCouponType() == AddNewType::COUPON_TYPE_FUE) {
            $rule->setData('is_fue', 1);
        } else {
            $rule->setData('is_fue', 0);
        }
    }
}
