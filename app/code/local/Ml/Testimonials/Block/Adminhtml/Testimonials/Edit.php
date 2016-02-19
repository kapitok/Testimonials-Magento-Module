<?php

/**
 * Class Ml_Testimonials_Block_Adminhtml_Testimonials_Edit
 */
class Ml_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Class constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_blockGroup  = 'ml_testimonials';
        $this->_controller  = 'adminhtml_testimonials';
        $this->_mode        = 'edit';

        $modelTitle = $this->_getModelTitle();

        $this->_updateButton('save', 'label', $this->_getHelper()->__("Save $modelTitle"));
        $this->_addButton('saveandcontinue', array(
            'label'     => $this->_getHelper()->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get module helper
     *
     * @return Mage_Core_Helper_Abstract
     */
    protected function _getHelper()
    {
        return Mage::helper('ml_testimonials');
    }

    /**
     * Return testimonial model
     *
     * @return mixed
     */
    protected function _getModel()
    {
        return Mage::registry('current_model');
    }

    /**
     * Get model title
     *
     * @return string
     */
    protected function _getModelTitle()
    {
        return 'Testimonilas';
    }

    /**
     * Get header text for current testimonial
     *
     * @return string
     */
    public function getHeaderText()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        if ($model && $model->getId()) {
           return $this->_getHelper()->__("Edit $modelTitle (ID: {$model->getId()})");
        }
        else {
           return $this->_getHelper()->__("New $modelTitle");
        }
    }


    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }

    /**
     * Get form save URL
     *
     * @deprecated
     * @see getFormActionUrl()
     * @return string
     */
    public function getSaveUrl()
    {
        $this->setData('form_action_url', 'save');
        return $this->getFormActionUrl();
    }


}
