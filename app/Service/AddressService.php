<?php

namespace App\Service;
// namespace App\Http\Controllers;
use App\Model\Address;
use App\Model\TempProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressService
{
         public function insertAddress(Request $request){

                $address = new Address;
                $address->customer_id = $request->customer_id;
                $address->address_line_1 = $request->address_line_1;
                $address->address_line_2 = $request->address_line_2;
                $address->city = $request->city;
                $address->state = $request->state;
                $address->pincode = $request->pincode;
                $address->address_type = $request->address_type;
                $address->save();

                return response()->json(["message" => "Data inserted Successfully"]);

        }


        public function deleteAddress($id){
        $address = Address::findOrFail($id)->delete();
        return response()->json(["message" => "Data deleted Successfully"]);
        }



        public function updateAddress(Request $request, $id){
             $address = DB::select('select * from address where id = ?', [$id]);
                if($address==[]){
                    return response()->json(["message" => "Data Not Found"]);
                }
                else{
                        $address = DB::update("update address set customer_id = ?,address_line_1=?,address_line_2=?,
                        city=?, state = ? ,pincode = ?,address_type =? where id=? ",
                        [$request->customer_id,$request->address_line_1, $request->address_line_2, $request->city,
                        $request->state,$request->pincode,$request->address_type, $id]);

                return response()->json(["message" => "Data updated Successfully"]);
                }
        }

        public function listAddress($customer_id){
            $address = DB::select('select * from address where customer_id=?',[$customer_id]);
            return $address;
        }

        public function getAddressById($id){
            $address = DB::select('select * from address  where id =?',[$id]);
            return $address;

        }



}
