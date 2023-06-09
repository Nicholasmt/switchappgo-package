# <img src="https://dashboard.switchappgo.com/switchapp-logo.svg"> 

# Laravel Package

This is a laravel library package for SwitchApp Api payment engine.

# To get Started Run 

 
```
composer require nicholasmt/switchappgo-library

```

Note: if You encounter this or any other error which means you are using the old version of that package

```console

Your requirements could not be resolved to an installable set of packages.

```

To Resolve simply run
 
```

 composer update
 
 ```

After successfull composer update then install the package again with 
``` composer require nicholasmt/zoom_library ```

Note: if you encounter any error based on poor network on updating composer, 

just backup the vender file, delete and run composer update again with 
``` composer update ```
 

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

To verify transaction using the API callback use the code below

```php
     
        $tx_ref = $request->query('tx_ref');
        $switchapp = new Switchappgo();
        $transaction_response = $switchapp->SwitchappAPI('GET', 'https://api.switchappgo.com/v1/transactions/verify/'.$tx_ref, false);
        $response = json_decode($transaction_response);
       
        if($response->status == 'success')
        {
             //code here
              
         }
        else
        {
           //code here
        }
           
```

Then Finally Setup callback Route

```php
Route::get('switchapp', [App\Http\Controllers\SwitchAppController::class, 'switchappCallback'])->name('switchappgo');

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
    
    public function switchappCallback(Request $request)
    {
    
        $tx_ref = $request->query('tx_ref');
        $switchapp = new Switchappgo();
        $transaction_response = $switchapp->SwitchappAPI('GET', 'https://api.switchappgo.com/v1/transactions/verify/'.$tx_ref, false);
         $response = json_decode($transaction_response);
        
        if($response->status == 'success')
        {
             //code here
             
         }
        else
        {
          //code here
        }
    }

}

```
 
Don't forget to like.


