# Orange Money Sdk 

[![Latest Version](https://img.shields.io/github/release/thephpleague/orange-money-sdk.svg?style=flat-square)](https://github.com/thephpleague/orange-money-sdk/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/thephpleague/orange-money-sdk/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/orange-money-sdk)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/thephpleague/orange-money-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/orange-money-sdk/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/thephpleague/orange-money-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/orange-money-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/league/orange-money-sdk.svg?style=flat-square)](https://packagist.org/packages/league/orange-money-sdk)

**Note:**  `orange-money-sdk`.

This is a php sdk for orange operator mobile money api. 

## Install

Via Composer

``` bash
$ composer require foris-master/orange-money-sdk
```

## Confing

```
Set AUTH_HEADER, MERCHANT_KEY,RETURN_URL,CANCEL_URL,NOTIF_URL enviroment variable ( .env file if using dotenv),
you get all related to you console at https://developer.orange.com/
 ```
## Usage

``` php
use Foris\OmSdk\OmSdk;

$om = new OmSdk();
// QuickStart
/**
 * You need to set AUTH_HEADER, MERCHANT_KEY,RETURN_URL,CANCEL_URL,NOTIF_URL
 * enviroment variable ( .env file if using dotenv)
 */
$om->webPayment(['amount'=>100]);
// Full Options
$opt=[
        "merchant_key"=> '********',
        "currency"=> "OUV",
        "order_id"=> $id,
        "amount"=> 0,
        "return_url"=> 'http://www.you-site.com/callback/return',
        "cancel_url"=> 'http://www.you-site.com/callback/cancel',
        "notif_url"=>'http://www.you-site.com/callback/notif',
        "lang"=> "fr"
    ];
$om->webPayment($opt);
```

## API

### Get token

``` php
use Foris\OmSdk\OmSdk;

$om = new OmSdk();

$rep= $om->getToken();
var_dump($rep);
// var_dump result
[
        "token_type"=> 'Bearer',
        "access_token"=> "0213GH123l12kj312k",
        "expires_in"=> "7776000",
];

```
### Web Payment

``` php
use Foris\OmSdk\OmSdk;

$om = new OmSdk();
$opt = [
               "merchant_key"=> '********',
               "currency"=> "OUV",
               "order_id"=> $id,
               "amount"=> 0,
               "return_url"=> 'http://www.you-site.com/callback/return',
               "cancel_url"=> 'http://www.you-site.com/callback/cancel',
               "notif_url"=>'http://www.you-site.com/callback/notif',
               "lang"=> "fr"
           ];
$rep= $om->webPayment($opt);
var_dump($rep);
// var_dump result
[
        "status"=> 201,
        "message"=> "OK",
        "pay_token"=> "87a9f2f8ebca97sdfdsbb49795f77981f5be1face7b6a543c8a1304d81e4299fd",
        "payment_url"=>"https://webpayment-sb.orange-money.com/payment/pay_token/87a9f2f8ebca97sdfdsbb49795f77981f5be1face7b6a543c8a1304d81e4299fd"
        "notif_token"=> "793d6157d9c7d52ae3920dc596956206"
];
```

#### Note
webPayment method automatically call getToken and set it in request header.

### Transaction Status

``` php
use Foris\OmSdk\OmSdk;

$om = new OmSdk();

$rep= $om->checkTransactionStatus($orderId,$amount,$pay_token);
var_dump($rep);
// var_dump result
[
         "status" => "SUCCESS",
         "order_id" => "MY_ORDER_ID_08082105_0023457",
         "txnid" => "MP150709.1341.A00073"
];
```
#### Note
The status could take one of the following values: INITIATED; PENDING; EXPIRED; SUCCESS; FAILED
- INITIATED waiting for user entry
- PENDING user has clicked on “Confirmer”, transaction is in progress on Orange side
- EXPIRED user has clicked on “Confirmer” too late (after token’s validity)
- SUCCESS payment is done
- FAILED payment has failed

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/thephpleague/:package_name/blob/master/CONTRIBUTING.md) for details.

## Credits

- [foris-master](https://github.com/foris-master)
- [All Contributors](https://github.com/thephpleague/:package_name/contributors)
- [Orange dev team](https://developer.orange.com/apis/om-webpay/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
