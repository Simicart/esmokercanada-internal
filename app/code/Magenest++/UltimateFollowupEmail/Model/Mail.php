<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 15/10/2015
 * Time: 10:19
 */

namespace Magenest\UltimateFollowupEmail\Model;

use Magenest\UltimateFollowupEmail\Model\ResourceModel\Mail as ResourceModel;
use Magenest\UltimateFollowupEmail\Model\ResourceModel\Mail\Collection;
use Magento\Framework\App\ObjectManager;

class Mail extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'ultimatefollowupemail_mail';

    const STATUS_PENDING = 1;
    const STATUS_SENT = 2;
    const STATUS_FAIL = 3;
    const STATUS_CANCELLED = 4;

    const XML_PATH_EMAIL_SENDER = 'ultimatefollowupemail/general/email_identity';


    /**
     * Types of template
     */
    const TYPE_TEXT = 1;

    const TYPE_HTML = 2;

    protected $_vars = [];

    /**
     * @var \Magento\Framework\Encryption\EncryptorInterface
     */
    protected $_encryptor;

    /**
     * @var \Magento\Newsletter\Model\Queue\TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var \Magenest\UltimateFollowupEmail\Model\Mail\TransportBuilder
     */
    protected $_magenestTransportBuilder;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    protected $_file;


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ResourceModel $resource,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        Collection $resourceCollection,
        \Magento\Framework\Filesystem\Io\File $file,
        \Magento\Newsletter\Model\Queue\TransportBuilder $transportBuilder,
        \Magenest\UltimateFollowupEmail\Model\Mail\TransportBuilder $mntransportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
    
        $this->_encryptor = $encryptor;

        $this->_transportBuilder = $transportBuilder;

        $this->_magenestTransportBuilder = $mntransportBuilder;

        $this->_scopeConfig = $scopeConfig;

        $this->_storeManager = $storeManager;

        $this->_file = $file;

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }//end __construct()


    public function getIsRuleProcessed($rule_id, $key)
    {
        return $this->getResource()->getIsRuleProcessed($rule_id, $key);
    }//end getIsRuleProcessed()


    public function getStoreId()
    {
        if ($this->getData('store_id')) {
            return $this->getData('store_id');
        } else {
            return 1;
        }
    }//end getStoreId()


    public function afterLoad()
    {
        // set var for the email to prepare for send
        parent::afterLoad();
        return $this;
    }//end afterLoad()


    public function getVars()
    {
        return $this->_vars;
    }//end getVars()


    public function setVars(array $var)
    {
        $this->_vars = $var;
    }//end setVars()


    /**
     * Send email
     */
    public function send()
    {
        try {
            $this->sendMail();
            $this->setStatus(self::STATUS_SENT);
            $this->setLog('Ok');
            $this->save();
        } catch (\Exception $e) {
            $this->setStatus(self::STATUS_FAIL);
            $this->setLog($e->getMessage());
            $this->save();
        }
    }//end send()


    protected function sendMail()
    {
        $this->_magenestTransportBuilder->setMessageContent(htmlspecialchars_decode($this->getContent()), $this->getSubject());

        $attachments = [];
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        $attachedFiles = unserialize($this->getData('attachments'));

        if (is_array($attachedFiles) && !empty($attachedFiles)) {
            $objectManager = ObjectManager::getInstance();
            /** @var \Magento\Framework\App\Filesystem\DirectoryList $dir */
            $dir = $objectManager->get('\Magento\Framework\App\Filesystem\DirectoryList');
            /** @var \Magento\Catalog\Model\Product\Media\Config $mediaConfig */
            $mediaConfig = $objectManager->get('Magento\Catalog\Model\Product\Media\Config');
            $mediaPath = $dir->getPath('media');
            foreach ($attachedFiles as $attachFileTypes) {
                if (!is_array($attachFileTypes)) {
                    break;
                }
                foreach ($attachFileTypes as $file) {
                    if (!isset($file['file'])) {
                        continue;
                    }
                    $filepath = $mediaPath . '/' . $mediaConfig->getTmpMediaPath($file['file']);
                    $body = $this->_file->read($filepath);
                    if (!$body) {
                        \Magento\Framework\App\ObjectManager::getInstance()->create('Psr\Log\LoggerInterface')->debug('Could not read attachment file for mail '. $this->getId());
                        continue;
                    }
                    $attachments[] = [
                        'body' => $body,
                        'name' => $file['file'],
                        'label' => $file['label']
                    ];
                }
            }
        }

        $this->_magenestTransportBuilder->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->getStoreId(),
            ]
        )->setTemplateVars(
            $this->getVars()
        )->setFrom(
            $this->_scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER, $storeScope)
        )->addTo(
            $this->getRecipientEmail(),
            $this->getRecipientName()
        );

        if ($bccMail = $this->getData('bcc_email')) {
            $this->_magenestTransportBuilder->addBcc($bccMail);
        }

        if ($attachments) {
            foreach ($attachments as $attachment) {
                if ($attachment) {
                    $this->_magenestTransportBuilder->createAttachment($attachment);
                }
            }
        }

        $transport = $this->_magenestTransportBuilder->getTransport();
        $transport->sendMessage();
    }//end sendMail()


    /**
     * cancel the email in the queue
     */
    public function cancel()
    {
        return $this->setStatus(self::STATUS_CANCELLED)->save();
    }//end cancel()
}//end class
