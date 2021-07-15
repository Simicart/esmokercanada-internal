<?php
namespace Magento\MediaStorage\Model\File\Storage\Response;

/**
 * Interceptor class for @see \Magento\MediaStorage\Model\File\Storage\Response
 */
class Interceptor extends \Magento\MediaStorage\Model\File\Storage\Response implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Request\Http $request, \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager, \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory, \Magento\Framework\App\Http\Context $context, \Magento\Framework\Stdlib\DateTime $dateTime, \Magento\Framework\File\Transfer\Adapter\Http $transferAdapter)
    {
        $this->___init();
        parent::__construct($request, $cookieManager, $cookieMetadataFactory, $context, $dateTime, $transferAdapter);
    }

    /**
     * {@inheritdoc}
     */
    public function sendResponse()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'sendResponse');
        return $pluginInfo ? $this->___callPlugins('sendResponse', func_get_args(), $pluginInfo) : parent::sendResponse();
    }

    /**
     * {@inheritdoc}
     */
    public function sendVary()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'sendVary');
        return $pluginInfo ? $this->___callPlugins('sendVary', func_get_args(), $pluginInfo) : parent::sendVary();
    }

    /**
     * {@inheritdoc}
     */
    public function appendBody($value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'appendBody');
        return $pluginInfo ? $this->___callPlugins('appendBody', func_get_args(), $pluginInfo) : parent::appendBody($value);
    }
}
