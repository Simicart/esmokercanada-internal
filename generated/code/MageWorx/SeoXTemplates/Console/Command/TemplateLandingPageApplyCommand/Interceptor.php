<?php
namespace MageWorx\SeoXTemplates\Console\Command\TemplateLandingPageApplyCommand;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Console\Command\TemplateLandingPageApplyCommand
 */
class Interceptor extends \MageWorx\SeoXTemplates\Console\Command\TemplateLandingPageApplyCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoXTemplates\Model\Template\ManagerFactory $templateManagerFactory, \Magento\Framework\App\State $appState, \Magento\Framework\Event\ManagerInterface $eventManager)
    {
        $this->___init();
        parent::__construct($templateManagerFactory, $appState, $eventManager);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        return $pluginInfo ? $this->___callPlugins('run', func_get_args(), $pluginInfo) : parent::run($input, $output);
    }
}
