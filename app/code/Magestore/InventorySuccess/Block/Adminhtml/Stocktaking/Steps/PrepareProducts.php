<?php
/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created by PhpStorm.
 * User: Eden Duong
 * Date: 25/08/2016
 * Time: 9:09 SA
 */
namespace Magestore\InventorySuccess\Block\Adminhtml\Stocktaking\Steps;


/**
 * Class PrepareProducts
 * @package Magestore\InventorySuccess\Block\Adminhtml\Stocktaking\Steps
 */
class PrepareProducts extends  \Magento\Ui\Block\Component\StepsWizard\StepAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getCaption()
    {
        return __('Prepare Products');
    }

}