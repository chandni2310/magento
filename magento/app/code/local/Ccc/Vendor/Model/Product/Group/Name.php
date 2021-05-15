<?php 
class Ccc_Vendor_Model_Product_Group_Name extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('vendor/product_group_name');
    }


    public function isGroupNameExists($name, $vendorId)
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = "SELECT * FROM
            `{$resource->getTableName('vendor/vendor_product_group_name')}`
            WHERE `vendor_id` = '{$vendorId}'
            AND `name` = '{$name}'             
        ";

        return $readConnection->fetchRow($query) ? true : false;
    }


    public function getGroupId(int $attributeId)
    {
        $resource = $this->getResource()->getReadConnection();

        $query = "SELECT `attribute_group_id` 
        FROM `eav_entity_attribute`
        WHERE `attribute_id` = '{$attributeId}'
        ";

        return $resource->query($query)->fetch();
    }
}


?>