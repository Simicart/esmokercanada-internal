<?php
namespace Magebees\Urlrewrite\Block\Adminhtml;

class Export extends \Magento\Backend\Block\Template
{
    protected $storedata;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\System\Store $storedata
    ) {
        parent::__construct($context);
        $this->storedata = $storedata;
    }
    
    public function getStoreData()
    {
        return $this->storedata->getStoreValuesForForm(false, true);
    }
}
