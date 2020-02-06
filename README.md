# Nochex Email Fix
*infinityredux / module-nochex-email-fix*

This module solves an ongoing issue with how the official Nochex payment module "integrates" with Magento 2.

In particular, their setup instructions explicitly require that you replace a file in one of the Magento modules. A file installed by composer, and thus overwritten whenever composer checks or updates that module. Additionally, every time the official Magento version of the file changes (which has happened quite often with the 2.3.x line of releases so far) this replacement file breaks or causes other things to break. 

The purpose of this specific file replacement is to prevent emails being sent before payment has been completed. I won't digress into the implications of this approach in relation to how the payment module itself is implemented, but the functionality of the file itself (at least the modifications to it) is surprisingly simple.

So, this module has been created to replicate the changed functionality without ever modifying the Magento code directly.

*(Confirmed working with Magento 2.3.4; other 2.3.x versions should work, theoretically, but have not been tested. Compatibility of future versions depends on there being no breaking changes to the OrderSender class.)*
 