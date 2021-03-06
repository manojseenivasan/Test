<?php
/**
 * @category    Ewall
 * @package     Ewall_Filters
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Resource type which contains sql code for applying filters and related operations
 * @author Ewall Team
 * Injected instead of standard resource catalog/layer_filter_attribute in 
 * Ewall_Filters_Model_Filter_Attribute::_getResource().
 */
class Ewall_Filters_Resource_Filter_And_Attribute
    extends Ewall_Filters_Resource_Filter_Attribute
{
    /**
     * @param Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection $collection
     * @param Ewall_Filters_Resource_Filter_Attribute $model
     * @param array $value
     * @return Ewall_Filters_Resource_Filter_Attribute
     */
    public function applyToCollection($collection, $model, $value) {
        $attribute = $model->getAttributeModel();
        $connection = $this->_getReadAdapter();

        foreach ($value as $i => $singleValue) {
            $tableAlias = $attribute->getAttributeCode() . '_idx' . $i;
            $conditions = array(
                "{$tableAlias}.entity_id = e.entity_id",
                $connection->quoteInto("{$tableAlias}.attribute_id = ?", $attribute->getAttributeId()),
                $connection->quoteInto("{$tableAlias}.store_id = ?", $collection->getStoreId()),
                "{$tableAlias}.value = $singleValue"
            );
            $conditions = join(' AND ', $conditions);
            $collection->getSelect()
                    ->distinct()
                    ->join(array($tableAlias => $this->getMainTable()), $conditions, array());
        }

        return $this;
    }
}