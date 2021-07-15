<?php

namespace Custom\SalesPlugin\Plugin\Sales\Controller\Adminhtml\Order\Create;

use Magento\Backend\Model\Session\Quote as BackendSessionQuote;
use Magento\Store\Model\StoreManagerInterface;

class Save
{
    protected $backendSessionQuote;

    protected $storeManagerInterface;

    public function __construct(
        BackendSessionQuote $backendSessionQuote,
        StoreManagerInterface $storeManagerInterface
    ) {
        $this->backendSessionQuote = $backendSessionQuote;
        $this->storeManagerInterface = $storeManagerInterface;
    }

    public function beforeExecute(
        \Magento\Sales\Controller\Adminhtml\Order\Create\Save $subject
    ) {
        
        $this->storeManagerInterface->setCurrentStore($this->backendSessionQuote->getQuote()->getStoreId());
        return;
    }
}