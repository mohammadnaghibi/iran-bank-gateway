This package is made by [larabook.ir](http://larabook.ir/اتصال-درگاه-بانک-لاراول/) - [github](https://github.com/larabook/gateway) and I have added to it several functions, including the refund request for Mellat Bank. 

by this  package we are able to connect to all Iranian bank with one unique API.

( This Package is now compatible with both **4.\* and 5.\* versions of Laravel** ).

Available Banks:
 1. MELLAT
 2. SADAD (MELLI)
 3. SAMAN
 4. PARSIAN
 5. PASARGAD
 6. ZARINPAL
 7. PAYPAL (**New**)
 8. ASAN PARDAKHT (**New**)
 9. PAY.IR (**New**) (to use : new \Payir())
----------


**Installation**:

Run below statements on your terminal :

STEP 1 : 

    composer require mohammadnaghibi/iran-bank-gateway:dev-master
    
STEP 2 : Add `provider` and `facade` in config/app.php

    'providers' => [
      ...
      mohammadnaghibi\Gateway\GatewayServiceProvider::class, // <-- add this line at the end of provider array
    ],


    'aliases' => [
      ...
      'Gateway' => mohammadnaghibi\Gateway\Gateway::class, // <-- add this line at the end of aliases array
    ]

Step 3:  

    php artisan vendor:publish --provider=mohammadnaghibi\Gateway\GatewayServiceProvider

Step 4: 

    php artisan migrate


Configuration file is placed in config/gateway.php , open it and enter your banks credential:

You can make connection to bank by several way (Facade , Service container):

    try {
       
       $gateway = \Gateway::make(new \Mellat());

       // $gateway->setCallback(url('/path/to/callback/route')); You can also change the callback
       $gateway
            ->price(1000)
            // setShipmentPrice(10) // optional - just for paypal
            // setProductName("My Product") // optional - just for paypal
            ->ready();

       $refId =  $gateway->refId(); // شماره ارجاع بانک
       $transID = $gateway->transactionId(); // شماره تراکنش

      // در اینجا
      //  شماره تراکنش  بانک را با توجه به نوع ساختار دیتابیس تان 
      //  در جداول مورد نیاز و بسته به نیاز سیستم تان
      // ذخیره کنید .
      
       return $gateway->redirect();
       
    } catch (\Exception $e) {
       
       	echo $e->getMessage();
    }

you can call the gateway by these ways :
 1. Gateway::make(new Mellat());
 1. Gateway::mellat()
 2. app('gateway')->make(new Mellat());
 3. app('gateway')->mellat();

Instead of MELLAT you can enter other banks Name as we introduced above .

In `price` method you should enter the price in IRR (RIAL) 

and in your callback :

    try { 
       
       $gateway = \Gateway::verify();
       $trackingCode = $gateway->trackingCode();
       $refId = $gateway->refId();
       $cardNumber = $gateway->cardNumber();
       
        // تراکنش با موفقیت سمت بانک تایید گردید
        // در این مرحله عملیات خرید کاربر را تکمیل میکنیم
    
    } catch (\mohammadnaghibi\Gateway\Exceptions\RetryException $e) {
    
        // تراکنش قبلا سمت بانک تاییده شده است و
        // کاربر احتمالا صفحه را مجددا رفرش کرده است
        // لذا تنها فاکتور خرید قبل را مجدد به کاربر نمایش میدهیم
        
        echo $e->getMessage() . "<br>";
        
    } catch (\Exception $e) {
       
        // نمایش خطای بانک
        echo $e->getMessage();
    }  

If you are intrested to developing this package you can help us by these ways :

 1. Improving documents.
 2. Reporting issue or bugs.
 3. Collaboration in writing codes and other banks modules.

This package is extended from PoolPort  but we've changed some functionality and improved it .
