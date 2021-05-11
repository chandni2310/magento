<?php
class Ccc_User_Block_Adminhtml_User_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('userGrid');
        // This is the primary key of the database
        $this->setDefaultSort('user_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('user/user')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $this->addColumn('user_id', array(
        'header' => Mage::helper('user')->__('ID'),
        'align' =>'right',
        'width' => '50px',
        'index' => 'user_id',
        ));

        $this->addColumn('user_name', array(
        'header' => Mage::helper('user')->__('User Name'),
        'align' =>'left',
        'index' => 'user_name',
        ));

        /* $this->addColumn('created_time', array(
        'header' => Mage::helper('user')->__('Creation Time'),
        'align' => 'left',
        'width' => '120px',
        'type' => 'date',
        'default' => '–',
        'index' => 'created_time',
        ));

        $this->addColumn('update_time', array(
        'header' => Mage::helper('user')->__('Update Time'),
        'align' => 'left',
        'width' => '120px',
        'type' => 'date',
        'default' => '–',
        'index' => 'update_time',
        ));

        $this->addColumn('status', array(
        'header' => Mage::helper('user')->__('Status'),
        'align' => 'left',
        'width' => '80px',
        'index' => 'status',
        'type' => 'options',
        'options' => array(
        1 => 'Active',
        0 => 'Inactive',
        ),
        )); */

        return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}