<?php 
class Ccc_Order_Block_Adminhtml_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_addButtonLabel = Mage::helper('order')->__('Create New Order');
        $this->_controller = 'adminhtml_order';
        $this->_blockGroup = 'order';
        $this->_headerText = Mage::helper('order')->__('Orders');
        parent::__construct();
       
        /*if (!Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/create')) {
            $this->_removeButton('add');
        }*/
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/adminhtml_order/newOrder');
    }

}