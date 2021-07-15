<?php

namespace Magento\Webpos\Test\Block\Adminhtml\Block\Location;

use Magento\Mtf\Client\Element\SimpleElement;
use Magento\Ui\Test\Block\Adminhtml\DataGrid;
use Magento\Mtf\Client\Locator;

/**
 * Backend Data Grid for Location Entity
 */
class GroupGrid extends DataGrid
{
    /**
     * Filters array mapping.
     *
     * @var array
     */
    protected $filters = [
        'location_id_from' => [
            'selector' => '[name="giftvoucher_id[from]"]',
        ],
        'location_id_to' => [
            'selector' => '[name="giftvoucher_id[to]"]',
        ]
    ];

    /**
     * Locator value for select perpage element
     *
     * @var string
     */
    protected $perPage = '.admin__data-grid-pager-wrap .selectmenu';

    /**
     * Change per page
     *
     * @param number $pageSize
     */
    public function changePerPage($pageSize)
    {
        $selectmenu = $this->_rootElement->find($this->perPage);
        $selectmenu->find('.selectmenu-toggle')->click();

        $item = $selectmenu->find('.//button[@class="selectmenu-item-action" and text()="' . $pageSize . '"]', Locator::SELECTOR_XPATH);
        if ($item->isVisible()) {
            $item->click();
        }

        $this->waitLoader();
    }

    /**
     * Count the number of data-row
     *
     * @return number
     */
    public function getCountRows()
    {
        return count($this->_rootElement->getElements('tr.data-row'));
    }

    /**
     * @param string $id
     * @param string $headerLabel
     * @return array|string
     */
    public function getColumnValue($id, $headerLabel)
    {
        $this->waitLoader();
        $this->getTemplateBlock()->waitForElementNotVisible($this->loader);
        $columnNumber = count(
            $this->_rootElement->getElements(sprintf($this->columnNumber, $headerLabel), Locator::SELECTOR_XPATH)
        );
        $selector = sprintf($this->rowById, $id) . '//td';
        for ($i = $columnNumber; $i > 0; $i--) {
            $selector .= '//following-sibling::td';
        }
        $selector .= '//div';

        return $this->_rootElement->find($selector, Locator::SELECTOR_XPATH)->getText();
    }
}
