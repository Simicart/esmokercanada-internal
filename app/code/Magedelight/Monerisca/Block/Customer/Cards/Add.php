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

namespace Magedelight\Monerisca\Block\Customer\Cards;

class Add extends \Magedelight\Monerisca\Block\Customer\Monerisca
{

    /**
     * get back url
     * @return type
     */
    public function getBackUrl()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/listing');
    }

    /**
     * get save url
     * @return type
     */
    public function getSaveUrl()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/save');
    }
}
