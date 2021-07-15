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

class Config extends \Magento\Framework\Config\Data implements
    \Magedelight\Monerisca\Model\Payment\ConfigInterface
{
    /**
     * @var Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * @param \Magento\Payment\Model\Config\Reader $reader
     * @param \Magento\Framework\Config\CacheInterface $cache
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param string $cacheId
     */
    public function __construct(
        \Magento\Payment\Model\Config\Reader $reader,
        \Magento\Framework\Config\CacheInterface $cache,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        $cacheId = 'payment_config'
    ) {
        $this->scopeConfig                      = $scopeConfig;
        parent::__construct($reader, $cache, $cacheId);
    }

    public function getCreditCardTypeInfo()
    {
        return $this->get();
    }
}
