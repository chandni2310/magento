<?php

class Ccc_Example_Block_Adminhtml_Example_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{


    public function __construct()
    {
      parent::__construct();
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('example')->__('Example Information'));
    }
    public function getExample()
    {
        return Mage::registry('current_example');
    }

    protected function _beforeToHtml()
    {

        $exampleAttributes = Mage::getResourceModel('example/example_attribute_collection');
        // echo '<pre>';
        // print_r($exampleAttributes);
        // die();

        if (!$this->getExample()->getId()) {
            foreach ($exampleAttributes as $attribute) {
                $default = $attribute->getDefaultValue();
                if ($default != '') {
                    $this->getExample()->setData($attribute->getAttributeCode(), $default);
                }
            }
        }

        $attributeSetId = $this->getExample()->getResource()->getEntityType()->getDefaultAttributeSetId();



        // $attributeSetId = 21;
        
        $groupCollection = Mage::getResourceModel('eav/entity_attribute_group_collection')
            ->setAttributeSetFilter($attributeSetId)
            ->setSortOrder()
            ->load();
        /*echo '<pre>';
        print_r($groupCollection);
        die();*/

        $defaultGroupId = 0;
        foreach ($groupCollection as $group) {
            /*echo '<pre>';
            print_r($group);
            die();*/
            if ($defaultGroupId == 0 or $group->getIsDefault()) {
                $defaultGroupId = $group->getId();
            }

        }	


        foreach ($groupCollection as $group) {
            $attributes = array();
            foreach ($exampleAttributes as $attribute) {
                if ($this->getExample()->checkInGroup($attribute->getId(),$attributeSetId, $group->getId())) {
                    $attributes[] = $attribute;
                }
            }

            if (!$attributes) {
                continue;
            }

            $active = $defaultGroupId == $group->getId();
            $block = $this->getLayout()->createBlock('example/Adminhtml_example_edit_tab_attribute')
                ->setGroup($group)
                ->setAttributes($attributes)
                ->setAddHiddenFields($active)
                ->toHtml();
            $this->addTab('group_' . $group->getId(), array(
                'label'     => Mage::helper('example')->__($group->getAttributeGroupName()),
                'content'   => $block,
                'active'    => $active
            ));
        }
      return parent::_beforeToHtml();
    }
}
