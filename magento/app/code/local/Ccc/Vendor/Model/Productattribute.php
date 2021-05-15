<?php

class Ccc_Vendor_Model_Productattribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Ccc_Vendor';

    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('vendor/productattribute');
    }
}
