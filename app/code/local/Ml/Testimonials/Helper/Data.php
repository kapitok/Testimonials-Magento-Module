<?php
/**
 * Class Ml_Testimonials_Helper_Data
 */
class Ml_Testimonials_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Is customer logged in
     *
     * @return bool
     */
    public function isCustomerLoggedIn()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return true;
        }
        return false;
    }

    /**
     * Get of logged in customer ID
     *
     * @return int
     */
    public function getLoggedCustomerId()
    {
        if ($this->isCustomerLoggedIn()) {
            return Mage::getSingleton('customer/session')->getCustomer()->getId();
        }
        return 0;
    }

    /**
     * Show notifications for user
     *
     * @param array $notifications
     */
    public function showNotifications(array $notifications)
    {
        if (count($notifications) !== 0) {
            foreach ($notifications as $notification) {
                Mage::getSingleton('core/session')->addError($notification);
            }
        }
    }

}