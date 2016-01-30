# Magento module: Order to Customer Quote
Magento module to set order related quote as customer active quote.
Born as proof of concept from a [question in Magento SE](http://magento.stackexchange.com/questions/99645/can-magento-do-custom-quotes-with-link-to-cart/99680).

When you create an order for a specific customer in the Admin Panel, a not-active quote is created and linked to current customer.

You can add items in the order, change prices, apply coupons and so on; all these changes are saved to the not-active quote even if you don't submit the order.

This extension adds a "Set as Customer Cart" button in the Admin Panel's "Create Order" view which allows you to set the current not-active quote as the current active quote for the customer you are creating the order for.

Pay attention: this action is not reversible: when the customer logs its old cart is replaced by the cart assembled by the store manager in the Admin Panel.

This extension can be useful if the store manager has to assemble cart content in place of the customer.
The customer is still free to change cart contents.

## Facts

Developed and tested on Magento CE v 1.9.2.0

## Installation
You can install this extension in several ways:

**Download**

Download the full package, copy the content of the `src` directory in your Magento base directory; pay attention not to overwrite the `app` folder, only merge its contents into existing directory;

**Modman**

Install modman Module Manager from https://github.com/colinmollenhour/modman

After having installed modman on your system, you can clone this module on your
Magento base directory by typing the following command:

    $ modman init
    $ modman clone git@github.com:aleron75/mageo2cq.git

**Composer**

Install composer from http://getcomposer.org/download/

Type the following command:

    $ php composer.phar require aleron75/mageo2cq:dev-master

or

    $ composer require aleron75/mageo2cq:dev-master
    
Note: replace the `dev-master` with a tagged release as soon as it is available.

**Common tasks**

After installation:

* if you have **cache** enabled, disable or refresh it;
* if you have **compilation** enabled, disable it or recompile the code base.

## Closing words
This extension is published under the [Open Software License (OSL 3.0)](http://opensource.org/licenses/OSL-3.0).

Any contribution or feedback is extremely appreciated.
