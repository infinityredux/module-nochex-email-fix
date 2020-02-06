<?php
namespace InfinityRedux\NochexEmailFix\Plugin;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Email\Sender\OrderSender;

class PreventEmailSend
{
    /**
     * Duplicate the overall effect of the replacement file method (prevent the email being sent, if the order is using
     * nochex payment and is still pending) without directly modifying Magento code.
     *
     * Since we need to (potentially) prevent the normal operation of the function, we use the around style of plugin;
     * this does mean that this function call will appear in stack traces, etc. and may impact on performance.
     *
     * @param OrderSender $subject
     * @param callable $proceed
     * @param Order $order Original parameter.
     * @param bool $forceSyncMode
     * @return bool
     * @see \Magento\Sales\Model\Order\Email\Sender\OrderSender
     * @see https://devdocs.magento.com/guides/v2.3/extension-dev-guide/plugins.html
     */
    public function aroundSend($subject, callable $proceed, Order $order, $forceSyncMode = false) {
        $payment = $order->getPayment()->getMethodInstance()->getCode();
        if ($payment == 'nochex') {
            if ($order->getStatus() == "pending") {
                return false;
            }
        }
        return $proceed($order, $forceSyncMode);
    }
}