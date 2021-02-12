<?php

namespace UbexPay\Api;

use UbexPay\Common\UbexPayModel;

/**
 * RedirectUrls Class
 * @property string $successUrl  The URL to redirect after successful payment
 * @property string $cancelUrl   The URL to redirect after failed payment
 *
 */

class RedirectUrls extends UbexPayModel
{
    /**
     * Sets success link
     * @param string $url Success URL
     *
     * @return \UbexPay\Api\RedirectUrls RedirectUrls
     */
    public function setSuccessUrl($url) {
        $this->successUrl = $url;
        return $this;
    }
    /**
     * Get the Success URL
     * @return string $successUrl The success URL
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }
    /**
     * Sets cancel link
     * @param string $url Cancel URL
     *
     * @return \UbexPay\Api\RedirectUrls RedirectUrls
     */
    public function setCancelUrl($url) {
        $this->cancelUrl = $url;
        return $this;
    }

    /**
     * Get the Cancel URL
     * @return string $cancelUrl The cancel URL
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }
}