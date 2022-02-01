<?php

namespace CrossPay\Contracts;

/**
 *
 * Interface iData
 *
 * @package CrossPay\Contracts
 *
 */
interface iData
{

    /**
     *
     * INIT
     *
     * @param STRING $raw
     *
     * @return OBJECT
     *
     */
    public function __construct($raw);
    /**
     *
     * GET RAW
     *
     * @return STRING | ARRAY
     *
     */
    public function getRaw();
    /**
     *
     * GET DATA
     *
     * @return ARRAY
     *
     */
    public function getData();

}
