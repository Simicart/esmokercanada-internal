<?php
namespace Magefan\Blog\Controller\Router;

/**
 * Interceptor class for @see \Magefan\Blog\Controller\Router
 */
class Interceptor extends \Magefan\Blog\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\Event\ManagerInterface $eventManager, \Magefan\Blog\Model\Url $url, \Magefan\Blog\Model\PostFactory $postFactory, \Magefan\Blog\Model\CategoryFactory $categoryFactory, \Magefan\Blog\Model\AuthorFactory $authorFactory, \Magefan\Blog\Model\TagFactory $tagFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\ResponseInterface $response)
    {
        $this->___init();
        parent::__construct($actionFactory, $eventManager, $url, $postFactory, $categoryFactory, $authorFactory, $tagFactory, $storeManager, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
