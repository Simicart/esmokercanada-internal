<?php
namespace Magenest\UltimateFollowupEmail\Model\Observer\Coupon;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;

class AddNewType implements ObserverInterface
{
    const COUPON_TYPE_FUE = 4;
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Framework\DataObject $transport */
        $transport = $observer->getEvent()->getData('transport');
        $couponTypes = $transport->getData('coupon_types');
        $fueCoupon = [
            self::COUPON_TYPE_FUE => __('Followup Email Coupon')
        ];
        $couponTypes += $fueCoupon;
        $transport->setData('coupon_types', $couponTypes);
        return $this;
    }
}
