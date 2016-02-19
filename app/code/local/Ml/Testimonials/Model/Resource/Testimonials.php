<?php
/**
 * Class Ml_Testimonials_Model_Resource_Testimonials
 */
class Ml_Testimonials_Model_Resource_Testimonials extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('ml_testimonials/testimonials', 'testimonial_id');
    }

}