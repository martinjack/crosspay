<?php

namespace CrossPay;

use CrossPay\Contracts\iCrossPay;
use CrossPay\Data;
use CrossPay\Exceptions\CrossPayFieldsException;
use CrossPay\Exceptions\CrossPayResponseException;
use CrossPay\Exceptions\CrossPaySignatureException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 *
 * Class CrossPay
 *
 * @package CrossPay\CrossPay
 *
 */
class CrossPay implements iCrossPay
{

    /**
     *
     * API
     *
     * @var STRING
     *
     */
    private $api = 'https://api2.crosspay.net/api/';
    /**
     *
     * VERSION
     *
     * @var STRING
     *
     */
    private $version = 'v2';
    /**
     *
     * KEY
     *
     * @var STRING
     *
     */
    private $key = null;
    /**
     *
     * SECRET
     *
     * @var STRING
     *
     */
    private $secrect = null;
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
    public function __construct($key = null, $secrect = null, $version = 'v2')
    {

        $this->client = new Client();

        return $this
            ->setVersion($version)
            ->setKey($key)
            ->setSecret($secrect);

    }
    /**
     *
     * SET VERSION
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function setVersion($version): object
    {

        $this->version = $version;

        return $this;

    }
    /**
     *
     * SET KEY
     *
     * @param STRING $key
     *
     * @return OBJECT
     *
     */
    public function setKey($key): object
    {

        $this->key = $key;

        return $this;

    }
    /**
     *
     * SET SECRET
     *
     * @param STRING $secret
     *
     * @return OBJECT
     *
     */
    public function setSecret($secret): object
    {

        $this->secret = $secret;

        return $this;

    }
    /**
     *
     * SIGNATURE
     *
     * @param ARRAY
     *
     * @return STRING
     *
     * @throws CrossPayFieldsException
     *
     */
    private function signature($data)
    {

        if ($this->key && $this->secret) {

            $this->signature = hash_hmac(

                'sha256',

                $data,

                $this->secret

            );

            return $this->signature;

        }

        if (!$this->key) {

            $error = 'key';

        } else {

            $error = 'secret';

        }

        throw new CrossPayFieldsException(

            sprintf(

                'Fields errors. Check field: %s',

                $error

            )

        );

    }
    /**
     *
     * GET API
     *
     * @return STRING
     *
     */
    private function getApi(): string
    {

        return sprintf(

            '%s/%s/',

            $this->api,

            $this->version

        );

    }
    /**
     *
     * REQUEST
     *
     * @param STRING $method
     * @param ARRAY $data
     *
     * @return ARRAY
     *
     * @throws CrossPaySignatureException
     * @throws CrossPayException
     *
     */
    private function request($method, $data = [])
    {

        try {

            $data = json_encode($data);

            $this->signature($data);

            $response = $this->client->post(

                sprintf(

                    '%s%s',

                    $this->getApi(),

                    $method

                ),

                [

                    'headers' => [

                        'Authorization' => $this->key,
                        'Signature'     => $this->signature,

                    ],

                    'body'    => $data,

                ]

            );

            $responseSignature = $response->getHeaderLine('Signature');
            $response          = $response->getBody()->getContents();

            if ($responseSignature === $this->signature($response)) {

                return $response;

            } else {

                throw new CrossPaySignatureException(

                    'Warning! Invalid signature response data'

                );

            }

        } catch (RequestException $exception) {

            throw new CrossPayResponseException(

                $exception->getResponse()->getBody()->getContents()

            );

        }

    }
    /**
     *
     * PAY IN
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function payIn($data)
    {

        return new Data(

            $this->request(

                'order/payin', $data

            )

        );

    }
    /**
     *
     * EXCHANGE PAY IN
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function exchangePayIn($data)
    {

        return new Data(

            $this->request(

                'order/exchange_payin', $data

            )

        );

    }
    /**
     *
     * UPDATE ORDER
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function updateOrder($data)
    {

        return new Data(

            $this->request(

                'order/update', $data

            )

        );

    }
    /**
     *
     * CARD TOKEN
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function cardToken($data)
    {

        return new Data(

            $this->request(

                'order/cardtoken', $data

            )

        );

    }
    /**
     *
     * CREATE PAYOUT
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function createPayout($data)
    {

        return new Data(

            $this->request(

                'order/payout', $data

            )

        );

    }
    /**
     *
     * EXCHAGE PAYOUT
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function exchangePayout($data)
    {

        return new Data(

            $this->request(

                'order/exchange_payout', $data

            )

        );

    }
    /**
     *
     * ORDER STATUS
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     * @throws CrossPayFieldsException
     *
     */
    public function orderStatus($data)
    {

        if (isset($data['order_id']) || isset($data['order_uuid'])) {

            return new Data(

                $this->request(

                    'order/status', $data

                )

            );

        }

        throw new CrossPayFieldsException(

            sprintf(

                'Field error. Need fields: order_id or order_uuid'

            )

        );

    }
    /**
     *
     * HISTORY TRANSACTIONS
     *
     * @return OBJECT
     *
     */
    public function historyTransactions($data = [])
    {

        return new Data(

            $this->request(

                'transactions', $data

            )

        );

    }
    /**
     *
     * REPORT CREATE
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function reportCreate($data)
    {

        return new Data(

            $this->request(

                'reports/create', $data

            )

        );

    }
    /**
     *
     * REPORT GET
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function reportGet($data)
    {

        return new Data(

            $this->request(

                'reports/get', $data

            )

        );

    }
    /**
     *
     * REPORT STATUS
     *
     * @param ARRAY $data
     *
     * @return OBJECT
     *
     */
    public function reportStatus($data)
    {

        return new Data(

            $this->request(

                'reports/status', $data

            )

        );

    }
    /**
     *
     * BALANCES
     *
     * @return OBJECT
     *
     */
    public function balances(): object
    {

        return new Data(

            $this->request(

                'balances', []

            )

        );

    }
    /**
     *
     * EXCHANGE RATES
     *
     * @return OBJECT
     *
     */
    public function exchangeRates(): object
    {

        return new Data(

            $this->request(

                'exchange_rates', []

            )

        );

    }

}
