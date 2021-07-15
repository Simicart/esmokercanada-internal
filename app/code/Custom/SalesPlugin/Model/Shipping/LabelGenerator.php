<?php
namespace Custom\SalesPlugin\Model\Shipping;

class LabelGenerator extends \Magento\Shipping\Model\Shipping\LabelGenerator
{
    /**
     * Overriden method
     * Create \Zend_Pdf_Page instance with image from $imageString. Supports JPEG, PNG, GIF, WBMP, and GD2 formats.
     *
     * @param string $imageString
     * @return \Zend_Pdf_Page|false
     */
    public function createPdfPageFromImageString($imageString)
    {
        /** @var \Magento\Framework\Filesystem\Directory\Write $directory */
        $directory = $this->filesystem->getDirectoryWrite(
            \Magento\Framework\App\Filesystem\DirectoryList::TMP
        );
        $directory->create();
        $image = @imagecreatefromstring($imageString);
        if (!$image) {
            return false;
        }

        $xSize = imagesx($image);
        $ySize = imagesy($image);
        
        $page = new \Zend_Pdf_Page($xSize-200, $ySize);

        imageinterlace($image, 0);
        $tmpFileName = $directory->getAbsolutePath(
            'shipping_labels_' . uniqid(\Magento\Framework\Math\Random::getRandomNumber()) . time() . '.png'
        );
        imagepng($image, $tmpFileName);
        $pdfImage = \Zend_Pdf_Image::imageWithPath($tmpFileName);
        $page->drawImage($pdfImage, 0, 0, $xSize, $ySize);
        $directory->delete($directory->getRelativePath($tmpFileName));
        if (is_resource($image)) {
            imagedestroy($image);
        }
        return $page;
    }
}
