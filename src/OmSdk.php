<?php
/**
 * Created by PhpStorm.
 * User: evari
 * Date: 4/24/2018
 * Time: 10:59 AM
 */

namespace Foris\OmSdk;


class OmSdk
{

    private $api;
    /**
     * @var string or null
     */
    private  $token;

    public function __construct(array $config = [])
    {
       $this->api = new Api();
    }

    public function getAccesToken(){

        $rep = $this->api->getToken();
//        $data= $rep->getBody()->getContents();
        $data= json_decode((string)$rep->getBody(),true);
//        setcookie('access_token',$data["access_token"],time()+$data["expires_in"]);
        $this->token=$data["access_token"];
       return $data;

    }

    public function webPayment($data){


        $dt= $this->getAccesToken();
        $rep = $this->api->Payment($this->token,$data);
//        $data= $rep->getBody()->getContents();
        if (is_object($rep)) {
            $data = json_decode((string)$rep->getBody(), true);
            return $data;
        } elseif (is_string($rep)) {
            return $rep;
        } else {
            return $rep;
        }
    }

    public function checkTransactionStatus($orderId, $amount, $pay_token)
    {

        $data = [
            "order_id" => $orderId,
            "amount" => $amount,
            "pay_token" => $pay_token
        ];
        $dt = $this->getAccesToken();
        $rep = $this->api->checkTransactionStatus($this->token, $data);
//        $data= $rep->getBody()->getContents();
        if (is_object($rep)) {
            $data = json_decode((string)$rep->getBody(), true);
            return $data;
        } elseif (is_string($rep)) {
            return $rep;
        } else {
            return $rep;
        }
    }


}