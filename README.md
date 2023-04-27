# <img src="https://dashboard.switchappgo.com/switchapp-logo.svg"> 

# Laravel Package

This is a laravel library package for SwitchApp Api payment engine.

# To get Started 

 
```
run composer require nicholasmt/switchappgo-library

```

Note: if You encounter this error which means you are using "nette/schema/v1.2.2" which requires php version of ">=7.1 <8.2".

```console

Your requirements could not be resolved to an installable set of packages.
- nette/schema v1.2.2 requires php >=7.1 <8.2 -> your php version (8.2.4) does not satisfy that requirement.

```

To Solve simply go the roof folder of your project and open "composer.lock" file

Search for "name": "nette/schema" and go under "require" and update the php version to " >=7.1 " and save as below

```json

 "require": {
                "nette/utils": "^2.5.7 || ^3.1.5 ||  ^4.0",
                "php": ">=7.1"
            },
            
```

Then run composer again.

```
composer require nicholasmt/zoom_library

```

Configuire .env file as below:

```env
SWITCHAPP_SECRET_KEY = "your switchapp secret key"

```

Create a Controller

```
php artisan make:controller SwitchAppController

```

Require Package using:

```php
use Nicholasmt\Switchappgo\Switchappgo;

```

Initialize a transaction use the code below in Method:

```php
      
     $switchappgo = new Switchappgo();
     $txt_ref = substr(rand(0,time()),0,5);
     $data_array = array(
        'tx_ref'      =>  $txt_ref,/*random number*/
        'description' => 'This is a test payment',
        'title'       => 'My First Transaction Using SwitchApp',
        'amount'      => 1000,
        'country'     => 'NG',
        'currency'    => 'NGN',
        'customer'    => array(
        'full_name'=> 'Mba Tochukwu',
        'email'=> 'test@gmail.com',
        'phone_number'=>'1234567',
        'address'=>'Enugu',
        ),
    );
    
    $call_api = $switchappgo->SwitchappAPI('POST', 'https://api.switchappgo.com/v1/transactions/server-initialize/', json_encode($data_array));
    $response = json_decode($call_api, true);

    if($response['status'] == 'success')
    {
        //call for verify transction
        $verify_transaction = $switchappgo->SwitchappAPI('GET', 'https://api.switchappgo.com/v1/transactions/verify/'.$txt_ref, false);
        $verify_response = json_decode($verify_transaction, true);

        if($verify_response['status'] == 'success')
        {
            // transaction verified 
            // code here

        }
        else
        {
            //transaction not verified 
            // code here

        }

    }
    else
    {
       //transaction error
       //Code here 

   }
           
```

Then Finally Setup Route

```php
Route::get('switchapp', [App\Http\Controllers\SwitchAppController::class, 'switchappgo'])->name('switchappgo');

```

What the Controller will look like:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nicholasmt\Switchappgo\Switchappgo;

class SwitchAppController extends Controller
{
    
    public function switchappgo()
    {
            $txt_ref = substr(rand(0,time()),0,5);
            $data_array = array(
                'tx_ref'      =>  $txt_ref, /*random number*/
                'description' => 'This is a test payment',
                'title'       => 'My First Transaction Using SwitchApp',
                'amount'      => 1000,
                'country'     => 'NG',
                'currency'    => 'NGN',
                'customer'    => array(
                                    'full_name'=> 'Mba Tochukwu',
                                    'email'=> 'test@gmail.com',
                                    'phone_number'=>'1234567',
                                    'address'=>'Enugu',
                                    ),
            );

            $switchappgo = new Switchappgo();

            $call_api = $switchappgo->SwitchappAPI('POST', 'https://api.switchappgo.com/v1/transactions/server-initialize/', json_encode($data_array));
            $response = json_decode($call_api, true);

            if($response['status'] == 'success')
            {
                //call for verify transction
                $verify_transaction = $switchappgo->SwitchappAPI('GET', 'https://api.switchappgo.com/v1/transactions/verify/'.$txt_ref, false);
                $verify_response = json_decode($verify_transaction, true);

                if($verify_response['status'] == 'success')
                {
                    // transaction verified 
                    // code here
                 }
                else
                {
                    //transaction not verified 
                    // code here
                   
                }

            }
            else
            {
               //transaction error
               //Code here 
              
           }
    }

}

```
 
Don't forget to like.


