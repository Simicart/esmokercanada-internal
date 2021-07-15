<?php
namespace Magento\Framework\Mail\MimeMessage;

/**
 * Interceptor class for @see \Magento\Framework\Mail\MimeMessage
 */
class Interceptor extends \Magento\Framework\Mail\MimeMessage implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(array $parts)
    {
        $this->___init();
        parent::__construct($parts);
    }

    /**
     * {@inheritdoc}
     */
    public function getParts() : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getParts');
        return $pluginInfo ? $this->___callPlugins('getParts', func_get_args(), $pluginInfo) : parent::getParts();
    }
}
