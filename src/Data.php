<?php

namespace CrossPay;

use CrossPay\Contracts\iData;

/**
 *
 * Class Data
 *
 * @package CrossPay
 *
 */
class Data implements iData
{

    /**
     *
     * RAW
     *
     * @param STRING
     *
     */
    private $raw = null;
    /**
     *
     * INIT
     *
     * @param STRING $raw
     *
     * @return OBJECT
     *
     */
    public function __construct($raw)
    {

        $this->raw = $raw;

    }
    /**
     *
     * GET RAW
     *
     * @return STRING | ARRAY
     *
     */
    public function getRaw()
    {

        return $this->raw;

    }
    /**
     *
     * GET DATA
     *
     * @return ARRAY
     *
     */
    public function getData(): array
    {

        if ($this->raw) {

            return json_decode(

                $this->raw, true

            );

        }

    }

}
