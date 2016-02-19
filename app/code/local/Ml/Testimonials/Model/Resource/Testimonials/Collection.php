<?php
/**
 * Class Ml_Testimonials_Model_Resource_Testimonials_Collection
 */
class Ml_Testimonials_Model_Resource_Testimonials_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('ml_testimonials/testimonials');
    }

}