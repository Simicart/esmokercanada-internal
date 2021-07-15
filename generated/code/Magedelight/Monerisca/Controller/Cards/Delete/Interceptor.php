<?php
namespace Magedelight\Monerisca\Controller\Cards\Delete;

/**
 * Interceptor class for @see \Magedelight\Monerisca\Controller\Cards\Delete
 */
class Interceptor extends \Magedelight\Monerisca\Controller\Cards\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Registry $registry, \Magento\Customer\Model\Session\Proxy $customerSession, \Magento\Framework\DataObject $requestObject, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Directory\Helper\Data $directoryHelper, \Magedelight\Monerisca\Model\Api\Monerisca $monerisApi, \Magedelight\Monerisca\Model\CardsFactory $cardsFactory, \Magedelight\Monerisca\Helper\Data $monerisHelper, \Magento\Framework\Encryption\EncryptorInterface $encryptor)
    {
        $this->___init();
        parent::__construct($context, $registry, $customerSession, $requestObject, $localeDate, $directoryHelper, $monerisApi, $cardsFactory, $monerisHelper, $encryptor);
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
