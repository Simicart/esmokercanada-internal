<?php
/**
 * Created by Magenest
 * User: Eric Quach
 * Date: 30/09/2015
 * Time: 10:25
 */

namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Rule\Add;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Email implements \Magento\Framework\Data\Form\Element\Renderer\RendererInterface
{

    public $type;


    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        return '<input type="text" data-role="mail-element">';
    }
}
