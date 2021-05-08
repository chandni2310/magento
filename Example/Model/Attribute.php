<?php

class Ccc_Example_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Ccc_Example';

    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('example/attribute');
    }
}

