<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Model\Api\Moneris;

class MpgCustInfo
{

    public $level3template = [
            'cust_info' => ['email','instructions',
                    'billing' => ['first_name', 'last_name', 'company_name', 'address',
                           'city', 'province', 'postal_code', 'country',
                           'phone_number', 'fax','tax1', 'tax2','tax3',
                           'shipping_cost'],
                           'shipping' => ['first_name',
                                               'last_name', 'company_name', 'address',
                                               'city', 'province', 'postal_code', 'country',
                                               'phone_number', 'fax','tax1', 'tax2', 'tax3',
                                               'shipping_cost'],
                            'item' =>  ['name', 'quantity', 'product_code', 'extended_amount']
                        ]
                ];

    public $level3data;
    public $email;
    public $instructions;

    public function __construct($custinfo = 0)
    {
        if ($custinfo) {
                $this->setCustInfo($custinfo);
        }
    }

    public function setCustInfo($custinfo)
    {
        $this->level3data['cust_info'] = [$custinfo];
    }

    public function setEmail($email)
    {
        $this->email=$email;
        $this->setCustInfo(['email'=>$email,'instructions'=>$this->instructions]);
    }

    public function setInstructions($instructions)
    {
        $this->instructions=$instructions;

        $this->setCustinfo(['email'=>$this->email,'instructions'=>$instructions]);
    }

    public function setShipping($shipping)
    {
        $this->level3data['shipping']=[$shipping];
    }

    public function setBilling($billing)
    {
        $this->level3data['billing']=[$billing];
    }

    public function setItems($items)
    {
        if (!isset($this->level3data['item'])) {
            $this->level3data['item']=[$items];
        } else {
            $index=count($this->level3data['item']);
            $this->level3data['item'][$index]=$items;
        }
    }

    public function toXML()
    {
        $xmlString=$this->toXMLlow($this->level3template, "cust_info");
        return $xmlString;
    }

    public function toXMLlow($template, $txnType)
    {
        $xmlString = "";
        $level3data_count = count($this->level3data[$txnType]);
         $keys=array_keys($template);
         $keyscount = count($keys);
        for ($x=0; $x<$level3data_count; $x++) {
            if ($x>0) {
                $xmlString .="</$txnType><$txnType>";
            }
           
            for ($i=0; $i < $keyscount; $i++) {
                $tag=$keys[$i];

                if (is_array($template[$keys[$i]])) {
                    $data=$template[$tag];

                    if (!empty($this->level3data[$tag])) {
                        continue;
                    }
                    $beginTag="<$tag>";
                    $endTag="</$tag>";

                    $xmlString .=$beginTag;

                    {
                    $returnString=$this->toXMLlow($data, $tag);
                    $xmlString .= $returnString;
                    }
                    $xmlString .=$endTag;
                } else {
                    $tag=$template[$keys[$i]];
                    $beginTag="<$tag>";
                    $endTag="</$tag>";
                    $data=$this->level3data[$txnType][$x][$tag];
                    $xmlString .=$beginTag.$data .$endTag;
                }
            }//end inner for
        }//end outer for

        return $xmlString;
    }//end
}
