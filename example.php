<?php

require_once 'vendor/autoload.php';

use CrossPay\CrossPay;
use CrossPay\Exceptions\CrossPayFieldsException;
use CrossPay\Exceptions\CrossPayResponseException;
use CrossPay\Exceptions\CrossPaySignatureException;

try {

    $crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

    print_r(

        $crosspay->balances()->getData()

    );

} catch (CrossPayFieldsException $exception) {

    print_r($exception->getResponse());

} catch (CrossPayResponseException $exception) {

    print($exception->getResponse());

} catch (CrossPaySignatureException $exception) {

    print_r($exception->getResponse());

}
