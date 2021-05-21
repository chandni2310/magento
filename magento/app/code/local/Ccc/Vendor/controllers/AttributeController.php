<?php

class Ccc_Vendor_AttributeController extends Mage_Core_Controller_Front_Action{
	protected $_entityTypeId;

    public function _getSession()
    {
        return Mage::getSingleton('vendor/session');
    }
    public function preDispatch()
    {
        parent::preDispatch();
        $this->_entityTypeId = Mage::getModel('eav/entity')->setType(Ccc_Vendor_Model_Resource_Product::ENTITY)->getTypeId();
    }

    public function indexAction()
    {
      
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/account/login');
        }
        
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Manage Attributes '));
        $this->_initLayoutMessages('vendor/session');
        $this->renderLayout();
    }
}

 ?>