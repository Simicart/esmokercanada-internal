<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Observer;

use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order\Address;

class UpdateCustomerAddressFormat implements ObserverInterface
{
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var DataObject $formatType */
        $formatType = $observer->getType();

        /** @var Address $address */
        $address = $observer->getAddress();

        if ($address->getAddressType() == 'shipping') {
            $format = $this->getFormat($address, $formatType);
            if (!$formatType->getOriginalFormat()) {
                $formatType->setOriginalFormat($formatType->getDefaultFormat());
            }
            $formatType->setDefaultFormat($format);
        } elseif ($format = $formatType->getOriginalFormat()) {
            $formatType->setDefaultFormat($format);
        }
    }

    /**
     * @param $address
     * @param $formatType
     * @return string
     */
    protected function getFormat($address, $formatType)
    {
        $format = $delimiter = '';
        if ($address->getCanadaDpoId()) {
            $delimiter = $formatType->getCode() == 'html' ? '<br />' : ', ';
            if ($address->getCanadaDpoAddress()) {
                $format = $this->getFormatAddress($formatType->getCode());
            } else {
                $format = $this->getFormatOfficeId($formatType->getCode());
            }
        }

        if ($this->getPosition() == 'top') {
            $format = $format . $delimiter . $formatType->getDefaultFormat();
        } else {
            $format = $formatType->getDefaultFormat() . $delimiter . $format;
        }

        return $format;
    }

    /**
     * @param $code
     * @return string
     */
    protected function getFormatAddress($code)
    {
        switch ($code) {
            case 'html':
                $format = '{{depend canada_dpo_address}}<b>Post Office</b>: {{var canada_dpo_address}}{{/depend}}';
                break;
            case 'text':
            case 'oneline':
            case 'pdf':
            default:
                $format = '{{depend canada_dpo_address}}Post Office: {{var canada_dpo_address}}{{/depend}}';
                break;
        }

        return $format;
    }

    /**
     * @param $code
     * @return string
     */
    protected function getFormatOfficeId($code)
    {
        $link = '<a href="https://www.canadapost.ca/cpotools/apps/fpo/personal/findPostOfficeDetail?outletId={{var canada_dpo_id}}" target="_blank">{{var canada_dpo_id}}</a>';

        switch ($code) {
            case 'html':
                $format = '{{depend canada_dpo_id}}<b>Post Office ID</b>: {{var canada_dpo_id}}{{/depend}}';
                break;
            case 'text':
            case 'oneline':
            case 'pdf':
            default:
                $format = '{{depend canada_dpo_id}}Post Office ID: {{var canada_dpo_id}}{{/depend}}';
                break;
        }

        return $format;
    }

    /**
     * @return string
     */
    protected function getPosition()
    {
        return 'top';
    }
}
