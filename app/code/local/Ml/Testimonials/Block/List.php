<?php
/**
 * Class Ml_Testimonials_Block_List
 */
class Ml_Testimonials_Block_List extends Mage_Core_Block_Template
{
    const TESTIMONIALS_PER_PAGE = 5;
    /**
     * Prepare list layout
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        /** @var Mage_Page_Block_Html_Pager $pager */
        $pager = $this->getLayout()
            ->createBlock('page/html_pager', 'testimonials_pager');

        $pager->setAvailableLimit([self::TESTIMONIALS_PER_PAGE=>self::TESTIMONIALS_PER_PAGE]);
            $pager->setCollection($this->_getActiveTestimonials());

        $this->setChild('pager', $pager);

        return parent::_prepareLayout();
    }

    /**
     * Get Active Testimonials collection
     *
     * @return Ml_Testimonials_Model_Resource_Testimonials_Collection
     * @throws Exception
     */
    protected function _getActiveTestimonials()
    {
        /** @var Ml_Testimonials_Model_Resource_Testimonials_Collection $testImonialsCollection */
        $testimonialsCollection = Mage::getModel('ml_testimonials/testimonials')
            ->getCollection()
            ->addFieldToFilter('is_active', true)
            ->setCurPage((int)$this->getRequest()->getParam('p') ?: 1)
            ->setPageSize(self::TESTIMONIALS_PER_PAGE);

        return $testimonialsCollection;
    }
}