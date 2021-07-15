<?php
namespace Magebees\Urlrewrite\Controller\Adminhtml\Importurlrewrite;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class Import extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $mappings = [];
    
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();
        $files =  $this->getRequest()->getFiles();
        if (isset($files['filename']['name']) && $files['filename']['name'] != '') {
            try {
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'filename']);
                $allowed_ext_array = ['csv'];
                $uploader->setAllowedExtensions($allowed_ext_array);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                    ->getDirectoryRead(DirectoryList::VAR_DIR);
                $result = $uploader->save($mediaDirectory->getAbsolutePath('import/'));
                $path = $mediaDirectory->getAbsolutePath('import');
            } catch (\Exception $e) {
                $this->messageManager->addError(__($e->getMessage()));
                $this->_redirect('*/*/index');
                return;
            }
                    
            $filename = $path.$result['file'];
            $id = fopen($path.$result['file'], 'r');
            $data = fgetcsv($id, filesize($filename));
            if (!$this->mappings) {
                $this->mappings = $data;
            }
         
            while ($data = fgetcsv($id, filesize($filename))) {
                if ($data[0]) {
                    try {
                        $converted_data['entity_id'] = 0;
                        $converted_data['entity_type'] = 'custom';
                        $converted_data['redirect_type'] = '301';
                        if ($converted_data['entity_type'] == '') {
                            $converted_data['entity_type'] = 'custom';
                        }
                        if ($converted_data['entity_id'] == '') {
                            $converted_data['entity_id'] = '0';
                        }
                        $converted_data['description'] = '';
                        foreach ($data as $key => $value) {
                            $converted_data[$this->mappings[$key]] = addslashes($value);
                        }
                        
                        $validateRequestPath = $this->_objectManager->get('Magento\UrlRewrite\Helper\UrlRewrite')->validateRequestPath($converted_data['request_path']);
                        
                        if ($validateRequestPath) {
                            $urlRewriteModel = $this->_objectManager->create('Magento\UrlRewrite\Model\UrlRewrite');
                            
                            $urlRewritexit = $urlRewriteModel->getCollection()->addFieldToFilter('store_id', $converted_data['store_id'])->addFieldToFilter('request_path', $converted_data['request_path'])->getFirstItem();
                            if ($urlRewritexit->getId()) {
                                $urlRewriteModel->load($urlRewritexit->getId());
                            }
                            $urlRewriteModel->setStoreId($converted_data['store_id']);
                            $urlRewriteModel->setEntityId($converted_data['entity_id']);
                            $urlRewriteModel->setEntityType($converted_data['entity_type']);
                            $urlRewriteModel->setRedirectType($converted_data['redirect_type']);
                            $urlRewriteModel->setRequestPath($converted_data['request_path']);
                            $urlRewriteModel->setTargetPath($converted_data['target_path']);
                            $urlRewriteModel->setDescription($converted_data['description']);
                            $urlRewriteModel->save();
                        }
                    } catch (\Exception $e) {
                        $error[] = "<div class='message message-error error'><div data-ui-id='messages-message-error'>".'Request Path == '.$converted_data['request_path'].' ==>'.$e->getMessage()."</div></div>";
                    }
                }
            }
            fclose($id);
        }
        if (!empty($error)) {
            $this->getResponse()->representJson($this->_objectManager->get('Magento\Framework\Json\Helper\Data')->jsonEncode($error));
            return;
        }
        $result = "<div class='message message-success success'><div data-ui-id='messages-message-success'>URL Rewrites were successfully Imported</div></div>";
        $this->getResponse()->representJson($this->_objectManager->get('Magento\Framework\Json\Helper\Data')->jsonEncode($result));
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magebees_Urlrewrite::import');
    }
}
