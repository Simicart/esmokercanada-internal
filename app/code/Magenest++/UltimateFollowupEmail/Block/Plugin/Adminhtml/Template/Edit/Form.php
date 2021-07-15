<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 30/01/2016
 * Time: 20:25
 */
namespace Magenest\UltimateFollowupEmail\Block\Plugin\Adminhtml\Template\Edit;

class Form
{


    public function aroundGetVariables(
        \Magento\Email\Block\Adminhtml\Template\Edit\Form $subject,
        \Closure $proceed
    ) {
    
        $variables = $proceed();
        $count = count($variables);

        $variables[$count]['label'] = __('Follow Up Email Variables');

        $variables[$count]['value'] = [];

        $variables[$count]['value'][] = [
            'value' => '{{var cart}}',
            'label' => __('Abandoned Cart Content'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var resumeLink}}',
            'label' => __('Resume Link'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var customerName}}',
            'label' => __('Customer Name'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var customerFistName}}',
            'label' => __('Customer First Name'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var customerLastName}}',
            'label' => __('Customer Last Name'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var coupon_code}}',
            'label' => __('Coupon Code'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var downloadLink}}',
            'label' => __('Link to download updated item'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var orderProductsGrid}}',
            'label' => __('Order Products Grid'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var wishlistProduct}}',
            'label' => __('Wishlist Reminder Product'),
        ];
        $variables[$count]['value'][] = [
            'value' => '{{var relatedProductsGrid}}',
            'label' => __('Related Products Grid'),
        ];
        return $variables;
    }//end aroundGetVariables()
}//end class
