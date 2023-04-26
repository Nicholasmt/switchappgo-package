<?php

namespace Nicholasmt\Switchappgo\Controllers;

use Illuminate\Http\Request;

use Nicholasmt\Switchappgo\Switchappgo;

class SwitchappgoController 
{
 
    public function switchappgo()
        {
            
            $data_array = array(
                'tx_ref'=>12345,/*random number*/
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

            $call_api = Switchappgo::SwitchappAPI('POST', 'https://api.switchappgo.com/v1/transactions/server-initialize/', json_encode($data_array));
            $response = json_decode($call_api, true);

            if($response['status'] == 'success')
            {
                //call for verify transction
                $verify_transaction = Switchappgo::callAPI('GET', 'https://api.switchappgo.com/v1/transactions/verify/'.$txt_ref, false);
                $verify_response = json_decode($verify_transaction, true);

                if($verify_response['status'] == 'success')
                {
                    // transaction verified 
                    // code here
                   dd($verify_response);
                   return  $verify_response['message'];
                }
                else
                {
                    //transaction not verified 
                    // code here
                   return $verify_response['message'];
                }

            }
            else
            {
               //transaction error
               //Code here 
               return  $response['message'];
           }
    }


}
