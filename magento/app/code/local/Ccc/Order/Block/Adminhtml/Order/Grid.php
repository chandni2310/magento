<?php
class Ccc_Order_Block_Adminhtml_Order_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
       /* $this->setId('orderGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');*/
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass(){
    	return 'order/order_collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }


    public function _prepareColumns(){
    	 $this->addColumn('order_id',
            array(
                'header' => Mage::helper('order')->__('id'),
                'width'  => '50px',
                'index'  => 'order_id',
            ));
    	  $this->addColumn('customer_name',
            array(
                'header' => Mage::helper('order')->__('Customer Name'),
                'width'  => '50px',
                'index'  => 'customer_name',
            ));
    	   $this->addColumn('customer_email',
            array(
                'header' => Mage::helper('order')->__('Customer Email'),
                'width'  => '50px',
                'index'  => 'customer_email',
            ));
           $this->addColumn('total',
            array(
                'header' => Mage::helper('order')->__('Total'),
                'width'  => '50px',
                'index'  => 'total',
            ));

           $this->addColumn('action',
            array(
                'header'    => Mage::helper('sales')->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('order')->__('View Order'),
                        'url'     => array('base'=>'*/adminhtml_order/view'),
                        'field'   => 'order_id',
                        'data-column' => 'action',
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
       
    	parent::_prepareColumns();
        return $this;
    }

    

    public function getGridUrl()
    {
        return $this->getUrl('*/*/index', array('_current'=>true));
    }
}