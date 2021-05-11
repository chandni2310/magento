<?php
class Ccc_User_Block_Adminhtml_User_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        /* $form = new Varien_Data_Form();
        $this->setForm($form); */

        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('user_form', array('legend'=>Mage::helper('user')->__('User information')));
        $fieldset->addField('user_name', 'text', array(
        'label' => Mage::helper('user')->__('User Name'),
        'class' => 'required-entry',
        'required' => true,
        'name' => 'user_name',
        ));

        /* $fieldset->addField('status', 'select', array(
        'label' => Mage::helper('user')->__('Status'),
        'name' => 'status',
        'values' => array(
            array(
            'value' => 1,
            'label' => Mage::helper('user')->__('Active'),
            ),
            array(
            'value' => 0,
            'label' => Mage::helper('user')->__('Inactive'),
            ),
            ),
        )); */
        
        if ( Mage::getSingleton('adminhtml/session')->getUserData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getUserData());
            Mage::getSingleton('adminhtml/session')->setUserData(null);
        }
        elseif ( Mage::registry('user_data') )
        {
            $form->setValues(Mage::registry('user_data')->getData());
        }
        return parent::_prepareForm();
    }
}