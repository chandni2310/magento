<?php

class Ccc_Example_Block_Adminhtml_Example_Edit_Tab_Attribute extends Mage_Adminhtml_Block_Widget_Form
{

    public function getExample()
    {
        return Mage::registry('current_example');
    }


    protected function _prepareLayout()
    {
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        parent::_prepareLayout();
           
    }

    protected function _prepareForm()
    {

        $group = $this->getGroup();
        /*echo '<pre>';
        print_r($group);
        die();*/
        $attributes = $this->getAttributes();

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $form->setDataObject($this->getExample());
        $form->setHtmlIdPrefix('group_' . $group->getId());
        $form->setFieldNameSuffix('account');
        $fieldset = $form->addFieldset('fieldset_group_' . $group->getId(), array(
            'legend'    => Mage::helper('example')->__($group->getAttributeGroupName()),
            'class'     => 'fieldset',
        ));


        $this->_setFieldset($attributes, $fieldset);

        $form->addValues($this->getExample()->getData());

        return parent::_prepareForm();
    }


}
