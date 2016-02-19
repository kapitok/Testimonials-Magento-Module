<?php

/**
 * Class Ml_Testimonials_Block_Adminhtml_Testimonials
 */
class Ml_Testimonials_Block_Adminhtml_Testimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * Class constructor
     */
    public function _construct()
    {
        $this->_blockGroup      = 'ml_testimonials';
        $this->_controller      = 'adminhtml_testimonials';
        $this->_headerText      = $this->__('Testimonials');
        parent::_construct();
    }

    /**
     * Remove add button
     *
     * @return Mage_Core_Block_Abstract
     */
    public function _prepareLayout()
    {
        $this->_removeButton('add');
        return parent::_prepareLayout();

    }

    /**
     * Get url for create new testimonial
     *
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}

