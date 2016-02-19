<?php

/**
 * Class Ml_Testimonials_Block_Adminhtml_Testimonials_Edit_Form
 */
class Ml_Testimonials_Block_Adminhtml_Testimonials_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Get testimonials model
     *
     * @return mixed
     */
    protected function _getModel()
    {
        return Mage::registry('current_model');
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
     * Get tilte for form
     *
     * @return string
     */
    protected function _getModelTitle()
    {
        return 'Testimonilas';
    }

    /**
     * Prepare form fields
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $model  = $this->_getModel();

        $modelTitle = $this->_getModelTitle();

        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->_getHelper()->__("$modelTitle Information"),
            'class'     => 'fieldset-wide',
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk,
            ));
        }

        $fieldset->addField('customer_email', 'text', array(
            'name'      => 'customer_email',
            'label'     => $this->_getHelper()->__('Customer Email'),
            'title'     => $this->_getHelper()->__('Customer Email'),
            'required'  => true,
        ));

        $fieldset->addField('store_id', 'multiselect', array(
            'name'      => 'store_id',
            'label'     => $this->_getHelper()->__('Store Id'),
            'title'     => $this->_getHelper()->__('Store Id'),
            'required'  => true,
            'values' => Mage::getSingleton('adminhtml/system_store')
                ->getStoreValuesForForm(false, true),
        ));

        $fieldset->addField('description', 'textarea', array(
            'name'      => 'description',
            'label'     => $this->_getHelper()->__('Testimonial'),
            'title'     => $this->_getHelper()->__('Testimonial'),
            'required'  => true,
        ));

        $fieldset->addField('is_active', 'select', array(
            'name'      => 'is_active',
            'label'     => $this->_getHelper()->__('Is Active'),
            'title'     => $this->_getHelper()->__('Is Active'),
            'required'  => true,
            'options'   => array(
                '1' => $this->_getHelper()->__('Yes'),
                '0' => $this->_getHelper()->__('No'),
            ),
        ));

        $fieldset->addField('created_at', 'date', array(
            'name'      => 'created_at',
            'label'     => $this->_getHelper()->__('Created At'),
            'title'     => $this->_getHelper()->__('Created At'),
            'readonly' => true,
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => $dateFormatIso,
            'format'       => $dateFormatIso,
            'time' => true,
        ));

        $fieldset->addField('updated_at', 'date', array(
            'name'      => 'updated_at',
            'label'     => $this->_getHelper()->__('Updated At'),
            'title'     => $this->_getHelper()->__('Updated At'),
            'readonly' => true,
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => $dateFormatIso,
            'format'       => $dateFormatIso,
            'time' => true,
        ));
//          // custom renderer (optional)
//          $renderer = $this->getLayout()->createBlock('Block implementing Varien_Data_Form_Element_Renderer_Interface');
//          $field->setRenderer($renderer);

//      // New Form type element (extends Varien_Data_Form_Element_Abstract)
//        $fieldset->addType('custom_element','MyCompany_MyModule_Block_Form_Element_Custom');  // you can use "custom_element" as the type now in ::addField([name], [HERE], ...)


        if($model){
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
