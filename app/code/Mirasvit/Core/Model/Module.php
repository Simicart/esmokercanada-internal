<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-core
 * @version   1.2.34
 * @copyright Copyright (C) 2017 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\Core\Model;

use Magento\Framework\Module\FullModuleList;
use Magento\Framework\Module\Dir\Reader as DirReader;

class Module
{
    /**
     * @var array
     */
    private static $modules = null;

    /**
     * @var FullModuleList
     */
    protected $fullModuleList;

    /**
     * @var DirReader
     */
    protected $dirReader;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $moduleName;

    /**
     * @var string
     */
    protected $installedVersion;

    /**
     * @var string
     */
    protected $latestVersion;

    /**
     * @var string
     */
    protected $url;

    public function __construct(
        FullModuleList $fullModuleList,
        DirReader $dirReader
    ) {
        $this->fullModuleList = $fullModuleList;
        $this->dirReader = $dirReader;
    }

    /**
     * @return array
     */
    public function getAllModules()
    {
        if (self::$modules == null) {
            self::$modules = json_decode(@file_get_contents('http://mirasvit.com/pc/modules/'), true);

            if (!is_array(self::$modules)) {
                self::$modules = [];
            }
        }

        return self::$modules;
    }

    /**
     * @return array
     */
    public function getInstalledModules()
    {
        $modules = [];
        foreach ($this->fullModuleList->getAll() as $module) {
            if (substr($module['name'], 0, strlen('Mirasvit_')) == 'Mirasvit_') {
                $modules[] = $module['name'];
            }
        }

        return $modules;
    }

    /**
     * @param string $moduleName
     * @return $this
     */
    public function load($moduleName)
    {
        $modules = $this->getAllModules();

        if (key_exists(strtolower($moduleName), $modules)) {
            $m = $modules[strtolower(strtolower($moduleName))];

            $this->moduleName = $moduleName;
            $this->name = $m['name'];
            $this->latestVersion = $m['version'];
            $this->url = $m['url'];

            $composer = $this->getComposerInformation($moduleName);

            if ($composer) {
                $this->installedVersion = $composer['version'];
            }
        }

        return $this;
    }

    /**
     * @param string $moduleName
     * @return array|false
     */
    public function getComposerInformation($moduleName)
    {
        $dir = $this->dirReader->getModuleDir("", $moduleName);

        if (file_exists($dir . '/composer.json')) {
            return json_decode(file_get_contents($dir . '/composer.json'), true);
        }

        if (file_exists($dir . '/../../composer.json')) {
            return json_decode(file_get_contents($dir . '/../../composer.json'), true);
        }

        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @return string
     */
    public function getInstalledVersion()
    {
        return $this->installedVersion;
    }

    /**
     * @return string
     */
    public function getLatestVersion()
    {
        return $this->latestVersion;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}