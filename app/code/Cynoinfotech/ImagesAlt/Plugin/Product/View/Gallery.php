<?php
/**
 * @author Cynoinfotech Team
 * @package Cynoinfotech_ImagesAlt
 */
namespace Cynoinfotech\ImagesAlt\Plugin\Product\View;

class Gallery
{

    protected $_helper;
    protected $_category;
     
    public function __construct(
        \Cynoinfotech\ImagesAlt\Helper\Data $helper,
        \Magento\Catalog\Model\Category $category
    ) {
        $this->_helper = $helper;
        $this->_category = $category;
    }
        
    public function afterGetGalleryImages($product, $images)
    {
        if ($this->_helper->getConfig('cynoinfotech_imagesalt/general/enable')) {
            $product = $product->getProduct();
            $structure=$this->_helper->getConfig('cynoinfotech_imagesalt/general/imagealt_structure');
            
            if ($images instanceof \Magento\Framework\Data\Collection) {
                $inc=1;
                
                foreach ($images as $image) {
                    $altLabel = str_replace('{product_name}', $product->getName(), $structure);
                    $altLabel = str_replace('{product_sku}', $product->getSku(), $altLabel);
                    $altLabel = str_replace('{product_price}', $product->getPrice(), $altLabel);
                    $altLabel = str_replace('{auto_increment_number}', $inc, $altLabel);
                    
                    $categories = $product->getCategoryIds();
                    
                    foreach ($categories as $category) {
                        $cat = $this->_category->load($category);
                        $cat_name[]=$cat->getName();
                    }
                    if (isset($cat_name) && !empty($cat_name)) {
                        $category_name=implode(' ', $cat_name);
                        $altLabel = str_replace('{category_name}', $category_name, $altLabel);
                    }
                    
                    $inc++;
                    
                    $image->setLabel($altLabel);
                }
            }
        }
 
        return $images;
    }
}
