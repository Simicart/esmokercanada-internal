<?php
/**
 * Created by Magenest
 * User: Eric Quach
 * Date: 28/10/2015
 * Time: 10:54
 */
namespace Magenest\UltimateFollowupEmail\Model\Mail;

class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{

    protected $body;

    protected $subject;


    public function getMessage()
    {
        return $this->message;
    }


    /**
     * @param $params
     */
    public function createAttachment($params)
    {
        if (!isset($params['name']) || !isset($params['body']) || !isset($params['label'])) {
            return;
        }
        $info = pathinfo($params['name']);
        if (!isset($info['extension'])) {
            return;
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

        $this->message->createAttachment(
            $params['body'],
            $type,
            \Zend_Mime::DISPOSITION_ATTACHMENT,
            \Zend_Mime::ENCODING_BASE64,
            $params['label']
        );

        return;
    }


    public function prepare()
    {
        return $this->prepareMessage();
    }


    public function setMessageContent($body, $subject)
    {
        $this->body    = $body;
        $this->subject = $subject;
    }


    /**
     * Prepare message
     *
     * @return $this
     */
    protected function prepareMessage()
    {
        $this->message->setMessageType('text/html')->setBody($this->body)->setSubject($this->subject);

        return $this;
    }
}
