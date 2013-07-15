<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Source of all registered filter templates, regardless their type
 * @author Ewall Team
 *
 */
class Ewall_Filters_Model_Source_Display_All extends Ewall_Core_Model_Source_Abstract {
	protected function _getAllOptions() {
		/* @var $core Ewall_Core_Helper_Data */ $core = Mage::helper(strtolower('Ewall_Core'));
		$result = array();

		foreach (array('attribute', 'price', 'category', 'decimal') as $filterType) {
			foreach ($core->getSortedXmlChildren(Mage::getConfig()->getNode('ewall_filters/display'), $filterType) as $key => $options) {
				$found = false;
				foreach ($result as $item) {
					if ($item['value'] == $key) {
						$found = true;
						break;
					}
				}
				
				if (!$found) {
					$module = isset($options['module']) ? ((string)$options['module']) : 'ewall_filteradmin'; 
					$result[] = array('label' => Mage::helper($module)->__((string)$options->title), 'value' =>  $key);
				}
			}
		}
		usort($result, array($this, '_compareOptions'));
		return $result;
	}
	
	public function _compareOptions($a, $b) {
		if ($a['label'] == $b['label']) return 0;
		return mb_convert_case($a['label'], MB_CASE_UPPER, "UTF-8") < mb_convert_case($b['label'], MB_CASE_UPPER, "UTF-8") ? -1 : 1;
	}
}