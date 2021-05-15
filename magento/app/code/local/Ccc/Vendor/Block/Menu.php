<?php 

class Ccc_Vendor_Block_Menu extends Mage_Core_Block_Template{
	 public function __construct()
    {
        $this->setTemplate('vendor/menu.phtml');
    }


    public function getGroupManageUrl()
    {
        return Mage::helper('vendor')->getGroupManageUrl();
    }
}

?>