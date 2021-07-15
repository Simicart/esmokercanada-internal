<?php

namespace Magento\Webpos\Test\Constraint\Location;

use Magento\Webpos\Test\Page\Adminhtml\LocationIndex;
use Magento\Mtf\Constraint\AbstractConstraint;

/**
 *
 */
class AssertLocationGridColums extends AbstractConstraint
{
    /**
     * Assert that after save Synonym Group successful message appears.
     *
     * @param LocationIndex $giftcodeIndex
     * @param array $result
     * @return void
     */
    public function processAssert(LocationIndex $giftcodeIndex, $result)
    {
        $giftcodeGrid = $giftcodeIndex->getLocationGroupGrid();
        // Must show grid
        \PHPUnit_Framework_Assert::assertNotFalse(
            $giftcodeGrid->isVisible(),
            'Gift code grid is not visible.'
        );
        
        // MGC033
        foreach ($result as $perPage => $rows) {
            \PHPUnit_Framework_Assert::assertLessThanOrEqual(
                $perPage,
                $rows,
                'Grid show more items than config, config: ' . $perPage . ' rows: ' . $rows
            );
        }
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'Gift Codes Grid display match columns and message';
    }
}
