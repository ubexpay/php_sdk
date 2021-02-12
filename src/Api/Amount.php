<?php
namespace UbexPay\Api;

use UbexPay\Common\UbexPayModel;

/**
 * Class Amount, Order Amount 
 * @property double $totalAmount Total Order Amount
 * @property string $currency Order Currency
 *
 */
class Amount extends UbexPayModel
{

    /**
     * Set the order total
     * @param  double  $amount Order Amount
     * @return \UbexPay\Api\Amount Amount Object
     */
    public function setTotal($amount)
    {
        $this->totalAmount = $amount;
        return $this;
    }
    /**
     * Get the order currency
     * @return  string $totalAmount Order total amount
     */
    public function getTotal()
    {
        return $this->totalAmount;
    }

    /**
     * Set the order currency
     * @param  string  $currency order currency
     * @return \UbexPay\Api\Amount Amount object
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get the order currency
     * @return  string $currency Order currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

}
