<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Encapsulates extensibility points for Ewall_Filters module. Ewall_Filters module internals call this helper to 
 * invoke this module extensions. Extension mechanisms include registration of additional functionality via 
 * config.xml, subscribing to events provided by this module, etc. 
 * @author Ewall Team
 */
class Ewall_Filters_Helper_Extended extends Mage_Core_Helper_Abstract {

	/**
	 * Modifies filter items and filter model itself as specified by extensions subscribed to 
	 * ewall_filters_process_items event.
	 * @param Mage_Catalog_Model_Layer_Filter_Abstract $filter
	 * @param array $items
	 */
	public function processFilterItems($filter, $items) {
		$wrappedItems = new Varien_Object;
		$wrappedItems->setItems($items);
		Mage::dispatchEvent('ewall_filters_process_items', array('filter' => $filter, 'items' => $wrappedItems));
		return $wrappedItems->getItems();
	}
}