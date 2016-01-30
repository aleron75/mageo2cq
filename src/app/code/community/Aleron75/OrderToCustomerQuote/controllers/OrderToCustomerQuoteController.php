<?php
class Aleron75_OrderToCustomerQuote_OrderToCustomerQuoteController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $h = Mage::helper('aleron75_ordertocustomerquote');

        /** @var Mage_Adminhtml_Model_Session_Quote $quoteSession */
        $quoteSession = Mage::getSingleton('adminhtml/session_quote');

        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $quoteSession->getQuote();

        /** @var Mage_Customer_Model_Customer $customer */
        $customer = $quoteSession->getCustomer();

        /** @var Mage_Core_Model_Store $store */
        $store = $quoteSession->getStore();

        if (!$quote || !$quote->getId()
            || !$customer || !$customer->getId()
            || !$store || !$store->getId()) {
            $msg = $h->__('There was a problem with current session data, action failed');
            $quoteSession->addError($msg);
            $this->_redirect('*/sales_order_create/index');
            return;
        }

        /** @var Mage_Sales_Model_Resource_Quote_Collection $customerQuotes */
        $customerQuotes = Mage::getModel('sales/quote')
            ->getCollection()
            ->addFieldToFilter('store_id', $store->getId())
            ->addFieldToFilter('is_active', 1)
            ->addFieldToFilter('customer_id', $customer->getId());

        /** @var Mage_Sales_Model_Quote $customerQuote */
        foreach ($customerQuotes as $customerQuote) {
            // saving in loop is not recommended according to #magebp but the expected collection size is 1
            $customerQuote
                ->setIsActive(0)
                ->save();
        }

        $quote
            ->setIsActive(1)
            ->save();

        $msg = $h->__('Current order cart successfully set as current customer cart.');
        $quoteSession->addSuccess($msg);
        $this->_redirect('*/sales_order_create/index');
    }
}