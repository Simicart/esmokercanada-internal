<?php
namespace MageWorx\SeoBreadcrumbs\Model\ResourceModel\Breadcrumbs\Category\Grid\Collection;

/**
 * Interceptor class for @see \MageWorx\SeoBreadcrumbs\Model\ResourceModel\Breadcrumbs\Category\Grid\Collection
 */
class Interceptor extends \MageWorx\SeoBreadcrumbs\Model\ResourceModel\Breadcrumbs\Category\Grid\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoBreadcrumbs\Helper\Category $helperCategory, \Magento\Framework\Data\Collection\EntityFactory $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\RequestInterface $request, \Magento\Eav\Model\Config $eavConfig, \Magento\Framework\App\ResourceConnection $resource, \Magento\Eav\Model\EntityFactory $eavEntityFactory, \Magento\Eav\Model\ResourceModel\Helper $resourceHelper, \Magento\Framework\Validator\UniversalFactory $universalFactory, $mainTable, $eventPrefix, $eventObject, $resourceModel, $model = 'Magento\\Framework\\View\\Element\\UiComponent\\DataProvider\\Document', ?\Magento\Framework\DB\Adapter\AdapterInterface $connection = null)
    {
        $this->___init();
        parent::__construct($helperCategory, $entityFactory, $logger, $fetchStrategy, $eventManager, $storeManager, $request, $eavConfig, $resource, $eavEntityFactory, $resourceHelper, $universalFactory, $mainTable, $eventPrefix, $eventObject, $resourceModel, $model, $connection);
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
