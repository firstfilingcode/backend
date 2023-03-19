<?php
namespace App\Http\Controllers\Api; 

use App\Helpers\helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

use App\Models\OrderDetail;
use App\Models\Services;
use App\Models\Wallet;
use App\Models\WalletSetting;
use App\Models\WalletDetail;
use App\Models\ServiceDetail;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon\Carbon;
use Response;

   
class OrderController extends BaseController
{

	public function orderFilter(Request $request)   {
	    $dateS = Carbon::now()->startOfMonth()->subMonth($request->date);
        $dateE = Carbon::now()->startOfMonth(); 
	   try {			
            $order_detail = OrderDetail::select('order_details.*','service.name')
        ->leftjoin('services as service','service.id','order_details.service_id')->where('order_details.user_id',$request->id);
        
        if($request->date!=""){        
           $order_detail = $order_detail->whereBetween('order_details.date', [$dateS, $dateE]);
        }
        if($request->searchForOrder!="" ){     
           
          $order_detail = $order_detail->where('order_details.order_no',$request->searchForOrder);
        }
         if($request->payment_status!="" ){     
           
           $order_detail = $order_detail->where('order_details.payment_status',$request->payment_status);
        }
        
          $order_detail = $order_detail->orderBy('order_details.id','DESC')->get();
        
			$data  = array();
				foreach ($order_detail  as $item) {
					$data[] = array(
					'id' => $item->id,
					'name' => $item->name,
					'user_id' => $item->user_id,
					'service_id' => $item->service_id,
					'order_no' => $item->order_no,
					'payment_status' => $item->payment_status,
					'created_at' =>date('d-M', strtotime($item['created_at'])),
					
					);
			}
	         
            return  response()->json(['status'=>true,'message'=>'Order Data','data'=>$data],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
    			
			}
			
			public function orderPaymentStatus(Request $request){
			          $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // generate a pin based on 2 * 7 digits + a random character
                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
                
                // shuffle the result
                $string = str_shuffle($pin);
                
			  //  $status_id = explode(',', $request->id);
		

			    for($i=0; $i<count($request->id); $i++)
			    {
			        
    				    
    				
			        $data = OrderDetail::where('id',$request->id[$i])->update(['payment_status'=>1,'transaction_no'=>$request->transaction_no,'payment_mode'=>$request->payment_mode]);
			        
	
			    }
			    
			    
			 //   $email_data = OrderDetail::whereIn('id',$request->id)->sum('total_amount');
			
			    
    //                      $emailData = ['email'=>$request->email, 'subject' => 'Order Purchased of Rs : '.$email_data ]; 
    //                   $data = sendMail('admin.emails.order_purchased',$emailData);
                      
                  $serviceDetail = ServiceDetail::where('id',$request->service_id)->first();
                 	if(!empty($request->referral_id))
    				{
    				    
    				     $data3 = OrderDetail::where('id',$request->id[0])->first(['service_id','referral_id']);
    					
    						$data_ids = array();
			
					$data_ids[] = $request->user_id;
			      	$data_ids[] =  $data3->referral_id;
					
			
    			$wallet_data = Wallet::where('user_id',$request->user_id)->first();	
    			//$wallet_setting = WalletSetting::first();	
    			$wallet_setting = WalletSetting::where('amount_range_from', '<=', $serviceDetail->price)->where('amount_range_to', '>=',$serviceDetail->price)->first();
    			
    			
    				if(!empty($wallet_data))
    				{
    				    $wallet=Wallet::where('user_id',$request->user_id)->increment('amount', ($serviceDetail->price*$wallet_setting->refer_to_amount)/100);
    				       
           for($i=0; $i<count($data_ids); $i++)
            {
                 $wallet_details = new WalletDetail;
		     
		     $wallet_details->user_id = $data_ids[$i];
		     if($i == 0)
		     {
		         $wallet_details->wallet_id = $wallet_data->id;
		        $wallet_details->amount = ($serviceDetail->price*$wallet_setting->refer_to_amount)/100;  
		        $wallet_details->user_id_form = $data3->referral_id;  
		     }
		     else if($i == 1)
		     
		     {
		         
		         $refer_wallet=Wallet::where('user_id',$data_ids[$i])->first();	
		         
		         	if(!empty($refer_wallet))
    				{
    				    
    				    $wallet2=Wallet::where('user_id',$data_ids[$i])->increment('amount', ($serviceDetail->price*$wallet_setting->refer_form_amount)/100);
    				      $wallet_details->wallet_id = $refer_wallet->id;
    				}
    				else
    				{
    				    $wallet2 = new Wallet;
		     $wallet2->user_id = $data_ids[$i];
		     $wallet2->amount = ($serviceDetail->price*$wallet_setting->refer_form_amount)/100;
		       $wallet2->save();
		        $wallet_details->wallet_id = $wallet2->id;
		        $wallet_details->user_id_to = $request->user_id;  
    				    
    				}
		         
		         
		          $wallet_details->amount = ($serviceDetail->price*$wallet_setting->refer_form_amount)/100;
		     }
		  //   $wallet_details->user_id_form = $request->referral_id;
		  //   $wallet_details->user_id_to = $user->id;
		     $wallet_details->service_id = $data3->service_id;
		     $wallet_details->transaction_no = $string;
		    
		     $wallet_details->status = 1;
		       $wallet_details->save();
                
            }
    				       
    				   
    				
    				  
    				}else{
    				  
    				       $wallet = new Wallet;
		     $wallet->user_id = $request->user_id;
		     $wallet->amount = ($serviceDetail->price*$wallet_setting->refer_to_amount)/100;
		       $wallet->save();
    			
    		  for($i=0; $i<count($data_ids); $i++)
            {
                 $wallet_details = new WalletDetail;
		   
		     $wallet_details->user_id = $data_ids[$i];
		     if($i == 0)
		     {
		           $wallet_details->wallet_id = $wallet->id;
		        $wallet_details->amount = ($serviceDetail->price*$wallet_setting->refer_to_amount)/100;  
		        $wallet_details->user_id_form = $data3->referral_id;  
		     }
		     else if($i == 1)
		     
		     {
		         if(!empty($refer_wallet))
    				{
    				    $wallet2=Wallet::where('user_id',$data_ids[$i])->increment('amount', ($serviceDetail->price*$wallet_setting->refer_to_amount)/100);
    				    $wallet_details->wallet_id = $refer_wallet->id;
    				}
    				else
    				{
    				    $wallet2 = new Wallet;
		     $wallet2->user_id = $data_ids[$i];
		     $wallet2->amount = ($serviceDetail->price*$wallet_setting->refer_form_amount)/100;
		       $wallet2->save();
		         $wallet_details->wallet_id = $wallet2->id;
		          $wallet_details->user_id_to = $request->user_id;  
    				    
    				}
		         
		          $wallet_details->amount = ($serviceDetail->price*$wallet_setting->refer_form_amount)/100;
		     }
		  //   $wallet_details->user_id_form = $request->referral_id;
		  //   $wallet_details->user_id_to = $user->id;
		     $wallet_details->service_id = $data3->service_id;
		     $wallet_details->transaction_no = $string;
		    
		     $wallet_details->status = 1;
		       $wallet_details->save();
                
            }
    				     
    				    
    				}
    				}     
                      
                       	if($request->applyWallet == true)
    				{
    				     $walletamt2=Wallet::where('user_id',$request->user_id)->first();
    				    
    				       for($i=0; $i<count($request->id); $i++)
			    {
			        
			         $walletamt=Wallet::where('user_id',$request->user_id)->first();
    				     if(!empty($walletamt))
    				     {
    				         
    				         $serviceAmount = OrderDetail:: where('id',$request->id[$i])->first();
    				         if($walletamt->amount >= count($request->id)*($walletamt2->amount*20)/100)
    				         {
    				              $updateWalletAmount = OrderDetail::where('id',$request->id[$i])->update(['wallet_amount'=>($walletamt2->amount*20)/100]);
    				               $wallet=Wallet::where('user_id',$request->user_id)->decrement('amount', ($walletamt2->amount*20)/100);
    				                 $wallet_details = new WalletDetail;
		      
		                       $wallet_details->user_id = $request->user_id ;
		 
		                           $wallet_details->wallet_id = $walletamt->id;
		             $wallet_details->amount = ($walletamt2->amount*20)/100;
		              $wallet_details->transaction_no = $string;
		                 $wallet_details->save();
		                 
    				         }
    				         else
    				         {
    				             $updateWalletAmount = OrderDetail::where('id',$request->id[$i])->update(['wallet_amount'=>($walletamt2->amount)/count($request->id)]);
    				               $wallet=Wallet::where('user_id',$request->user_id)->decrement('amount', ($walletamt2->amount)/count($request->id));
    				                 $wallet_details = new WalletDetail;
		      
		                       $wallet_details->user_id = $request->user_id ;
		 
		                           $wallet_details->wallet_id = $walletamt->id;
		             $wallet_details->amount = ($walletamt2->amount)/count($request->id);
		              $wallet_details->transaction_no = $string;
		                 $wallet_details->save();
    				             
    				         }
    				         
    				    //      else{
    				    //           $updateWalletAmount = OrderDetail::where('id',$request->id[$i])->update(['wallet_amount'=>$walletamt->amount]);
    				    //           $wallet=Wallet::where('user_id',$request->user_id)->decrement('amount', $walletamt->amount);
    				               
    				    //           if($walletamt->amount > 0)
    				    //           {
    				    //              $wallet_details = new WalletDetail;
		      
		          //             $wallet_details->user_id = $request->user_id ;
		 
		          //                 $wallet_details->wallet_id = $walletamt->id;
		          //   $wallet_details->amount = $walletamt->amount;  
		          //   $wallet_details->transaction_no = $string;  
		          //       $wallet_details->save();
    				    //      }
    				    //      }
    				       } }	}
    				return  response()->json(['status'=>true,'message'=>'Payment Done'],200 );
          
        }               
			public function orderDetail(Request $request){
			          
         try {			
            $data = OrderDetail::where('id',$request->order_id)->first();

            return  response()->json(['status'=>true,'message'=>'Ordered Fetched Successfully','data'=>$data],200 );       
		} catch (Exception $e) {
			return $this->sendError('Data Empty.', 'Error');            
		}
			 
  
        }               
			
}
