<?php
namespace MageWorx\SeoReports\Model\ResourceModel\PageReport\Grid\DuplicateCollection;

/**
 * Interceptor class for @see \MageWorx\SeoReports\Model\ResourceModel\PageReport\Grid\DuplicateCollection
 */
class Interceptor extends \MageWorx\SeoReports\Model\ResourceModel\PageReport\Grid\DuplicateCollection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoReports\Model\Config\Page $reportConfig, \MageWorx\SeoReports\Model\ResourceModel\CollectionHelper $collectionHelper, \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, $mainTable, $eventPrefix, $eventObject, $resourceModel, $model = 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\Document', $connection = null, ?\Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null)
    {
        $this->___init();
        parent::__construct($reportConfig, $collectionHelper, $entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $eventPrefix, $eventObject, $resourceModel, $model, $connection, $resource);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurPage($displacement = 0)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurPage');
        return $pluginInfo ? $this->___callPlugins('getCurPage', func_get_args(), $pluginInfo) : parent::getCurPage($displacement);
    }
}