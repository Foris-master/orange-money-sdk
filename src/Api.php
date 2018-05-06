<?php
/**
 * Created by PhpStorm.
 * User: Evaris
 * Date: 15/06/2016
 * Time: 01:25
 */

namespace Foris\OmSdk;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;


/**
 * PHP Orange Money Sdk Client
 *
 * @author Fomekong Evaris @foris-master
 * GitHub: https://github.com/Foris-master/orange-money-sdk
 */
class Api
{
    /**
     * Orange Money  API Base url
     */
    const BASE_URL = "https://api.orange.com/";
    /**
     * The Query to run against the FileSystem
     * @var Client;
     */
    private $client ;
    /**
     * @var string or null
     */
    private  $auth_header;
    /**
     * @var string or null
     */
    private  $credentials;
    /**
     * @var string or null
     */
    private  $merchant_key;

     /**
     * @var string or null
     */
    private  $return_url;
     /**
     * @var string or null
     */
    private  $cancel_url;
     /**
     * @var string or null
     */
    private  $notif_url;
    /**
     * Constructor
     * @param string $userid
     * @param string $password
     */
    public function __construct() {
        // Credentials: <Base64 value of UTF-8 encoded “username:password”>
        $this->client = new Client([
            'base_uri' => self::BASE_URL
        ]);
        $this->auth_header= getenv("AUTH_HEADER");
        $this->merchant_key= getenv("MERCHANT_KEY");
        $this->return_url= getenv("RETURN_URL");
        $this->cancel_url= getenv("CANCEL_URL");
        $this->notif_url= getenv("NOTIF_URL");

    }

    /**
     * Create API query and execute a GET/POST request
     * @param string $httpMethod GET/POST
     * @param string $endpoint
     * @param string $options
     */
    private function apiCall($httpMethod, $endpoint, $options) {
        // POST method or GET method
        try{
//            $api_url = self::BASE_URL.$endpoint;
            if(strtolower($httpMethod) === "post") {

                /** @var Response $response */
                $response = $this->client->request('post',$endpoint,$options);

            } else {
                $response = $this->client->get($endpoint);

            }
            /** @var $response Response */
//            $response = $request->send();

            /** @var $body EntityBody */
//            $body = $response->getBody();

            return  $response;
        }catch (Exception $exception){
            return  $exception->getMessage();
        };

    }
    /**
     * Call GET request
     * @param string $endpoint
     * @param string $options
     */
    private function get($endpoint, $options = null) {
        return $this->apiCall("get", $endpoint, $options);
    }
    /**
     * Call POST request
     * @param string $endpoint
     * @param string $options
     */
    private function post($endpoint, $options = null) {
        return $this->apiCall("post", $endpoint, $options);
    }
    /**
     * Get Token
     */
    public function getToken()
    {

        $options = [
            'headers'=> [
                'Authorization' => 'Basic '.$this->auth_header,
                'Accept'=>'application/json'
            ],
            'form_params' => [
                 'grant_type'=>'client_credentials',
            ]
        ];

        return $this->post('oauth/v2/token',$options);
    }


    public function Payment($token,$body)
    {

        $id = "OCM_SDK_0".rand(100000,900000)."_00".rand(10000,90000);
        $b = [
            "merchant_key"=> $this->merchant_key,
            "currency"=> "OUV",
            "order_id"=> $id,
            "amount"=> 0,
            "return_url"=> $this->return_url,
            "cancel_url"=> $this->cancel_url,
            "notif_url"=> $this->notif_url,
            "lang"=> "fr"
        ];
        $b = array_merge($b,$body);
        $b = json_encode($b);

       /* var_dump($b);
        die();*/
        $options = [
            'headers'=> [
                'Authorization' => 'Bearer '.$token,
                'Accept'=>'application/json',
                'Content-Type'=>'application/json'
            ],
            'body' => $b
        ];

        return $this->post('orange-money-webpay/dev/v1/webpayment',$options);
    }

    public function checkTransactionStatus($token, $data)
    {

        $b = [
            "order_id" => $data["order_id"],
            "amount" => $data["amount"],
            "pay_token" => $data["pay_token"]
        ];

        $b = json_encode($b);

        /* var_dump($b);
         die();*/
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'body' => $b
        ];

        return $this->post('orange-money-webpay/dev/v1/transactionstatus', $options);
    }



}
