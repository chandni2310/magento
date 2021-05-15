<?php 
class Ccc_Vendor_Block_Widget_Grid extends Mage_Core_Block_Template
{


    protected $_collection = null;

    protected $_columns = array();

    protected $_pager = null;

    protected $_headerText = null;

    protected $_addBtnLabel = null;

    protected $_addBtnUrl = null;


    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('vendor/widget/grid.phtml');
    }

    public function setCollection($collection)
    {
        if ($collection) {
            $this->_pager->setCollection($collection);
            $this->_collection = $collection;
            $this->setChild('pager', $this->_pager);
        }
        return $this;
    }

    public function getCollection()
    {
        return $this->_collection;
    }

    protected function _prepareCollection()
    {
        return $this;
    }

    protected function _prepareColumns()
    {
        return $this;
    }


    public function addColumn($columnId, $column)
    {
        $this->_columns[$columnId] = $column;
        return $this;
    }

    public function removeColumn($columnId)
    {

        if (array_key_exists($columnId, $this->_columns)) {
            unset($this->_columns[$columnId]);
        }

        return $this;
    }

    public function getColumn($columnId)
    {
        if (array_key_exists($columnId, $this->_columns)) {
            return $this->_columns[$columnId];
        }
        return false;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    protected function _prepareLayout()
    {
        $pager = $this->getLayout()->createBlock('page/html_pager');
        $this->setPager($pager);
        $this->_prepareCollection();
        $this->_prepareColumns();
        return  parent::_prepareLayout();
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function setPager($pager)
    {
        $this->_pager = $pager;
        return $this;
    }

    public function getPager()
    {
        return $this->_pager;
    }

    public function getFieldValue($row, $field)
    {
        return $row->$field;
    }

    public function getAddButtonLabel()
    {
        if (!$this->_addBtnLabel) {
            $this->setAddButtonLabel();
        }
        return $this->_addBtnLabel;
    }

    public function setAddButtonLabel($buttonLabel = null)
    {
        if (!$buttonLabel) {
            $buttonLabel = $this->__('Add New');
        }
        $this->_addBtnLabel = $buttonLabel;
    }

    public function getHeaderText()
    {
        if (!$this->_headerText) {
            $this->setHeaderText();
        }

        return $this->_headerText;
    }

    public function setHeaderText($_headerText = null)
    {
        if (!$_headerText) {
            $_headerText = $this->__('Manage Data');
        }
        $this->_headerText = $_headerText;
    }

    public function getAddButtonUrl()
    {
        if (!$this->_addBtnUrl) {
            $this->setAddButtonUrl();
        }

        return $this->_addBtnUrl;
    }

    public function setAddButtonUrl($_addBtnUrl = null)
    {
        if (!$_addBtnUrl) {
            $_addBtnUrl = $this->getUrl('*/*/new');
        }
        $this->_addBtnUrl = $_addBtnUrl;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getDeleteRowUrl($row)
    {
        return $this->getUrl('*/*/delete', array('id' => $row->getId()));
    }
}


?>