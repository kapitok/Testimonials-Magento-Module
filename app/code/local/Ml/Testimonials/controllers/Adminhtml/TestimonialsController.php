<?php

/**
 * Class Ml_Testimonials_Adminhtml_TestimonialsController
 */
class Ml_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('ml_testimonials/adminhtml_testimonials'));
        $this->renderLayout();
    }

    public function exportCsvAction()
    {
        $fileName = 'Testimonilas_export.csv';
        $content = $this->getLayout()->createBlock('ml_testimonials/testimonials_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction()
    {
        $fileName = 'Testimonilas_export.xml';
        $content = $this->getLayout()->createBlock('ml_testimonials/testimonials_grid')->getExcel();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select Testimonilas(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('ml_testimonials/testimonials')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('ml_testimonials')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('ml_testimonials/testimonials');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('ml_testimonials')->__('This Testimonilas no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('current_model', $model);

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('ml_testimonials/adminhtml_testimonials_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('ml_testimonials/testimonials');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        Mage::helper('ml_testimonials')->__('This Testimonilas no longer exists.')
                    );
                    $this->_redirect('*/*/index');
                    return;
                }
            }

            try {
                $model->addData($data);
                $this->_getSession()->setFormData($data);
                $model->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    Mage::helper('ml_testimonials')->__('The Testimonilas has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('ml_testimonials')->__('Unable to save the Testimonilas.'));
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {

                $model = Mage::getModel('ml_testimonials/testimonials');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('ml_testimonials')->__('Unable to find a Testimonilas to delete.'));
                }
                $model->delete();

                $this->_getSession()->addSuccess(
                    Mage::helper('ml_testimonials')->__('The Testimonilas has been deleted.')
                );

                $this->_redirect('*/*/index');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('ml_testimonials')->__('An error occurred while deleting Testimonilas data. Please review log and try again.')
                );
                Mage::logException($e);
            }

            $this->_redirect('*/*/edit', array('id' => $id));
            return;
        }

        $this->_getSession()->addError(
            Mage::helper('ml_testimonials')->__('Unable to find a Testimonilas to delete.')
        );
        $this->_redirect('*/*/index');
    }
}