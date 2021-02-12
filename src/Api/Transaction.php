<?php namespace UbexPay\Api;

use UbexPay\Common\UbexPayModel;

/**
 * Class Transaction
 * @property \UbexPay\Api\Amount $amount Transaction amount
 *
 */

class Transaction extends UbexPayModel
{

    /**
     * @param \UbexPay\Api\Amount $amount
     *
     * @return \UbexPay\Api\Transaction $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}