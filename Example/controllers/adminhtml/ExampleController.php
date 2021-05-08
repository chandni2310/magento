<?php 
class Ccc_Example_Adminhtml_ExampleController extends Mage_Adminhtml_Controller_Action
{

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('example/example');
    }

    public function indexAction()
    {
    	//echo 'hello';
        $this->loadLayout();
        $this->_setActiveMenu('example');
        $this->_title('Example Grid');

        $this->_addContent($this->getLayout()->createBlock('example/adminhtml_example'));

        $this->renderLayout();
    }
     protected function _initExample()
    {
        $this->_title($this->__('Example'))
            ->_title($this->__('Manage Example'));

        $exampleId = (int) $this->getRequest()->getParam('id');
        $example   = Mage::getModel('example/example')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($exampleId);

        Mage::register('current_example', $example);
        //check use
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $example;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $exampleId = (int) $this->getRequest()->getParam('id');
        $example   = $this->_initExample();

        if ($exampleId && !$example->getId()) {
            $this->_getSession()->addError(Mage::helper('example')->__('This example no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($example->getName());

        $this->loadLayout();

        $this->_setActiveMenu('example/example');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();

    }

    public function saveAction()
    {

        try {

            $exampleData = $this->getRequest()->getPost('account');

            $example = Mage::getSingleton('example/example');

            if ($exampleId = $this->getRequest()->getParam('id')) {

                if (!$example->load($exampleId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

            }

            $example->addData($exampleData);

            $example->save();

            Mage::getSingleton('core/session')->addSuccess("example data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }

    }

    public function deleteAction()
    {
        try {

            $exampleModel = Mage::getModel('example/example');

            if (!($exampleId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$exampleModel->load($exampleId)) {
                throw new Exception('example does not exist');
            }

            if (!$exampleModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The example has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }


}


?>