<?php
/**
 * Class Ml_Testimonials_Model_Testimonials
 *
 * @method $this getTestimonialId()
 * @method $this getCustomerId()
 * @method $this getStoreId()
 * @method $this getCustomerEmail()
 * @method $this getDescription()
 * @method $this getCreatedAt()
 * @method $this getUpdatedAt()
 * @method $this isActive()
 */
class Ml_Testimonials_Model_Testimonials extends Mage_Core_Model_Abstract
{

    /**
     * Class constructor
     */
    protected function _construct()
    {
        $this->_init('ml_testimonials/testimonials');
    }

    /**
     * Testimonial validator
     *
     * @return array|bool
     * @throws Zend_Validate_Exception
     */
    public function validate()
    {
        $errors = array();
        /** @var Ml_Testimonials_Helper_Data $helper */
        $helper = Mage::helper('ml_testimonials');

        if (!Zend_Validate::is($this->getCustomerEmail(), 'EmailAddress')) {
            $errors[] = $helper->__('Invalid email address "%s".', $this->getCustomerEmail());
        }

        if (!Zend_Validate::is($this->getDescription(), 'NotEmpty')) {
            $errors[] = $helper->__('Please input testimonial.');
        }

        if (empty($errors)) {
            return true;
        }

        return $errors;
    }

}