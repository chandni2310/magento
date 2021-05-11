<?php
class Ccc_User_Block_Adminhtml_User_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'user';
        $this->_controller = 'adminhtml_user';
        $this->_updateButton('save', 'label', Mage::helper('user')->__('Save User'));
        $this->_updateButton('delete', 'label', Mage::helper('user')->__('Delete User'));
    }
    public function getHeaderText()
    {
        if( Mage::registry('user_data') && Mage::registry('user_data')->getId() ) {
            return Mage::helper('user')->__("Edit User '%s'", $this->htmlEscape(Mage::registry('user_data')->getUserName()));
        } 
        else 
        {
            return Mage::helper('user')->__('Add User');
        }
    }
}