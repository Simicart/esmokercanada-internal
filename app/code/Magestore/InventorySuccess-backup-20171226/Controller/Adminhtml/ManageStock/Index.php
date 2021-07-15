<?php
/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\InventorySuccess\Controller\Adminhtml\ManageStock;

use Magento\Framework\App\ResponseInterface;

class Index extends \Magestore\InventorySuccess\Controller\Adminhtml\AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magestore_InventorySuccess::warehouse_stock_view';

    /**
     * @var \Magestore\InventorySuccess\Controller\Adminhtml\Context
     */
    protected $_context;

    public function __construct(
        \Magestore\InventorySuccess\Controller\Adminhtml\Context $context
    ){
        parent::__construct($context);
        $this->_context = $context;
    }

    /**
     * Init layout, menu and breadcrumb
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->_context->getResultPageFactory()->create();
        $resultPage->setActiveMenu('Magestore_InventorySuccess::warehouse_stock_view');
        $resultPage->addBreadcrumb(__('Manage Stock'), __('Manage Stock'));
        $resultPage->addBreadcrumb(__('Manage Stock'), __('Manage Stock'));
        return $resultPage;
    }
    
    /**
     * Manage Stock page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        /*
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $tableName = $resource->getTableName('cataloginventory_stock_item');
        $sql = "Select * FROM " . $tableName." where website_id = 2;";
        $sql1 = '';
        $productIds = $connection->fetchAll($sql);
            foreach ($productIds as $productId){
                 $sql1 .= "UPDATE ".$tableName." SET qty = ".$productId['qty'].", total_qty = ".$productId['total_qty']."  where product_id = ".$productId['product_id']." and website_id = 0;";
                
            }
        $connection->query($sql);
        die;
        */
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();

        $resultPage->getConfig()->getTitle()->prepend(__('Manage Stock'));
        $resultPage->getConfig()->getTitle()
            ->prepend(__('Manage Stock'));

        return $resultPage;
    }
}