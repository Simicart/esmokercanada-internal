<?php
/**
 * ITORIS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the ITORIS's Magento Extensions License Agreement
 * which is available through the world-wide-web at this URL:
 * http://www.itoris.com/magento-extensions-license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@itoris.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extensions to newer
 * versions in the future. If you wish to customize the extension for your
 * needs please refer to the license agreement or contact sales@itoris.com for more information.
 *
 * @category   ITORIS
 * @package    ITORIS_M2_Itoris_GroupedProductConfiguration
 * @copyright  Copyright (c) 2016 ITORIS INC. (http://www.itoris.com)
 * @license    http://www.itoris.com/magento-extensions-license.html  Commercial License
 */
namespace Itoris\GroupedProductConfiguration\Controller\Cart;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Framework\Exception\NoSuchEntityException;

class Add extends \Magento\Checkout\Controller\Cart\Add
{
    protected $_objectManager;
    
    protected $_eventManager;
        
    public function execute()
    {
        try {
            if (!$this->_formKeyValidator->validate($this->getRequest())) {
                return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
            $params = $this->getRequest()->getParams();
            $associatedProductParams = [];
            $cart = $this->cart;
            $qtyCount = 0;
            $bundleOptionsQty = [];
            $bundleOptionsQty=[];
            foreach ($params as $paramName => $value) {
                if ($paramName == 'super_group' && is_array($params['super_group'])) {
                    foreach ($value as $productId => $qty) {
                        if ($qty >= 1) {
                            $storeId = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore()->getId();
                            $product=$this->productRepository->getById($productId, false, $storeId);
                            if(method_exists($product,'getProductOptionsCollection'))
                                $productOptions = $product->getProductOptionsCollection();
                            else
                                $productOptions = $product->getOptions();
                            $options = '';
                            foreach ($productOptions as $optionId => $option) {
                                $options .=  $optionId . ',';
                            }
                            $options = substr($options, 0, -1);
                            $optionArray = [];
                            if (array_key_exists('options', $params)) {
                                foreach ($params['options'] as $idOption => $checkValue) {
                                    if (strpos($options, (string)$idOption) !== false) {
                                        $optionArray[$idOption] = $checkValue;
                                    }
                                }
                            }
                            $related = array_key_exists('related_product', $params) ? $params['related_product'] : null;
                            if(isset($params['bundle_option'])) {
                                foreach ($params['bundle_option'] as $key => $value) {
                                    if (array_key_exists('bundle_option', $params) && array_key_exists($productId, $params['bundle_option'][$key])) {
                                        $bundleOptions[$key] = $params['bundle_option'][$key][$productId];
                                    }
                                    if (array_key_exists('bundle_option_qty', $params) && isset($params['bundle_option_qty'][$key]) && array_key_exists($productId, $params['bundle_option_qty'][$key])) {
                                        $bundleOptionsQty[$key] = $params['bundle_option_qty'][$key][$productId];
                                    }
                                }
                            }
                            if(isset($bundleOptions)) {
                                if(isset($params['file_itoris'.$productId])) {
                                    $fileNameAndAction=$params['file_itoris'.$productId];
                                    $fileNameAndAction=explode(':',$fileNameAndAction);
                                    $fileName=explode('-',$fileNameAndAction[0]);
                                    $fileName = $fileName[1];
                                    $fileAction=explode('-',$fileNameAndAction[1]);
                                    $fileAction = $fileAction[1];
                                    $associatedProductParams = [
                                        //'uenc' => $params['uenc'],
                                        'product' => (string)$productId,
                                        $fileAction=>$params[$fileAction],
                                        'related_product' => $related,
                                        'options' => $optionArray,
                                        'super_attribute' => isset($params['super_attribute'][$productId])
                                            ? $params['super_attribute'][$productId] : null,
                                        'bundle_option' => $bundleOptions,
                                        'bundle_option_qty' => $bundleOptionsQty,
                                        'qty' => $qty
                                    ];
                                }else{
                                    $associatedProductParams = [
                                        //'uenc' => $params['uenc'],
                                        'product' => (string)$productId,
                                        'related_product' => $related,
                                        'options' => $optionArray,
                                        'super_attribute' => isset($params['super_attribute'][$productId])
                                            ? $params['super_attribute'][$productId] : null,
                                        'bundle_option' => $bundleOptions,
                                        'bundle_option_qty' => $bundleOptionsQty,
                                        'qty' => $qty
                                    ];
                                }
                            }else{
                                if(isset($params['file_itoris'.$productId])){
                                    $fileNameAndAction=$params['file_itoris'.$productId];
                                    $fileNameAndAction=explode(':',$fileNameAndAction);
                                    $fileName=explode('-',$fileNameAndAction[0]);
                                    $fileName = $fileName[1];
                                    $fileAction=explode('-',$fileNameAndAction[1]);
                                    $fileAction = $fileAction[1];
                                    $associatedProductParams = [
                                        //'uenc' => $params['uenc'],
                                        'product' => (string)$productId,
                                        $fileAction=>$params[$fileAction],
                                        'related_product' => $related,
                                        'options' => $optionArray,
                                        'super_attribute' => isset($params['super_attribute'][$productId])
                                            ? $params['super_attribute'][$productId] : null,
                                        'qty' => $qty];
                                }else {
                                    $associatedProductParams = [
                                        //'uenc' => $params['uenc'],
                                        'product' => (string)$productId,
                                        'related_product' => $related,
                                        'options' => $optionArray,
                                        'super_attribute' => isset($params['super_attribute'][$productId])
                                            ? $params['super_attribute'][$productId] : null,
                                        'qty' => $qty];
                                }
                            }
                            if (isset($params['links'][$productId])) {
                                $associatedProductParams['links'] = $params['links'][$productId];
                                unset($associatedProductParams['super_attribute']);
                            }
                            $bundleOptionsQty = [];
                            $bundleOptions = [];
                            $cart->addProduct($product, $associatedProductParams);
                            /*$cart->getQuote()->getItemsCollection()->getLastItem()->addOption([
                                    'code' => 'product_type',
                                    'value' => 'grouped',
                                    'product_id' => intval($params['product'])
                                ]
                            );*/
                            if (!empty($related)) {
                                $cart->addProductsByIds(explode(',', $related));
                            }
                            $qtyCount++;
                        }
                    }
                }
            }

            $params = $this->getRequest()->getParams();
            if (isset($params['qty'])) {
                $filter = new \Zend_Filter_LocalizedToNormalized(
                    ['locale' => $this->_objectManager->get('Magento\Framework\Locale\ResolverInterface')->getLocale()]
                );
                $params['qty'] = $filter->filter($params['qty']);
            }

            $product = $this->_initProduct();
            $related = $this->getRequest()->getParam('related_product');

            /**
             * Check product availability
             */
            if (!$product) {
                return $this->goBack();
            }
            if (!empty($related)) {
                $this->cart->addProductsByIds(explode(',', $related));
            }

            $this->cart->save();

            /**
             * @todo remove wishlist observer \Magento\Wishlist\Observer\AddToCart
             */
            $this->_eventManager->dispatch(
                'checkout_cart_add_product_complete',
                ['product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse()]
            );

            if (!$this->_checkoutSession->getNoCartRedirect(true)) {
                if (!$this->cart->getQuote()->getHasError()) {
                    $message = __(
                        'You added %1 to your shopping cart.',
                        $product->getName()
                    );
                    $this->messageManager->addSuccessMessage($message);
                }
                return $this->goBack(null, $product);
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            if ($this->_checkoutSession->getUseNotice(true)) {
                $this->messageManager->addNotice(
                    $this->_objectManager->get('Magento\Framework\Escaper')->escapeHtml($e->getMessage())
                );
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                    $this->messageManager->addError(
                        $this->_objectManager->get('Magento\Framework\Escaper')->escapeHtml($message)
                    );
                }
            }

            $url = $this->_checkoutSession->getRedirectUrl(true);

            if (!$url) {
                $cartUrl =   $this->resultRedirectFactory->create()->setPath('*/*/');
                $url = $this->_redirect->getRedirectUrl($cartUrl);
            }

            return $this->goBack();

        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('We can\'t add this item to your shopping cart right now.'));
            $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
            return $this->goBack();
        }
    }
}