<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Column_Multivalue extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Options {
    public function render(Varien_Object $row) {
        $options = $this->getColumn()->getOptions();
        $showMissingOptionValues = (bool)$this->getColumn()->getShowMissingOptionValues();
        if (!empty($options) && is_array($options)) {
            $value = $row->getData($this->getColumn()->getIndex());
            if (!is_array($value)) {
                $value = explode(',', $value);
            }
            $res = array();
            foreach ($value as $item) {
                if (isset($options[$item])) {
                    $res[] = $options[$item];
                } elseif ($showMissingOptionValues) {
                    $res[] = $item;
                }
            }
            return implode(', ', $res);
        }
    }
}