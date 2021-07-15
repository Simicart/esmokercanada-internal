<?php
namespace Custom\Design\Block;
 
/**
* Customtemplate block
*/
class Customtemplate extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}
    
    /**
     * Get Store code
     *
     * @return string
     */
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }
    
    /**
     * Get Store code
     *
     * @return string
     */
    public function getStaticBlockPrefix()
    {
        if ($this->getStoreCode() === "default") {
            return "es";
        }
        if ($this->getStoreCode() === "premiumlabsontario_view") {
            return "plo";
        }
        return "";
    }
}
