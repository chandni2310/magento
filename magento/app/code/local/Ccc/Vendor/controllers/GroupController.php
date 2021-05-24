<?php
class Ccc_Vendor_GroupController extends Mage_Core_Controller_Front_Action{
 protected $_entityTypeId;

    public function _getSession()
    {
        return Mage::getSingleton('vendor/session');
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function indexAction()
    {
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/account/login');
        }
        
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Manage Group'));
        $this->_initLayoutMessages('vendor/session');
        $this->renderLayout();
    }

    public function editAction()
    {
        try {
            $id = (int) $this->getRequest()->getParam('group');
            $session = $this->_getSession();
            $model = Mage::getModel('vendor/product_group_name');

            if ($id && !$model->load($id)->getId()) {
                throw new Exception("Invalid group id");
            }

            if ($id) {
                if ($model->getVendorId() != $session->getVendor()->getId()) {
                    $session->addError(
                        Mage::helper('vendor')->__('This group cannot be edited.'));
                    $this->_redirect('*/*/');
                    return;
                }
            }
            Mage::register('attribute_group', $model);
            $this->loadLayout();
            $this->getLayout()->getBlock('head')->setTitle($this->__('Edit Attribute'));
            $this->_initLayoutMessages('vendor/session');
            $this->renderLayout();
        } catch (Exception $e) {
            $session->addError($e->getMessage());
            $this->_redirect('*/*/index');
        }
    }

    public function saveAction()
    {
        echo "<pre>";
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('vendor/account/login');
        }
        $data = $this->getRequest()->getPost();
       /* print_r($data);
        die();*/
        
        if ($data) {
            $vendor = $this->_getSession()->getVendor();
            $product = Mage::getModel('vendor/product');
            $attributeSetId = $product->getResource()->getEntityType()->getDefaultAttributeSetId();
            $model = Mage::getModel('eav/entity_attribute_group');
            $id = $this->getRequest()->getParam('entity_id');
            $groupName = $vendor->getId().'_'.$this->getRequest()->getPost('name');
           
            $model->setAttributeGroupName($groupName)
                ->setAttributeSetId($attributeSetId);
            print_r($model); 
            if ($model->itemExists()) {
                Mage::getSingleton('vendor/session')->addError(Mage::helper('vendor')->__('A Group With same name exist already.'));
                $this->_redirect('*/*/edit');
            }
                try {
                    $modelGroup = Mage::getModel('vendor/product_group_name');
                    if ($attributeSetId = $modelGroup->load($id)->getAttributeGroupId()) {
                        $model->setAttributeGroupId($attributeSetId);
                    }
                    $model->save();
                   
                    $modelGroup->setVendorId($vendor->getId());
                    $modelGroup->setAttributeGroupId($model->getId());
                    $modelGroup->setName($this->getRequest()->getPost('name'));
                    $modelGroup->save();
                    Mage::getSingleton('vendor/session')->addSuccess(Mage::helper('vendor')->__('Information added successfully.'));                
                } catch (Exception $e) {
                    Mage::getSingleton('vendor/session')->addError(Mage::helper('vendor')->__('An error occuring while save.'));
                }
        }
        print_r($modelGroup);   
        
        $this->_redirect('*/*/');
    }
}


 ?>