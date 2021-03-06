<?php
namespace Magebees\Urlrewrite\Controller\Adminhtml\Exporturlrewrite;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\DriverInterface;

class Export extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
   
    public function execute()
    {
        $filesystem = $this->_objectManager->get('Magento\Framework\Filesystem');
        $extvardir = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $exportdir = '/export';
        $extvardir->create($exportdir);
        $extvardir->changePermissions($exportdir, DriverInterface::WRITEABLE_DIRECTORY_MODE);
        $export_file_name = "exporturlrewrites_".date('m-d-Y_h-i-s', time()).".csv";
        $storeid = $this->getRequest()->getParam('storeid');
        $url301 = $this->getRequest()->getParam('url301');
        $urltype = $this->getRequest()->getParam('urltype');
             
        if ($storeid > 0) {
            $UrlRewrites = $this->_objectManager->create('Magento\UrlRewrite\Model\UrlRewrite')->getCollection()->addFieldToFilter('store_id', $storeid);
            if ($url301) {
                $UrlRewrites->addFieldToFilter('redirect_type', '301');
            }
            if ($urltype != "all") {
                $UrlRewrites->addFieldToFilter('entity_type', $urltype);
            }
        } else {
            $UrlRewrites = $this->_objectManager->create('Magento\UrlRewrite\Model\UrlRewrite')->getCollection();
            if ($url301) {
                $UrlRewrites->addFieldToFilter('redirect_type', '301');
            }
            if ($urltype != "all") {
                $UrlRewrites->addFieldToFilter('entity_type', $urltype);
            }
        }
        $urldata = $UrlRewrites->getData();
        if (empty($urldata)) {
            $result = "<div class='message message-error error'><div data-ui-id='messages-message-error'>No Records Found</div></div>";
            $this->getResponse()->representJson($this->_objectManager->get('Magento\Framework\Json\Helper\Data')->jsonEncode($result));
        } else {
            $finaldata = [];
            foreach ($UrlRewrites as $urlRewrite) {
                $urlRewrite = $urlRewrite->getData();
                unset($urlRewrite['metadata']);
                unset($urlRewrite['url_rewrite_id']);
                unset($urlRewrite['is_autogenerated']);
                array_push($finaldata, $urlRewrite);
            }
            $header = [];
            foreach ($finaldata as $data) {
                foreach (array_keys($data) as $k => $v) {
                    $header[$v] = $v;
                }
            }
            $filePath = $filesystem->getDirectoryRead(DirectoryList::VAR_DIR)
            ->getAbsolutePath("export/").$export_file_name;
            
            $files = fopen($filePath, "a");
            fputCsv($files, array_keys($header));
            fclose($files);

            $files = fopen($filePath, "a");
            foreach ($finaldata as $data) {
                $o_data=array_fill_keys(array_values($header), '');
                foreach ($data as $o_key => $o_val) {
                    if (in_array($o_key, $header)) {
                        $o_data[$o_key]=$o_val;
                    }
                }
                fputcsv($files, array_values($o_data));
            }
            fclose($files);

            $download_path=$this->getUrl('*/*/downloadexportedfile', ["file"=>$export_file_name]);
            $result = "";
            $result = "<div class='message message-success success'><div data-ui-id='messages-message-success'>Generated csv File : <b style='font-size:12px'><a href='".$download_path."' target='_blank'>".$export_file_name."</a></b></div></div>";
                    
            $this->getResponse()->representJson($this->_objectManager->get('Magento\Framework\Json\Helper\Data')->jsonEncode($result));
        }
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magebees_Urlrewrite::export');
    }
}
