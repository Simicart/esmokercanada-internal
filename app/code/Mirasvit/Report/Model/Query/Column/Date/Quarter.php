<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-report
 * @version   1.2.13
 * @copyright Copyright (C) 2017 Mirasvit (https://mirasvit.com/)
 */


namespace Mirasvit\Report\Model\Query\Column\Date;

use Magento\Framework\App\ResourceConnection;
use Mirasvit\Report\Model\Query\Column;
use Mirasvit\Report\Api\Repository\MapRepositoryInterface;

class Quarter extends Column
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        ResourceConnection $resource,
        MapRepositoryInterface $mapRepository,
        $name,
        $data = []
    ) {
        parent::__construct($filterBuilder, $mapRepository, $name, $data);
        $this->dataType = false;
        $connection = $resource->getConnection();

        $year = $connection->getDateFormatSql('%1', '%Y');
        $quarter = new \Zend_Db_Expr('QUARTER(%1)');

        $this->setExpression($connection->getConcatSql([$year, $quarter, "'01 00:00:00'"], '-'));
    }

    /**
     * {@inheritdoc}
     */
    public function prepareValue($value)
    {
        return date('M, Y', strtotime($value)) . ' - ' . date('M, Y', strtotime($value) + 80 * 24 * 60 * 60);
    }

    /**
     * {@inheritdoc}
     */
    public function toDbExpr($param = null)
    {
        if ($param == null) {
            return parent::toDbExpr();
        }

        return $this->toUNIXDbExpr($param);
    }
}
