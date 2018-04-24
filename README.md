# Orange Money Sdk 

[![Latest Version](https://img.shields.io/github/release/thephpleague/orange-money-sdk.svg?style=flat-square)](https://github.com/thephpleague/orange-money-sdk/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/thephpleague/orange-money-sdk/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/orange-money-sdk)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/thephpleague/orange-money-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/orange-money-sdk/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/thephpleague/orange-money-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/orange-money-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/league/orange-money-sdk.svg?style=flat-square)](https://packagist.org/packages/league/orange-money-sdk)

**Note:** Replace `orange-money-sdk` with the correct package name in the above URLs, then delete this line.

This is a php sdk for orange operator mobile money api. 

## Install

Via Composer

``` bash
$ composer require foris-mater/orange-money-sdk
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
echo $orange-money-sdk->echoPhrase('Hello, League!');
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/thephpleague/:package_name/blob/master/CONTRIBUTING.md) for details.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](https://github.com/thephpleague/:package_name/contributors)
- [Orange dev team](https://developer.orange.com/apis/om-webpay/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
