<?php
namespace Custom\Signupvalidate\Model\Plugin\Controller\Account;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\UrlFactory;
use Magento\Framework\Message\ManagerInterface;

class RestrictCustomerEmail
{

    /** @var \Magento\Framework\UrlInterface */
    protected $urlModel;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * RestrictCustomerEmail constructor.
     * @param UrlFactory $urlFactory
     * @param RedirectFactory $redirectFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        UrlFactory $urlFactory,
        RedirectFactory $redirectFactory,
        ManagerInterface $messageManager

    )
    {
        $this->urlModel = $urlFactory->create();
        $this->resultRedirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @param \Magento\Customer\Controller\Account\CreatePost $subject
     * @param \Closure $proceed
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundExecute(
        \Magento\Customer\Controller\Account\CreatePost $subject,
        \Closure $proceed
    )
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/restrict_email.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        /** @var \Magento\Framework\App\RequestInterface $request */
        $email = $subject->getRequest()->getParam('email');
        $logger->info($email);
        list($nick, $domain) = explode('@', $email, 2);
        if (in_array($domain, ['mail.ru'], true)) {
            $this->messageManager->addErrorMessage(
                'Registration is disabled for you domain'
            );
            $defaultUrl = $this->urlModel->getUrl('*/*/create', ['_secure' => true]);
            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setUrl($defaultUrl);

        }
        return $proceed();
    }
}