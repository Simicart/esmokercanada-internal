<?php

namespace Magento\Webpos\Test\TestCase\Location;

use Magento\Mtf\TestCase\Injectable;

use Magento\Webpos\Test\Page\Adminhtml\LocationIndex;

/**
 * MGC001
 *
 * 1. Go to Admin > Marketing > Gift Card > Manage Gift Codes
 * 2. Display information of list of Gift Code existing in the system such as:
 *      ID, Gift Code, Initial value, Current Balance, Status, Customer, Order,
 *      Recipent, Created at, Expired at, Store view, Send To Customer, Action Created by, Action
 * 3. Display a white page " No records found" if there is no Gift Code
 * 
 * 
 * MGC033
 * 
 * Preconditions:
 * 1. Stay on Gift Code Grid page
 *
 * Steps:
 * 1. Change View to 50 records / page
 *
 * Acceptance Criteria:
 * 1. Grid changes, display 50 Gift Codes/page
 * 
 */
class ShowLocationGridTest extends Injectable
{
    private $locationIndex;

    public function __inject(
		LocationIndex $locationIndex
	) {
		$this->locationIndex = $locationIndex;
	}

    public function test() {
        // MGC001
        $this->locationIndex->open();
        
        // MGC033
        $result = [];
        
        $grid = $this->locationIndex->getLocationGroupGrid();
        $grid->resetFilter();
        $grid->changePerPage(20);
        $result[20] = $grid->getCountRows();
        
        $grid->changePerPage(30);
        $result[30] = $grid->getCountRows();
        
        return ['result' => $result];
    }
}
