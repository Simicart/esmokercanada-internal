<?php
namespace Magento\MediaGalleryIntegration\Plugin\SaveImageInformation;

/**
 * Interceptor class for @see \Magento\MediaGalleryIntegration\Plugin\SaveImageInformation
 */
class Interceptor extends \Magento\MediaGalleryIntegration\Plugin\SaveImageInformation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Filesystem $filesystem, \Psr\Log\LoggerInterface $log, \Magento\MediaGalleryApi\Api\IsPathExcludedInterface $isPathExcluded, \Magento\MediaGallerySynchronizationApi\Api\SynchronizeFilesInterface $synchronizeFiles, \Magento\MediaGalleryUiApi\Api\ConfigInterface $config, array $imageExtensions)
    {
        $this->___init();
        parent::__construct($filesystem, $log, $isPathExcluded, $synchronizeFiles, $config, $imageExtensions);
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave(\Magento\Framework\File\Uploader $subject, array $result) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'afterSave');
        return $pluginInfo ? $this->___callPlugins('afterSave', func_get_args(), $pluginInfo) : parent::afterSave($subject, $result);
    }
}
