<?php
class Ccc_Vendor_Block_Form_Logout extends Mage_Core_Block_Template{
	public function getNewUrl(){
		$url = $this->helper('vendor')->getLoginUrl();
		return $url;
	}
}

 ?>