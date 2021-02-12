<?php
namespace UbexPay\Api;

use UbexPay\Common\UbexPayModel;

/**
 * Class Payer
 * @property string $paymentMethod
 *
 */
class Payer extends UbexPayModel
{

    /**
     * Valid Values: ["paymoney"]
     * method will be like paymoney, paypal, stripe etc
     * @param  string  $method Payment Method
     * @return \UbexPay\Api\Payment Payment object
     */
    public function setPaymentMethod($method)
    {
        $this->paymentMethod = $method;
        return $this;
    }

    /**
     * @return string Pyament method
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

}
