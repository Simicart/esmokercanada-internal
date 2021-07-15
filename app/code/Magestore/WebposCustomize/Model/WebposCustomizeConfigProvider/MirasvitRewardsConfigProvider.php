<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Model\WebposCustomizeConfigProvider;

/**
 * Class MirasvitRewardsConfigProvider
 * @package Magestore\WebposCustomize\Model\WebposCustomizeConfigProvider
 */
class MirasvitRewardsConfigProvider implements \Magestore\Webpos\Model\WebposConfigProvider\ConfigProviderInterface {

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $_moduleManager;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Module\Manager $moduleManager
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_moduleManager = $moduleManager;
    }

    public function getConfig() {
        $results = [];
        $configs = [];

        if ($this->_moduleManager->isEnabled('Mirasvit_Rewards')) {
            $configs = $this->_scopeConfig->getValue('rewards', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        }
        /* convert configs to flat path */
        if($configs) {
            foreach ($configs as $index => $subConfigs) {
                foreach ($subConfigs as $subIndex => $value) {
                    $results['rewards/' . $index . '/' . $subIndex] = $value;
                }
            }
        }

        return $results;
    }
}