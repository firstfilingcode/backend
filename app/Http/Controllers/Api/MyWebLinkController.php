<?php

namespace App\Http\Controllers\Api;   

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\CustomerVideoLink;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use File;
use URL;
use Image;
use Carbon;

   
class MyWebLinkController extends BaseController
{

	public function addMyWebLink(Request $request){
		try{
			$this->validate($request, [
	        	'link' => 'required',
	        	'title' => 'required',
	        	'customer_id' => 'required|exists:customers,id',
		    ]);

			$input['status'] = 0;
		 	$input = $request->all();
		 	$data = CustomerVideoLink::create($input);
		 	return $this->sendResponse('', 'Link Added Successfully');
		}catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}

	} 

	public function myWebLinkList(Request $request){

		try{

			$this->validate($request, [
	        	'customer_id' => 'required|exists:customers,id',
		    ]);
			$myWebLinks = CustomerVideoLink::where('customer_id',$request->customer_id)->where('status',1)->get();
			if(count($myWebLinks) >= 1){
				foreach($myWebLinks as $myWebLink){
					$mylinks[] = array(
						'id' => $myWebLink->id,
						'title' => $myWebLink->title,
						'link' => $myWebLink->link,

					);
				}
				return $this->sendResponseData($mylinks, 'Success');
			}
			else{

			}
			return $this->sendResponse('', 'No Record Found');
		}catch (Exception $e) {
			return $this->sendError('Validation Error.', 'Error');            
		}


	}





}

