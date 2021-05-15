<?php

class Ccc_Vendor_Model_Address extends Mage_Customer_Model_Address_Abstract
{
    protected $_vendor;

    protected function _construct()
    {
        $this->_init('vendor/address');
    }

    /**
     * Retrieve address customer identifier
     *
     * @return integer
     */
    public function getVendorId()
    {
        return $this->_getData('vendor_id') ? $this->_getData('vendor_id') : $this->getParentId();
    }

    /**
     * Declare address customer identifier
     *
     * @param integer $id
     * @return Mage_Customer_Model_Address
     */
    public function setVendorId($id)
    {
        $this->setParentId($id);
        $this->setData('vendor_id', $id);
        return $this;
    }

    /**
     * Retrieve address customer
     *
     * @return Mage_Customer_Model_Customer | false
     */
    public function getVendor()
    {
        if (!$this->getVendorId()) {
            return false;
        }
        if (empty($this->_vendor)) {
            $this->_vendor = Mage::getModel('vendor/vendor')
                ->load($this->getVendorId());
        }
        return $this->_vendor;
    }

    /**
     * Specify address customer
     *
     * @param Mage_Customer_Model_Customer $customer
     */
    public function setCustomer(Ccc_Vendor_Model_Vendor $vendor)
    {
        $this->_vendor = $vendor;
        $this->setVendorId($vendor->getId());
        return $this;
    }

    /**
     * Delete customer address
     *
     * @return Mage_Customer_Model_Address
     */
    public function delete()
    {
        parent::delete();
        $this->setData(array());
        return $this;
    }

    /**
     * Retrieve address entity attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        $attributes = $this->getData('attributes');
        if (is_null($attributes)) {
            $attributes = $this->_getResource()
                ->loadAllAttributes($this)
                ->getSortedAttributes();
            $this->setData('attributes', $attributes);
        }
        return $attributes;
    }

    public function __clone()
    {
        $this->setId(null);
    }

    /**
     * Return Entity Type instance
     *
     * @return Mage_Eav_Model_Entity_Type
     */
    public function getEntityType()
    {
        return $this->_getResource()->getEntityType();
    }

    /**
     * Return Entity Type ID
     *
     * @return int
     */
    public function getEntityTypeId()
    {
        $entityTypeId = $this->getData('entity_type_id');
        if (!$entityTypeId) {
            $entityTypeId = $this->getEntityType()->getId();
            $this->setData('entity_type_id', $entityTypeId);
        }
        return $entityTypeId;
    }

    /**
     * Return Region ID
     *
     * @return int
     */
    public function getRegionId()
    {
        return (int)$this->getData('region_id');
    }

    /**
     * Set Region ID. $regionId is automatically converted to integer
     *
     * @param int $regionId
     * @return Mage_Customer_Model_Address
     */
    public function setRegionId($regionId)
    {
        $this->setData('region_id', (int)$regionId);
        return $this;
    }
}
