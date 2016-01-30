<?php
class Aleron75_OrderToCustomerQuote_Model_Observer
{
    /**
     * @event adminhtml_widget_container_html_before
     */ 
    public function addSetActiveQuoteButton(Varien_Event_Observer $event)
    {
        $block = $event->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Sales_Order_Create) {
            $h = Mage::helper('aleron75_ordertocustomerquote');
            $msgGo = $h->__('This will cause customer cart to be replaced: do you want to proceed?');
            $msgActive = $h->__('Already set as Customer Cart');

            $quoteSession = Mage::getSingleton('adminhtml/session_quote');
            $quote = $quoteSession->getQuote();
            $class = $quote->getIsActive() ? 'disabled' : 'go';
            $onclick = $quote->getIsActive() ? "alert('{$msgActive}')" : "confirmSetLocation('{$msgGo}', '{$block->getUrl('*/orderToCustomerQuote/index')}')";

            $block->addButton(
                'set_active_quote',
                array(
                    'label' => $h->__('Set as Customer Cart'),
                    'onclick' => $onclick,
                    'class' => $class
                )
            );
        }
    }
}
