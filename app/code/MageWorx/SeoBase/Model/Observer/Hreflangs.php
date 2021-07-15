<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace MageWorx\SeoBase\Model\Observer;

use Magento\Framework\View\Page\Config;
use MageWorx\SeoBase\Model\HreflangsFactory as HreflangsFactory;

/**
 * Observer class for hreflang URLs
 */
class Hreflangs implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \MageWorx\SeoBase\Model\HreflangFactory
     */
    protected $hreflangsFactory;

    /**
     * @var \Magento\Framework\View\Page\Config
     */
    protected $pageConfig;

    /**
     * Hreflangs constructor.
     *
     * @param Config $pageConfig
     * @param HreflangsFactory $hreflangsFactory
     */
    public function __construct(
        Config $pageConfig,
        HreflangsFactory $hreflangsFactory
    ) {
        $this->pageConfig       = $pageConfig;
        $this->hreflangsFactory = $hreflangsFactory;
    }

    /**
     * Set hreflang URLs to page config
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $fullActionName = $observer->getFullActionName();

        $arguments     = ['layout' => $observer->getLayout(), 'fullActionName' => $fullActionName];
        $hreflangModel = $this->hreflangsFactory->create($fullActionName, $arguments);

        if (!$hreflangModel) {
            return;
        }

        $hreflangUrls = $hreflangModel->getHreflangUrls();

        if (!$hreflangUrls) {
            return;
        }

        foreach ($hreflangUrls as $code => $hreflangUrl) {
            $this->pageConfig->addRemotePageAsset(
                $hreflangUrl,
                'alternate',
                ['attributes' => ['rel' => 'alternate', 'hreflang' => $code]]
            );
        }
    }
}
