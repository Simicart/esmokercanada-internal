<?php

namespace Custom\ExportChanges\Plugin\Block\Widget\Grid;

Class Extended 
{
  public function afterGetMainButtonsHtml(\Magento\Backend\Block\Widget\Grid\Extended $subject, $result)

	{

	        $result .= '<button id="" title="Select All" type="button" class="action-default scalable action-reset action-tertiary" onclick="selectAllChecks()" data-action="grid-filter-reset" data-ui-id="widget-button-3"><span>Select All</span></button>';

	    return $result;

	}
}
?>