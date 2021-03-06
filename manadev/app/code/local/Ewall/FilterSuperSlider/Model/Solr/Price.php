<?php
/** 
 * @category    Ewall
 * @package     Ewall_FilterSuperSlider
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterSuperSlider_Model_Solr_Price extends Ewall_Filters_Model_Solr_Price {
    /**
     * Prepare text of item label
     *
     * @param   int $range
     * @param   float $value
     * @return  string
     */
    protected function _renderItemLabel($range, $value) {
        $range = $this->_getResource()->getPriceRange($value, $range);
    	/* @var $helper Ewall_FilterSuperSlider_Helper_Data */ $helper = Mage::helper(strtolower('Ewall_FilterSuperSlider'));
        $fromPrice  = $helper->formatNumber($range['from'], $this->getFilterOptions());
        $toPrice    = $helper->formatNumber($range['to'], $this->getFilterOptions());
        return Mage::helper('catalog')->__('%s - %s', $fromPrice, $toPrice);
    }
    public function getExistingValues() {
        $result = array();
        foreach ($this->_getResource()->getExistingValues($this) as $value) {
            $result[] = round($value);
        }
        return array_values(array_unique($result));
    }
    public function getDecimalDigits() {
        return $this->getFilterOptions()->getSliderDecimalDigits();
    }
}