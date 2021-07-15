<?php
namespace Magedelight\Monerisca\Controller\Adminhtml\Cards\Update;

/**
 * Interceptor class for @see \Magedelight\Monerisca\Controller\Adminhtml\Cards\Update
 */
class Interceptor extends \Magedelight\Monerisca\Controller\Adminhtml\Cards\Update implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\DataObject $requestObject, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Directory\Helper\Data $directoryHelper, \Magedelight\Monerisca\Helper\Data $monerisHelper, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magedelight\Monerisca\Model\Api\Monerisca $monerisApi, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magedelight\Monerisca\Model\CardsFactory $cardsFactory, \Magento\Framework\Encryption\EncryptorInterface $encryptor)
    {
        $this->___init();
        parent::__construct($context, $registry, $requestObject, $localeDate, $directoryHelper, $monerisHelper, $resultLayoutFactory, $jsonEncoder, $monerisApi, $customerRepository, $resultJsonFactory, $cardsFactory, $encryptor);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
