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

namespace Magedelight\Monerisca\Model\Payment;

class Converter implements \Magento\Framework\Config\ConverterInterface
{

    /**
     * Convert dom node tree to array.
     * @param \DOMagedelightocument $source
     * @return array
     * @throws \InvalidArgumentException
     */
    public function convert($source)
    {
        $output = [];
        foreach ($source->getElementsByTagName('payment') as $node) {
            $output[] = $node->textContent;
        }
        return $output;
    }
}
