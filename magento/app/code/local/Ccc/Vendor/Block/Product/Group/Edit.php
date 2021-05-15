<?php
class Ccc_Vendor_Block_Product_Group_Edit extends Mage_Eav_Block_Adminhtml_Attribute_Edit_Options_Abstract
{

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }
    public function getSaveUrl()
    {
        if (!$this->getGroup()) {
            return $this->getUrl('*/*/save');
        }
        $id = $this->getGroup()['entitiy_id'];
        return $this->getUrl('*/*/save', ['entitiy_id' => $id]);
    }

    public function getDeleteUrl()
    {
        $id = $this->getGroup()['attribute_id'];
        return $this->getUrl('*/*/delete', ['attribute_id' => $id]);
    }

    public function getGroup()
    {
        return Mage::registry('attribute_group');
    }

    protected function _getSession()
    {
        return Mage::getSingleton('vendor/session');
    }
  
    
    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }

    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_button');
    }
}

?>
