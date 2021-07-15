<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 20/05/2016
 * Time: 08:53
 */

namespace Magenest\UltimateFollowupEmail\Helper;

use Magenest\UltimateFollowupEmail\Model\Mail;
use Magento\Framework\App\ObjectManager;
use Mandrill_Error;
use Psr\Log\LoggerInterface as Logger;

class Connector extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLE = 'ultimatefollowupemail/mandrill/enable';
    const XML_PATH_APIKEY = 'ultimatefollowupemail/mandrill/api_key';

    protected $scopeConfig;


    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
    
        parent::__construct($context);
        $this->scopeConfig = $context->getScopeConfig();
    }//end __construct()


    /**
     * get information that mandrill is enable or not
     *
     * @return boolean
     */
    public function getEnableMandrill()
    {
        $enable = $this->scopeConfig->getValue(self::XML_PATH_ENABLE);

        if ($enable === '1') {
            return true;
        } else {
            return false;
        }
    }//end getEnableMandrill()


    /**
     *
     */
    public function getUserInformation()
    {
        $userInfo = null;
        $apiKey = $this->scopeConfig->getValue(self::XML_PATH_APIKEY);
        if (!$apiKey) {
            return "No API key.";
        }
        if (!class_exists("Mandrill")) {
            return "Mandrill is not installed, please install Mandrill via composer.";
        }
        $mandrill = new \Mandrill($apiKey);
        try {
            $userInfo = $mandrill->users->info();
        } catch (Mandrill_Error $me) {
            $this->_logger->debug($me->getMessage());
        } catch (\Exception $e) {
            $this->_logger->debug($e->getMessage());
        }
        if ($userInfo == null) {
            $userInfo = "Your API key is incorrect.";
        }
        return $userInfo;
    }//end getUserInformation()


    public function sendEmail(\Magenest\UltimateFollowupEmail\Model\Mail $mail)
    {
        $apiKey = $this->scopeConfig->getValue(self::XML_PATH_APIKEY);
        if (!$apiKey) {
            return;
        }

        try {
            /** @var  \Magento\Email\Model\Template\SenderResolver $_senderResolver */
            $_senderResolver = \Magento\Framework\App\ObjectManager::getInstance()->create(\Magento\Email\Model\Template\SenderResolver::class);

            $result = $_senderResolver->resolve($this->scopeConfig->getValue(Mail::XML_PATH_EMAIL_SENDER));
            $mandrill = new \Mandrill($apiKey);
            $message = [
                'subject' => $mail->getData('subject'),
                'from_name' => $result['name'],
                'from_email' => $result['email'],

            ];

            $message['to'][] = ['email' => $mail->getData('recipient_email')];

            if ($mail->getData('bcc_email')) {
                $message['to'][] = [
                    'email' => $mail->getData('bcc_email'),
                    'type' => 'bcc',
                ];
            }

            $attachedFiles = unserialize($mail->getData('attachments'));

            if (is_array($attachedFiles) && !empty($attachedFiles)) {
                $objectManager = ObjectManager::getInstance();
                /** @var \Magento\Framework\App\Filesystem\DirectoryList $dir */
                $dir = $objectManager->get('\Magento\Framework\App\Filesystem\DirectoryList');
                /** @var \Magento\Catalog\Model\Product\Media\Config $mediaConfig */
                $mediaConfig = $objectManager->get('Magento\Catalog\Model\Product\Media\Config');
                /** @var \Magento\Framework\Filesystem\Io\File $fileReader */
                $fileReader = $objectManager->get('\Magento\Framework\Filesystem\Io\File');
                $mediaPath = $dir->getPath('media');
                $attachments = [];
                $images = [];
                foreach ($attachedFiles as $attachFileTypes) {
                    if (!is_array($attachFileTypes)) {
                        break;
                    }
                    foreach ($attachFileTypes as $file) {
                        if (!isset($file['file'])) {
                            continue;
                        }
                        $filepath = $mediaPath . '/' . $mediaConfig->getTmpMediaPath($file['file']);
                        $body = $fileReader->read($filepath);
                        if (!$body) {
                            \Magento\Framework\App\ObjectManager::getInstance()->create('Psr\Log\LoggerInterface')->debug('Could not read attachment file for mail ' . $this->getId());
                            continue;
                        }
                        $info = pathinfo($file['file']);
                        if (!isset($info['extension'])) {
                            continue;
                        }
                        switch ($info['extension']) {
                            case 'gif':
                                $type = 'image/gif';
                                break;
                            case 'jpg':
                            case 'jpeg':
                                $type = 'image/jpg';
                                break;
                            case 'png':
                                $type = 'image/png';
                                break;
                            case 'pdf':
                                $type = 'application/pdf';
                                break;
                            case 'txt':
                                $type = 'text/plain';
                                break;
                            default:
                                $type = 'application/octet-stream';
                        }
                        switch ($info['extension']) {
                            case 'gif':
                            case 'jpg':
                            case 'jpeg':
                            case 'png':
                                $images[] = [
                                    'type' => $type,
                                    'name' => $file['label'],
                                    'content' => base64_encode($body)
                                ];
                                break;
                            default:
                                $attachments[] = [
                                    'type' => $type,
                                    'name' => $file['label'],
                                    'content' => base64_encode($body)
                                ];
                        }
                    }
                }
            }
            if (isset($images)) {
                $message['images'] = $images;
            }
            if (isset($attachments)) {
                $message['attachments'] = $attachments;
            }
            $message['html'] = $mail->getData('content');

            $result = $mandrill->messages->send($message);
            if (isset($result[0]['status']) && ($result[0]['status'] == 'sent' || $result[0]['status'] == 'queued')) {
                $mail->setStatus(Mail::STATUS_SENT);
                $mail->setLog('Ok');
                $mail->save();
            } else {
                $errorCode = isset($result[0]['reject_reason']) ? $result[0]['reject_reason'] : 'unable to retrieve error code';
                throw new \Exception("Mandrill email rejected, error code: " . $errorCode);
            }
        } catch (\Exception $e) {
            $mail->setStatus(Mail::STATUS_FAIL);
            $mail->setLog($e->getMessage());
            $mail->save();
        }
        return;
    }//end sendEmail()
}//end class
