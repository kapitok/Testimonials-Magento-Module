<?php
/**
 * Class Ml_Testimonials_Block_Edit
 */
class Ml_Testimonials_Block_Edit extends Mage_Core_Block_Template
{
    /**
     * Get form action
     *
     * @return string
     */
    protected function _getFormAction()
    {
        return $this->getUrl('testimonials/index/save');
    }

    /**
     * Get current customer
     *
     * @return Mage_Customer_Model_Customer
     */
    protected function _getCurrentCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }

}