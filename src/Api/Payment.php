<?php
namespace UbexPay\Api;

use UbexPay\Common\UbexPayModel;

/**
 * Payment Class
 * @property \UbexPay\Api\Payer $payer Payer Object
 * @property \UbexPay\Api\Transaction $transaction Transaction object
 * @property \UbexPay\Api\RedirectUrls $redirectUrls Redirect URLs object
 * @property array $credentials Merchant credentials[cliend id and secret]
 * @property string $approvedUrl Approved payment URL 
 * @property string $baseUrl Base API URL
 */
class Payment extends UbexPayModel
{

    /**
     * Set the API server base URL.
     * 
     * @param string $baseUrl API Server base URL
     */
    public function __construct($baseUrl)
    {
        parent::__construct();
        $this->baseUrl = $baseUrl;
    }


    /**
     * Sets payer object
     * @param \UbexPay\Api\Payer $payer
     *
     * @return Payment $this
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Sets Trasaction Object
     * @param \UbexPay\Api\Transaction $transaction
     *
     * @return \UbexPay\Api\Payment
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Sets Redirect URLs
     * 
     * @param \UbexPay\Api\RedirectUrls $redirectUrls
     *
     * @return \UbexPay\Api\Payment
     */
    public function setRedirectUrls($redirectUrls)
    {
        $this->redirectUrls = $redirectUrls;
        return $this;
    }

    public function getRedirectUrls()
    {
        return $this->redirectUrls;
    }

    /** 
     * Sets the credentials, an array of client id and client secret
     * @param array $credentials
     *
     * @return \UbexPay\Api\Payment
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /** 
     * Gets the credentials, an array of client id and client secret
     * @return string $credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set the validated Url.
     * 
     * @var string $url the approved url
     * @return \UbexPay\Api\Payment
     */
    public function setApprovedUrl($url)
    {
        $this->approvedUrl = $url;
        return $this;
    }


    /** 
     * Gets the approved URL
     * @return string $approvedUrl
     */
    public function getApprovedUrl()
    {
        return $this->approvedUrl;
    }

    /**
     * Generates the access token
     * Uses the generated access token to process 
     * Set the $approveUrl link that has been validated.
     */

    public function create() {

        $accessToken = $this->getAccessToken();
        $approveUrl  = $this->sendTransactionInfo($accessToken);
        $this->setApprovedUrl($approveUrl);
    }

    /**
     * Send merchant credentials to API server.
     * Return Access Token received from the API
     * @return string $response
     */
    private function getAccessToken() {

        $array = $this->getCredentials();
        if (!$array['client_id'] || !$array['client_secret']) {
            echo 'Parameter array must contain with client_id, client_secret.';
            exit;
        }
        $client_id                = $array['client_id'];
        $client_secret            = $array['client_secret'];
        $payload['client_id']     = $client_id;
        $payload['client_secret'] = $client_secret;

        $res = $this->execute($this->baseUrl . '/merchant/api/verify', 'post', $payload);
        $res = json_decode($res);

        if (!$res) {
            echo "Please check you client iD or client secret again";
            exit;
        }

        if ($res->status == 'error') {
            echo $res->message;exit;
        }
        $response = $res->data->access_token;

        return $response;
    }

    /**
     * Send payment details to server.
     * 
     * @param string $token the access token
     * @return mixed Response received from the API
     */
    private function sendTransactionInfo($token) {
        $trans        = $this->getTransaction();
        $payer        = $this->getPayer();
        $redirectUrls = $this->getRedirectUrls();

        $amount        = $trans->amount->getTotal();
        $currency      = $trans->amount->getCurrency();
        $successUrl     = $redirectUrls->getSuccessUrl();
        $cancelUrl     = $redirectUrls->getCancelUrl();
        $paymentMethod = $payer->getPaymentMethod();

        $req['payer']     = $paymentMethod;
        $req['amount']    = $amount;
        $req['currency']  = $currency;
        $req['successUrl'] = $successUrl;
        $req['cancelUrl'] = $cancelUrl;

        $header = ['Authorization: Bearer ' . $token];

        $res = $this->execute($this->baseUrl . '/merchant/api/transaction-info', 'POST', $req, $header);
        $res = json_decode($res);

        if (!$res) {
            echo "Please check your transaction details again !";
            exit;
        }

        if ($res->status == 'error') {
            echo $res->message;
            exit;
        }

        $response = $res->data->approvedUrl;
        return $response;
    }

}