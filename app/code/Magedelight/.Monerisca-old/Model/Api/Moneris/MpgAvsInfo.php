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

class MpgAvsInfo
{
    public $params;
    public $avsTemplate = ['avs_street_number','avs_street_name','avs_zipcode','avs_email'
        ,'avs_hostname','avs_browser','avs_shiptocountry','avs_shipmethod','avs_merchprodsku'
        ,'avs_custip','avs_custphone'];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function toXML()
    {
        $xmlString = "";
        foreach ($this->avsTemplate as $tag) {
            //will only add to the XML the tags from the template that were also passed in by the merchant
            if (array_key_exists($tag, $this->params)) {
                $xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
            }
        }

        return "<avs_info>$xmlString</avs_info>";
    }
}
