<?php

require 'vendor/autoload.php';

use UbexPay\Api\Amount;
use UbexPay\Api\Payer;
use UbexPay\Api\Payment;
use UbexPay\Api\RedirectUrls;
use UbexPay\Api\Transaction;

//Payer Object
$payer = new Payer();
$payer->setPaymentMethod('UbexPay');

//Amount Object
$amountIns = new Amount();

/*
set order total and curency. 
Must give a valid currency code and must exist in merchant wallet list
*/
$amountIns->setTotal(10)->setCurrency('DZA');

//Transaction Object
$trans = new Transaction();
//Set transaction amount object
$trans->setAmount($amountIns);

//RedirectUrls Object
$urls = new RedirectUrls();

/*
success url - the store/site domain page, to redirect after successful payment and 
cancel url - the store/site domain page, to redirect after cancellation of payment
*/

$urls->setSuccessUrl('http://example.com/example-success.php')
    ->setCancelUrl('http:/example.com/example-fail-url.php');

//Payment Object
$payment = new Payment('https://ubexpay.com');
/*
Client ID & Secret = Merchants->setting(gear icon).  
must provide correct client secret of an express merchant
must provide correct client id of an express merchant
*/
$payment->setCredentials([
    'client_id'     => 'y2AUleB6tf5RnnILVo6fc4U7PqmKbn',
    'client_secret' => '2Hoql5EIUzSsCLb2iZbWMtEoJE1vQTSc6yHxzPd2ScWTrOyz7oGqISYyGk1mfF6aZ0ANQwLASpT94zfZFbKgJFYdgdbMWkGTcRsl',
])->setRedirectUrls($urls)
    ->setPayer($payer)
    ->setTransaction($trans);
// print_r($payment);
try {
    $payment->create(); //create payment
    header("Location: " . $payment->getApprovedUrl()); //checkout url
} catch (\Exception $ex) {
    print $ex;
    exit;
}
