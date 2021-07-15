<?php
namespace Magestore\WebposCustomize\Block\Order;

use Magento\Sales\Model\Order;

class Totals extends \Magento\Sales\Block\Order\Totals
{
    /**
     * get totals array for visualization
     *
     * @param array|null $area
     * @return array
     */
    public function getTotals($area = null)
    {
        $source = $this->getSource();
        $quoteId = $source->getQuoteId();
        $totalRewardsArray = array();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $rewardsPurchase = $objectManager->create('\Mirasvit\Rewards\Helper\Purchase');
        $purchase = $rewardsPurchase->getByQuote($quoteId);
        $rewardsData = $objectManager->create('\Mirasvit\Rewards\Helper\Data');

        $scopeConfig = $objectManager->create('\Magento\Framework\App\Config\ScopeConfigInterface');

        $pointUnit = $scopeConfig->getValue('rewards/general/point_unit_name',
            \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            $source->getStoreCurrencyCode());

        if($purchase->getEarnPoints()) {
            $totalRewardsArray['rewards_earn'] = new \Magento\Framework\DataObject(
                [
                    'code' => 'rewards_earn',
                    'field' => 'rewards_earn',
                    'strong' => false,
                    'value' => $purchase->getEarnPoints() . " " . $pointUnit,
                    'label' => __('You Earn'),
                ]
            );
        }
        if($purchase->getSpendPoints()) {
            $totalRewardsArray['rewards_spent'] = new \Magento\Framework\DataObject(
                [
                    'code' => 'rewards_spent',
                    'field' => 'rewards_spent',
                    'strong' => false,
                    'value' => $purchase->getSpendPoints() . " " . $pointUnit,
                    'label' => __('You Spend'),
                ]
            );
        }


        $totals = [];
        if ($area === null) {
            $totals = $this->_totals;
        } else {
            $area = (string)$area;
            foreach ($this->_totals as $total) {
                $totalArea = (string)$total->getArea();
                if ($totalArea == $area) {
                    $totals[] = $total;
                }
            }
        }

        $result = array();

        foreach ($totals as $index => $total){
            array_push($result,$total);
            if ($total['code'] == "subtotal" && count($totalRewardsArray) > 0) {
                $result = array_merge($result,$totalRewardsArray);
            }
        }

        return $result;
    }
}
