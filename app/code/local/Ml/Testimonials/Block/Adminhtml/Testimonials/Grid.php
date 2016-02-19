<?php

/**
 * Class Ml_Testimonials_Block_Adminhtml_Testimonials_Grid
 */
class Ml_Testimonials_Block_Adminhtml_Testimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->setId('grid_id');
        $this->setDefaultSort('COLUMN_ID');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection for grid
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('ml_testimonials/testimonials')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {

        $this->addColumn('customer_id', array (
                'header'=> $this->__('Customer Id'),
                'width' => '50px',
                'index' => 'customer_id'
            )
        );

        $this->addColumn('store_id', array (
                'header'          => $this->__('Store Id'),
                'width'           => '50px',
                'index'           => 'store_id',
                'type'            => 'store',
                'store_view'      => true,
                'display_deleted' => true,
            )
        );

        $this->addColumn('customer_email', array (
                'header'=> $this->__('Customer Email'),
                'width' => '50px',
                'index' => 'customer_email'
            )
        );

        $this->addColumn('description', array (
                'header'=> $this->__('Testimonial'),
                'width' => '50px',
                'index' => 'description'
            )
        );

        $this->addColumn('is_active', array (
                'header'=> $this->__('Is Active'),
                'width' => '50px',
                'index' => 'is_active'
            )
        );

        $this->addColumn('created_at', array (
                'header'=> $this->__('Created At'),
                'width' => '50px',
                'index' => 'created_at',
                'type'  => 'datetime',
            )
        );

        $this->addColumn('updated_at', array (
                'header'=> $this->__('Updated At'),
                'width' => '50px',
                'index' => 'updated_at',
                'type'  => 'datetime',
            )
        );

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));
        $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));
        
        return parent::_prepareColumns();
    }

    /**
     * Get testimonial row url
     *
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
       return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Prepare grid massaction
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('ml_testimonials/testimonials')->getResource()->getIdFieldName();

        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'=> $this->__('Delete'),
             'url'  => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
}
