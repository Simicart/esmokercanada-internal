<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Block;

/**
 * Class Container
 * @package Magestore\WebposCustomize\Block
 */
class Container extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data
    ) {
        parent::__construct($context, $data);
    }
}