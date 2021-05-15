<?php

class Ccc_Vendor_Adminhtml_VendorproductController extends Mage_Adminhtml_Controller_Action
{

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('vendor/vendor');
    }

    public function indexAction()
    {
       /* echo 'hello';
        die();*/
        $this->loadLayout();
        $this->_setActiveMenu('vendor');
        $this->_title('Vendor Product Grid');

        $this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_product'));

        $this->renderLayout();
    }

    protected function _initVendor()
    {
        $this->_title($this->__('Vendor Product'))
            ->_title($this->__('Manage vendors product'));

        $vendorProductId = (int) $this->getRequest()->getParam('id');
        $vendorProduct   = Mage::getModel('vendor/product')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($vendorProductId);
           /* echo '<pre>';
            print_r($vendorProduct);
            die();*/

        Mage::register('current_vendorProduct', $vendorProduct);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $vendorProduct;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $vendorProductId = (int) $this->getRequest()->getParam('id');
        $vendorProduct   = $this->_initVendor();

        if ($vendorProductId && !$vendorProduct->getId()) {
            $this->_getSession()->addError(Mage::helper('vendor')->__('This vendor product no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($vendorProduct->getName());

        $this->loadLayout();

        $this->_setActiveMenu('vendor/vendor');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();

    }

    public function saveAction()
    {

        try {

            $vendorProductData = $this->getRequest()->getPost('account');
            /*print_r($vendorProductData);
            die();*/

            $vendorProduct = Mage::getSingleton('vendor/product');
           /* print_r($vendorProduct);
            die();*/

            if ($vendorProductId = $this->getRequest()->getParam('id')) {

                if (!$vendorProduct->load($vendorProductId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

            }

            $vendorProduct->addData($vendorProductData);

            $vendorProduct->save();

            Mage::getSingleton('core/session')->addSuccess("Vendor Product data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }

    }

    public function deleteAction()
    {
        try {

            $vendorProductModel = Mage::getModel('vendor/product');

            if (!($vendorProductId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$vendorProductModel->load($vendorProductId)) {
                throw new Exception('vendor product does not exist');
            }

            if (!$vendorProductModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The vendor product has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}
