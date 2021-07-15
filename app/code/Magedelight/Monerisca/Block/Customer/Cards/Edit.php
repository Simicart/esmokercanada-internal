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

class Edit extends \Magedelight\Monerisca\Block\Customer\Monerisca
{

    /**
     * @return type
     */
    public function getCard()
    {
        $cardId = $this->getRequest()->getPostValue('card_id');
        if (!empty($cardId)) {
            $cardModel = $this->cardsFactory->create();
            $cardModel->getResource()->load($cardModel, $cardId);
            return $cardModel;
        } else {
            return;
        }
    }

    /**
     * get save url
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/update');
    }
}
