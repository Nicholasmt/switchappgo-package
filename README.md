# <img src="https://dashboard.switchappgo.com/switchapp-logo.svg"> 

# Laravel Package

This is a laravel library package for SwitchApp Api payment engine.

# To get Started 

 
```
run composer require nicholasmt/switchappgo-library

```

Configuire .env file as below:

```
SWITCHAPP_SECRET_KEY = "your switchapp secret key"

```

Create a Controller

```
php artisan make:controller SwitchAppController

```

Require Package using:

```
use Nicholasmt\Switchappgo\Switchappgo;

```

Initialize a transaction use the code below in Method:

```
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

```
Route::get('switchapp', [App\Http\Controllers\SwitchAppController::class, 'switchappgo'])->name('switchappgo');

```

What you Controller will look like:

```
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


