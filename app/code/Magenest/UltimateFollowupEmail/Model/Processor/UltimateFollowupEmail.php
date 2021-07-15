<?php
/**
 * Created by Magenest
 * User: Eric Quach
 * Date: 30/09/2015
 * Time: 15:42
 */

namespace Magenest\UltimateFollowupEmail\Model\Processor;

use Magenest\UltimateFollowupEmail\Model\Config\Source\UnsubscriberStatus;
use Magenest\UltimateFollowupEmail\Model\Mail;
use Magenest\UltimateFollowupEmail\Model\Rule;
use Magenest\UltimateFollowupEmail\Model\System\Config\Source\Mail\Status;
use Magento\Customer\Model\CustomerFactory;
use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Encryption\Encryptor;
use Magento\Framework\Url;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\Store;

abstract class UltimateFollowupEmail
{
    const XML_PATH_BCC_NAME = 'ultimatefollowupemail/general/bcc_name';
    const XML_PATH_BCC_EMAIL = 'ultimatefollowupemail/general/bcc_email';

    protected $_emailTarget;

    /**
     * @var Mail
     */
    protected $_activeMail;

    protected $_activeMailChain;

    /**
     * @var Rule
     */
    protected $_activeRule;

    protected $type;

    protected $_rulesFactory;

    protected $_emailTemplateModel;

    protected $_mailFactory;

    protected $_scopeConfig;

    protected $_context;

    protected $_couponGenerator;

    protected $storeId = 0;

    /**
     * App emulation model
     *
     * @var \Magento\Store\Model\App\Emulation
     */
    protected $_appEmulation;

    /**
     * @var \Magento\Quote\Model\QuoteFactory
     */
    protected $_quoteFactory;

    /**
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Url Builder
     *
     * @var \Magento\Framework\Url
     */
    protected $_urlBuilder;

    protected $_mailData = [];

    protected $_vars;

    protected $googleAnalytic;

    /**
     * @var \Magenest\UltimateFollowupEmail\Model\SmsFactory
     */
    protected $smsFactory;

    /**
     * @var \Magenest\UltimateFollowupEmail\Model\MessageFactory
     */
    protected $messageFactory;


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\CollectionFactory $rulesFactory,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magenest\UltimateFollowupEmail\Model\MessageFactory $messageFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        EmailTemplateModel $emailTemplateModel,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Url $frontendUrl,
        \Magento\SalesRule\Model\Coupon\Massgenerator $massGenerator,
        \Magento\Store\Model\App\Emulation $appEmulation
    )
    {
        $this->_appEmulation = $appEmulation;
        $this->_rulesFactory = $rulesFactory;
        $this->_mailFactory = $mailFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_emailTemplateModel = $emailTemplateModel;
        $this->_emailTarget;
        $this->_quoteFactory = $quoteFactory;
        $this->quoteRepository = $cartRepositoryInterface;
        $this->_urlBuilder = $frontendUrl;
        $this->_couponGenerator = $massGenerator;
        $this->smsFactory = $smsFactory;
        $this->messageFactory = $messageFactory;
        $this->_context = $context;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * create follow up email rule
     */
    public function createFollowUpEmail()
    {
        if (!$this->_emailTarget) {
            return;
        }
        $rules = $this->getMatchingRule();

        if ($rules->getSize() > 0) {
            foreach ($rules as $rule) {
                $this->_activeRule = $rule;

                $isValidate = $this->isValidate($rule);
                $isDuplidate = $this->isDuplicate($rule);
                $isEmailUnsubscribed = $this->isEmailUnsubscribed($this->_emailTarget->getData('customer_email'));

                if ($isValidate && !$isDuplidate && !$isEmailUnsubscribed) {
                    $this->generateMail($this->_emailTarget, $rule);

                    $this->prepareMail();

                    $this->postCreateMail();

                    // generate the sms if the rule define sms
                    $this->generateSms($this->_emailTarget, $rule);
                } else {
                    if (isset($this->cart)) {
                        $this->cart->addData(['is_processed' => 1])->save();
                    }
                }
            }
        }
    }


    /**
     * @param $emailTarget
     * @param \Magenest\UltimateFollowupEmail\Model\Rule $rule
     */
    public function generateSms($emailTarget, $rule)
    {
        $ids = $rule->getMessageChain();

        if (is_array($ids) && !empty($ids)) {
            foreach ($ids as $smsId) {
                $mobileNumber = '';
                $recipientName = '';
                $smsModel = $this->smsFactory->create();
                $smsData = [];
                $messageModel = $this->messageFactory->create()->load($smsId);
                $smsData['status'] = \Magenest\UltimateFollowupEmail\Model\System\Config\Source\Sms\Status::STATUS_QUEUED;
                $smsData['rule_id'] = $rule->getId();
                if (method_exists($emailTarget, 'getData')) {
                    if ($emailTarget->getData('recipient_name')) {
                        $recipientName = $emailTarget->getData('recipient_name');
                    } else if ($emailTarget->getFirstname()) {
                        $recipientName = $emailTarget->getFirstname() . ' ' . $emailTarget->getLastname();
                    } else if ($emailTarget->getCustomerFirstname()) {
                        $recipientName = $emailTarget->getCustomerFirstname() . ' ' . $emailTarget->getCustomerLastname();
                    }
                }

                try {
                    //there are two possibility
                    if (method_exists($emailTarget, 'getCustomAttribute')) {
                        $customer = $emailTarget;
                        if (method_exists($emailTarget, 'getCustomer')) {
                            $customer = $emailTarget->getCustomer();
                        }
                        /** @var  $mobile \Magento\Framework\Api\AttributeValue */
                        $mobile = $customer->getCustomAttribute('mobile_number');
                        if (is_object($mobile)) {
                            $mobileNumber = $mobile->getValue();
                        }
                    }
                } catch (\Exception $e) {
                    $mobile = null;
                }

                if (!$mobileNumber && method_exists($emailTarget, 'getData')) {
                    $mobileNumber = $emailTarget->getData('mobile_number');
                }
                if (empty($mobileNumber)) {
                    return;
                }

                $smsData['recipient_name'] = $recipientName;
                $smsData['recipient_mobile'] = $mobileNumber;
                $smsData['content'] = $messageModel->getData('content');

                $current_date_time = new \DateTime();
                $modifyDelta = 0;

                if ($messageModel->getData('day')) {
                    $modifyDelta += ($messageModel->getData('day') * 24 * 60 * 60);
                }

                if ($messageModel->getData('hour')) {
                    $modifyDelta += ($messageModel->getData('hour') * 60 * 60);
                }

                if ($messageModel->getData('min')) {
                    $modifyDelta += ($messageModel->getData('min') * 60);
                }

                $modify = '+' . $modifyDelta . ' seconds';

                $current_date_time->modify($modify);

                $smsData['scheduled_send_date'] = $current_date_time->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);
                $smsData['duplicated_key'] = $emailTarget->getId();
                $smsModel->setData($smsData)->save();
            }
        }
    }


    /**
     * get the active rule for a type
     *
     * @return \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\Collection
     */
    public function getMatchingRule()
    {
        /** @var $collection  \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\Collection */
        $collection = $this->_rulesFactory->create();
        $collection->getRulesByType($this->type);
        return $collection;
    }


    /**
     * @return boolean
     */
    public function getIsValidate()
    {
        return true;
    }


    /**
     * @param \Magento\Framework\Model\AbstractModel $emailTarget
     * @param $rule
     */
    public function generateMail($emailTarget, $rule)
    {
        $mailQueue = $this->_mailFactory->create();
        $bccName = $this->_scopeConfig->getValue(self::XML_PATH_BCC_NAME);
        $bccEmail = $this->_scopeConfig->getValue(self::XML_PATH_BCC_EMAIL);

        $mailChains = $rule->getMailChain();

        if ($mailChains) {
            /** @var \Magenest\UltimateFollowupEmail\Model\Mail $mail */
            foreach ($mailChains as $mail) {
                $this->_activeMailChain = $mail;

                $this->_mailData['status'] = Status::STATUS_QUEUED;
                $this->_mailData['rule_id'] = $rule->getId();

                if (method_exists($emailTarget, 'getData')) {
                    $this->_mailData['recipient_name'] = $emailTarget->getData('customer_firstname') . ' ' . $emailTarget->getData('customer_lastname');
                    $this->_mailData['recipient_email'] = $emailTarget->getData('customer_email');
                } else {
                    $this->_mailData['recipient_name'] = $emailTarget->getFirstname() . ' ' . $emailTarget->getLastname();
                    $this->_mailData['recipient_email'] = $emailTarget->getEmail();
                }

                $this->_mailData['bcc_name'] = $bccName;
                $this->_mailData['bcc_email'] = $bccEmail;


                $modifyDelta = 0;

                if ($mail['day']) {
                    $modifyDelta += ($mail['day'] * 24 * 60 * 60);
                }

                if ($mail['hour']) {
                    $modifyDelta += ($mail['hour'] * 60 * 60);
                }

                if ($mail['min']) {
                    $modifyDelta += ($mail['min'] * 60);
                }


                $this->_mailData['schedule_time'] = '+' . $modifyDelta . ' seconds';

                $this->_mailData['send_date'] = $this->getSendDate($this->_mailData['schedule_time']);
                $this->_mailData['duplicated_key'] = $this->getDuplicatedKey();
                $this->_activeMail = $mailQueue;

                // set vars for email template model
                $this->prepareMail();
                $this->setUnsubscribeVars($this->_mailData['recipient_email']);
                // create the mail content
                $emailTemplate = $this->_activeMailChain['template'];
                $this->_mailData['template_id'] = $this->_activeMailChain['template'];
                if ($this->storeId) {
                    $this->_appEmulation->startEnvironmentEmulation($this->storeId, \Magento\Framework\App\Area::AREA_FRONTEND, true);
                }

                $model = $this->_emailTemplateModel->load($emailTemplate);

                $this->_activeMail->setData($this->_mailData)->save();

                $model->setTemplateText($this->insertCoupon(
                    $this->_activeRule->getData('promotion_rule_id'),
                    $model->getTemplateText()
                ));

                $model->setVars($this->_vars);
                $model->setDesignConfig([
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $this->storeId
                ]);

                if ($model->getSubject()) {
                    $this->_mailData['subject'] = $model->getSubject();
                }

                $this->_mailData['content'] = html_entity_decode($model->getProcessedTemplate($this->_vars));

                $this->_mailData['preview_content'] = $this->_mailData['content'];
                $this->_mailData['styles'] = $model->getTemplateStyles();
                $this->_mailData['context_vars'] = json_encode($this->_vars);


                if ($this->storeId) {
                    $this->_appEmulation->stopEnvironmentEmulation();
                }

                $this->_mailData['cancel_serialized'] = $this->_activeRule->getData('cancel_serialized');

                // save the attachment information
                $attachedFiles = $this->_activeRule->getData('attached_files');
                $this->_mailData['attachments'] = $attachedFiles;
                $this->_activeMail->addData($this->_mailData)->save();
                $this->addTrackingCode($this->_activeMail);
                $this->_activeMail->setContent(
                    $this->applyGoogleAnalytics(
                        $this->applyClickTracking(
                            $this->_activeMail->getContent(),
                            $this->_activeMail->getId()
                        ),
                        $this->_activeRule
                    )
                )->save();
                if (isset($this->cart)) {
                    $this->cart->addData(['is_processed' => 1])->save();
                }
            }
        }
    }

    public function getDuplicatedKey()
    {
        return $this->_emailTarget->getId();
    }

    public static function applyClickTracking($input, $mailId)
    {
        $pattern = "/\b(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i";
        $input = preg_replace_callback($pattern, function ($matches) use ($mailId) {
            if (isset($matches[0])) {
                if (!preg_match('/\.(ico|jpg|jpeg|png|gif|svg|js|css|swf|eot|ttf|otf|woff|woff2)($|\?)/i', $matches[0])) {
                    if (strpos($matches[0], 'track/email') === false) {
                        $destination = self::base64UrlEncode($matches[0]);
                        $encryptor = ObjectManager::getInstance()->get(Encryptor::class);
                        $url = ObjectManager::getInstance()->get(Url::class);
                        $ecryptedMailId = self::base64UrlEncode($encryptor->encrypt($mailId));
                        $trackingUrl = $url->getUrl('ultimatefollowupemail/track/click', [
                            'des' => $destination,
                            'id' => $ecryptedMailId
                        ]);
                        return $trackingUrl;
                    }
                }
                return $matches[0];
            } else {
                return $matches;
            }
        }, $input);
        return $input;
    }


    /**
     * @param $input
     * @param $rule
     * @return mixed
     */
    protected function applyGoogleAnalytics($input, $rule)
    {
        $analytics = '?utm_medium=' . $rule->getData('ga_medium') . '&utm_campaign=' . $rule->getData('ga_campaign') . '&utm_source=' . $rule->getData('ga_source');

        if ($rule->getData('ga_content')) {
            $analytics .= '&utm_content=' . $rule->getData('ga_content');
        }

        if ($rule->getData('ga_term')) {
            $analytics .= '&utm_term=' . $rule->getData('ga_term') . '&uq=';
        }

        $this->googleAnalytic = $analytics;

        $pattern = "/\b(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i";
        $input = preg_replace_callback($pattern, [$this, 'replaceUrlWithGA'], $input);

        return $input;
    }


    /**
     * @param $input
     * @return string
     */
    public function replaceUrlWithGA($input)
    {
        if (isset($input[0])) {
            if (!preg_match('/\.(ico|jpg|jpeg|png|gif|svg|js|css|swf|eot|ttf|otf|woff|woff2)($|\?)/i', $input[0])) {
                return $input[0] .= $this->googleAnalytic;
            }
            return $input[0];
        } else {
            return $input;
        }
    }


    /**
     * @param $ruleId
     * @param $emailContent
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function insertCoupon($ruleId, $emailContent)
    {
        if (!$ruleId) {
            return $emailContent;
        }

        try {
            /** @var \Magenest\UltimateFollowupEmail\Model\Coupon\Massgenerator $massgenerator */
            $massgenerator = \Magento\Framework\App\ObjectManager::getInstance()->create('Magenest\UltimateFollowupEmail\Model\Coupon\Massgenerator');
            $massgenerator->setFormat('alphanum');
            $massgenerator->setLength(10);

            $expiredTime = unserialize($this->_activeRule->getData('coupon_time'));

            $pattern = '/\{\{var\s+coupon.code\}\}/';
            preg_match_all($pattern, $emailContent, $matches, PREG_SET_ORDER);
            $mailId = $this->_activeMail->getId();
            $sendDate = isset($this->_mailData['send_date']) ? $this->_mailData['send_date'] : null;
            $codes = $massgenerator->generateFuePool($ruleId, count($matches), $mailId, $expiredTime, $sendDate);
            foreach ($matches as $key => $match) {
                $patterns[0] = '/' . $match[0] . '/';
                $replacements[0] = $codes[$key];
                $this->_vars['coupon_code'] = $codes[$key];
                $emailContent = preg_replace($patterns, $replacements, $emailContent, 1);
            }
        } catch (\Exception $e) {
            \Magento\Framework\App\ObjectManager::getInstance()->create('Psr\Log\LoggerInterface')->debug('Could not generate coupons: ' . $e->getMessage());
        }
        return $emailContent;
    }

    public function getSendDate($modify)
    {
        $current_date_time = new \DateTime();
        $current_date_time->modify($modify);
        $current_date_time->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);
        return $current_date_time;
    }


    /**
     * @param $rule
     * @return boolean
     */
    public function isDuplicate($rule)
    {
        // if there is no email Target then we return false to stop process
        if (!$this->_emailTarget) {
            return true;
        }

        $rule_id = $rule->getId();

        $key = $this->_emailTarget->getId();

        $mailModel = $this->_mailFactory->create();
        $isDuplicate = $mailModel->getIsRuleProcessed($rule_id, $key);
        return $isDuplicate;
    }


    /**
     * @param int $customerGroupId
     * @param int $websiteId
     * @return bool
     */
    public function validateCustomerGroupAndWebsite($customerGroupId = 0, $websiteId = 0)
    {
        $isValidate = false;

        if (!$this->_emailTarget || !$this->_activeRule) {
            return $isValidate;
        } else {
            $isValidate = $this->_activeRule->isValidateTarget($customerGroupId, $websiteId);
        }

        return $isValidate;
    }

    /**
     * @param int $productId
     * @return string
     */
    protected function getProductHtml($productId)
    {
        /** @var Product $product */
        $product = \Magento\Framework\App\ObjectManager::getInstance()->create('\Magento\Catalog\Model\Product')->load($productId);
        if (!$product->getId()) {
            return '';
        }
        $productImageUrl = $product->getMediaGalleryImages()->getFirstItem()->getUrl();
        $currencySymbol = '';
        if ($this->_emailTarget instanceof \Magento\Framework\DataObject) {
            $store = $this->_emailTarget->getStore();
            if ($store instanceof Store) {
                $currencySymbol = $store->getCurrentCurrency()->getCurrencySymbol();
            }
        }
        $name = $product->getName();
        $name = strlen($name) > 13 ? substr($name, 0, 13) . '...' : $name;
        $productHtml = "<table>";
        $productHtml .= '<tr><td>';
        $productHtml .= '<a href="' . $product->getProductUrl() . ' " target="_blank">';
        $productHtml .= '<img src="' . $productImageUrl . ' " height="150" width="120">';
        $productHtml .= '</a>';
        $productHtml .= '</td></tr>';
        $productHtml .= '<tr><td>';
        $productHtml .= $name;
        $productHtml .= '</td></tr>';
        $productHtml .= '<tr><td>';
        $productHtml .= '<p style="font-weight: bold">';
        $productHtml .= 'Price: ' . $currencySymbol . number_format($product->getFinalPrice(), 2);
        $productHtml .= '</p>';
        $productHtml .= '</td></tr>';
        $productHtml .= '</table>';
        return $productHtml;
    }

    /**
     * @param Product $product
     * @return string
     */
    protected function getRelatedProductsGridHtml($product)
    {
        if (!$product->getId()) {
            return '';
        }
        $relatedProductGridHtml = "<ul style='list-style: none; min-height: 100%; margin:0; padding: 0;'>";
        foreach ($product->getRelatedProductIds() as $relatedProductId) {
            $relatedProductGridHtml .= '<li style=" float: left; margin: 0; display: inline;">';
            $relatedProductGridHtml .= $this->getProductHtml($relatedProductId);
            $relatedProductGridHtml .= '</li>';
        }
        foreach ($product->getUpSellProductIds() as $relatedProductId) {
            $relatedProductGridHtml .= '<li style=" float: left; margin: 0; display: inline;">';
            $relatedProductGridHtml .= $this->getProductHtml($relatedProductId);
            $relatedProductGridHtml .= '</li>';
        }
        foreach ($product->getCrossSellProductIds() as $relatedProductId) {
            $relatedProductGridHtml .= '<li style=" float: left; margin: 0; display: inline;">';
            $relatedProductGridHtml .= $this->getProductHtml($relatedProductId);
            $relatedProductGridHtml .= '</li>';
        }
        $relatedProductGridHtml .= '<li style="list-style:none; clear: both;"></li>';
        $relatedProductGridHtml .= '</ul>';
        return $relatedProductGridHtml;
    }

    protected function isEmailUnsubscribed($email)
    {
        /** @var \Magenest\UltimateFollowupEmail\Model\Unsubscriber $unsubscriberModel */
        $unsubscriberModel = \Magento\Framework\App\ObjectManager::getInstance()->create('\Magenest\UltimateFollowupEmail\Model\Unsubscriber');
        $unsubscriberModel = $unsubscriberModel->getCollection()
            ->addFieldToFilter('unsubscriber_email', $email)
            ->addFieldToFilter('unsubscriber_status', UnsubscriberStatus::UNSUBSCRIBED)
            ->addFieldToFilter('rule_id', ['in' => ['0', $this->_activeRule->getId()]])
            ->getFirstItem();
        return $unsubscriberModel->getId();
    }

    protected function setUnsubscribeVars($email)
    {
        $encryptor = \Magento\Framework\App\ObjectManager::getInstance()->create('\Magento\Framework\Encryption\Encryptor');
        $ecryptedEmail = self::base64UrlEncode($encryptor->encrypt($email));
        $encryptedRuleId = self::base64UrlEncode($encryptor->encrypt($this->_activeRule->getId()));

        $unsubscribeLink = $this->_urlBuilder->getUrl(
            'ultimatefollowupemail/unsubscribe/unsubscribe',
            ['_current' => false, 'e' => $ecryptedEmail]
        );
        $unsubscribeRuleLink = $this->_urlBuilder->getUrl(
            'ultimatefollowupemail/unsubscribe/unsubscribe',
            ['_current' => false, 'e' => $ecryptedEmail, 'r' => $encryptedRuleId]
        );
        $resubscribeLink = $this->_urlBuilder->getUrl(
            'ultimatefollowupemail/unsubscribe/resubscribe',
            ['_current' => false, 'e' => $ecryptedEmail]
        );
        $resubscribeRuleLink = $this->_urlBuilder->getUrl(
            'ultimatefollowupemail/unsubscribe/resubscribe',
            ['_current' => false, 'e' => $ecryptedEmail, 'r' => $encryptedRuleId]
        );
        $this->_vars['unsubscribeLink'] = $unsubscribeLink;
        $this->_vars['unsubscribeRuleLink'] = $unsubscribeRuleLink;
        $this->_vars['resubscribeLink'] = $resubscribeLink;
        $this->_vars['resubscribeRuleLink'] = $resubscribeRuleLink;
    }

    /**
     * @param Mail $mail
     */
    protected function addTrackingCode($mail)
    {
        $content = $mail->getContent();
        $trackingContent = self::getTrackingCode($mail->getId());
        $mail->setContent($content . $trackingContent);
    }

    public static function getTrackingCode($mailId)
    {
        $encryptor = ObjectManager::getInstance()->create('\Magento\Framework\Encryption\Encryptor');
        $urlBuilder = ObjectManager::getInstance()->get(\Magento\Framework\Url::class);
        $trackingId = self::base64UrlEncode($encryptor->encrypt($mailId));
        $trackingUrl = $urlBuilder->getUrl('ultimatefollowupemail/track/email', ['id' => $trackingId]);
        $trackingContent = "<img src='{$trackingUrl}' width='0' height='0' />";
        return $trackingContent;
    }

    public static function base64UrlEncode($input)
    {
        return strtr(base64_encode($input), '+/=', '._-');
    }

    public static function base64UrlDecode($input)
    {
        return base64_decode(strtr($input, '._-', '+/='));
    }

    /**
     * build email target and
     *
     * @return mixed
     */
    abstract public function run();


    abstract public function isValidate($rule);


    abstract public function prepareMail();


    abstract public function postCreateMail();
}
