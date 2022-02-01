<?php

namespace CrossPay\Contracts;

/**
 *
 * Interface iCrossPay
 *
 * @package CrossPay\Contracts
 *
 */
interface iCrossPay
{

    /**
     *
     * INIT
     *
     * @param STRING $key
     * @param STRING $secret
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function __construct($key = null, $secrect = null, $version = 'v2');
    /**
     *
     * SET VERSION
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function setVersion($version);
    /**
     *
     * SET KEY
     *
     * @param STRING $key
     *
     * @return OBJECT
     *
     */
    public function setKey($key);
    /**
     *
     * SET SECRET
     *
     * @param STRING $secret
     *
     * @return OBJECT
     *
     */
    public function setSecret($secret);
    /**
     *
     * PAY IN
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function payIn($data);
    /**
     *
     * EXCHANGE PAY IN
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function exchangePayIn($data);
    /**
     *
     * UPDATE ORDER
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function updateOrder($data);
    /**
     *
     * CARD TOKEN
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function cardToken($data);
    /**
     *
     * CREATE PAYOUT
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function createPayout($data);
    /**
     *
     * EXCHAGE PAYOUT
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function exchangePayout($data);
    /**
     *
     * ORDER STATUS
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function orderStatus($data);
    /**
     *
     * HISTORY TRANSACTIONS
     *
     * @return OBJECT
     *
     */
    public function historyTransactions($data = []);
    /**
     *
     * REPORT CREATE
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function reportCreate($data);
    /**
     *
     * REPORT GET
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function reportGet($data);
    /**
     *
     * REPORT STATUS
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function reportStatus($data);
    /**
     *
     * BALANCES
     *
     * @return OBJECT
     *
     */
    public function balances();
    /**
     *
     * EXCHANGE RATES
     *
     * @return OBJECT
     *
     */
    public function exchangeRates();

}
