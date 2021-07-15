<?php
/**
 * @author Cynoinfotech Team
 * @package Cynoinfotech_ImagesAlt
 */
namespace Cynoinfotech\ImagesAlt\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getConfig($configPath)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
