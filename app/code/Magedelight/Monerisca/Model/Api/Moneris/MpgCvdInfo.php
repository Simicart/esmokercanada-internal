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

class MpgCvdInfo
{
    public $params;
    public $cvdTemplate = ['cvd_indicator','cvd_value'];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function toXML()
    {
        $xmlString = "";

        foreach ($this->cvdTemplate as $tag) {
            $xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
        }

        return "<cvd_info>$xmlString</cvd_info>";
    }
}
