<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Webpos
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

namespace Magestore\Webpos\Block\Adminhtml\Zreport;

class Prints extends \Magestore\Webpos\Block\Adminhtml\AbstractBlock
{
//    protected function _construct()
//    {
//        die('222');
//    }

    public function getZreportData(){
        $shiftRepository = $this->_objectManager->create('Magestore\Webpos\Model\Shift\ShiftRepository');
        $id = $this->getRequest()->getParam('id');
        $data = $shiftRepository->getInfo($id);
        $onlyprint = $this->getRequest()->getParam('onlyprint');
        $difference = $this->getRequest()->getParam('difference');
        $theoreticalClosingBalance = $this->getRequest()->getParam('theoretical_closing_balance');
        $realClosingBalance = $this->getRequest()->getParam('real_closing_balance');
        $closedAt = $this->getRequest()->getParam('closed_at');
        $data['onlyprint'] = ($onlyprint == 1)?true:false;
        if($data['status'] != 1){
            if(!empty($realClosingBalance)){
                $data['closed_amount'] = $realClosingBalance;
            }
            if(!empty($closedAt)){
                $data['closed_at'] = $closedAt;
            }
        }
        if(empty($theoreticalClosingBalance)){
            $theoreticalClosingBalance = floatval($data['cash_added']) - floatval($data['cash_removed']) + floatval($data['closed_amount']);
        }
        if(empty($difference)){
            $difference = floatval($data['closed_amount']) - floatval($theoreticalClosingBalance);
        }
        $data['theoretical_closing_balance'] = $theoreticalClosingBalance;
        $data['difference'] = $difference;
        return $data;
    }

    public function formatReportPrice($price){
        $helper = $this->_objectManager->get('Magestore\Webpos\Helper\Data');
        return $helper->formatPrice($price);
    }

    public function formatReportDate($date){
        $helper = $this->_objectManager->get('Magestore\Webpos\Helper\Data');
        return $helper->formatDate($date);
    }
}