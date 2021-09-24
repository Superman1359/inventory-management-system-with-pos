<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCustomerRequest;
use App\Models\Customer;
use Image;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected function uploadEmployeeImage($request){
        $customerImage = $request->file('photo');
        $imageType = $customerImage->getClientOriginalExtension();
        $imageName = rand(100,100000).$request->name.'.'.$imageType;
        $directory = 'inventory/customer-images/';
        $imageUrl = $directory.$imageName;
        Image::make($customerImage)->save($imageUrl);
        return $imageUrl;

    }

    public function saveCustomer(SaveCustomerRequest $request){
        $customer = new Customer();
        $customer-> name = $request-> name;
        $customer-> email = $request-> email;
        $customer-> phone = $request-> phone;
        $customer-> address = $request-> address;
        $customer-> city = $request-> city;
        $customer-> shop_name = $request-> shop_name;
        $customer-> bank_name = $request-> bank_name;
        $customer-> bank_branch = $request-> bank_branch;
        $customer-> account_holder = $request-> account_holder;
        $customer-> account_number = $request-> account_number;
        $customer-> photo = $request-> photo;
        $customer->save();
        return response()->json([
            "message"=>"Customer added successfully!",
            200,
        ]);

    }
}
