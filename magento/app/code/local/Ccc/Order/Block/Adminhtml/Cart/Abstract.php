<?php
abstract class Ccc_Order_Block_Adminhtml_Cart_Abstract extends Mage_Adminhtml_Block_Widget
{
    /**
     * Retrieve create order model object
     *
     * @return Mage_Adminhtml_Model_Sales_Order_Create
     */
    public function getCreateOrderModel()
    {
        return Mage::getSingleton('adminhtml/sales_order_create');
    }

    /**
     * Retrieve quote session object
     *
     * @return Mage_Adminhtml_Model_Session_Quote
     */
    protected function _getSession()
    {
        return Mage::getSingleton('adminhtml/session_quote');
    }

    /**
     * Retrieve quote model object
     *
     * @return Mage_Sales_Model_Quote
     */
    public function getQuote()
    {
        return $this->_getSession()->getQuote();
    }

    /**
     * Retrieve customer model object
     *
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer()
    {
        return $this->_getSession()->getCustomer();
    }

    /**
     * Retrieve customer identifier
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->_getSession()->getCustomerId();
    }

    /**
     * Retrieve store model object
     *
     * @return Mage_Core_Model_Store
     */
    public function getStore()
    {
        return $this->_getSession()->getStore();
    }

    /**
     * Retrieve store identifier
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->_getSession()->getStoreId();
    }

    /**
     * Retrieve formated price
     *
     * @param   decimal $value
     * @return  string
     */
    public function formatPrice($value)
    {
        return $this->getStore()->formatPrice($value);
    }

    public function convertPrice($value, $format=true)
    {
        return $this->getStore()->convertPrice($value, $format);
    }
}
