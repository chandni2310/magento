<?php
class Ccc_Vendor_Model_Resource_Product_Group_Name_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('vendor/product_group_name');
    }


    public function getVendorGroups($vendor)
    {
        $this->getSelect()
            ->join(
                array('additional_table' => $this->getTable('eav/attribute_group')),
                'additional_table.attribute_group_id = main_table.attribute_group_id'
            )
            ->where('main_table.vendor_id=?', $vendor->getId());

        return $this;

        /*
           join =[
               ['alias table name],
                'on' // e.attribute_id = f.attribute_id
           ]     
        */
    }

    public function getVendorTabsGroups($vendor)
    {
        $this->getSelect()
            ->join(
                array('additional_table' => $this->getTable('eav/attribute_group')),
                'additional_table.attribute_group_id = main_table.attribute_group_id'
            )
            ->where('main_table.vendor_id=?', $vendor->getId());

        return $this;

        
    }


}

 ?>