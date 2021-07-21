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
namespace Magedelight\Monerisca\Plugin\Magento\Backend\Model\Menu;

class Item
{
    public function afterGetUrl($subject, $result)
    {
        $menuId = $subject->getId();
            
        if ($menuId == 'Magedelight_Monerisca::documentation') {
            $result = 'http://docs.magedelight.com/display/MAG/Moneris+Payment+Module+-+Magento+2';
        }
            
        return $result;
    }
}
