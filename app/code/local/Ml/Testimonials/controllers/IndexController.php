<?php
/**
 * Class Ml_Testimonials_IndexController
 */
class Ml_Testimonials_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Get testimonial helper
     *
     * @return Ml_Testimonials_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('ml_testimonials');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('core/session');
        $this->renderLayout();
    }

    public function editAction()
    {
        if ($this->_getHelper()->isCustomerLoggedIn()) {
            $this->loadLayout();
            $this->_initLayoutMessages('core/session');
            $this->renderLayout();
        } else {
            $this->_redirect('testimonials/index/index');
            Mage::getSingleton('core/session')
                ->addError(
                    $this->_getHelper()->__('Please, login for adding new testimonials')
                );
        }
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();

        foreach ($data as &$field) {
            $this->_getHelper()->stripTags($field);
        }

        /** @var Ml_Testimonials_Model_Testimonials $model */
        $testimonial = Mage::getModel('ml_testimonials/testimonials');
        $testimonial->setCustomerId(Mage::helper('ml_testimonials')->getLoggedCustomerId())
            ->setCustomerEmail($data['email'])
            ->setStoreId(Mage::app()->getStore()->getStoreId())
            ->setDescription($data['description'])
            ->setCreatedAt(Zend_Date::now());

        try {
            if ($testimonial->validate() === true) {
                $testimonial->save();
                $this->_redirect('*/*/index');
            } else {
                $this->_getHelper()->showNotifications($testimonial->validate());
                $this->_redirectReferer();
            }
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

}