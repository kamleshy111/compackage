<?php

namespace App\Http\Controllers\Admin;


use Exception;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.coupon.index');
    }

    public function indexAPI()
    {
        $coupons = Coupon::all();
        return send_success(["coupons" => $coupons]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( ! empty( $request->id ) ) {
            $n = ['required'];
        } else {
            $n = ['required', 'unique:coupons,name'];
        }

        $validator = Validator::make($request->all(), [
            'name'      => $n,
            'type'      => ['required'],
            'amount'    => ['required','numeric'],
            'expire'    => ['required', 'date']
        ], [
            'name.required' => 'Coupon code is required.',
            'name.unique' => 'Coupon code already exists.'
        ]);

        if($validator->fails()) {
			$error_msg = $validator->errors()->first();
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $error_msg, 
                    "key" => $validator->errors()->keys()[0]
                ]
            ]);
		}

        try {
            if( ! empty( $request->id ) ) {

                $coupon = Coupon::find($request->id);
                
                if( empty( $coupon ) ) {
                    $coupon = new Coupon();
                }

            } else {
                $coupon = new Coupon();
            }

            $coupon->name = $request->name;
            $coupon->type = $request->type;
            $coupon->amount = $request->amount;
            $coupon->expire = $request->expire;
            
            if( ! empty($request->limit) && $request->limit > 0 ) {
                $coupon->limit = $request->limit;
            } else {
                $coupon->limit = 0;
            }

            $coupon->save();
    
            return send_success(["msg" => 'Coupon code created.']);
        } catch( Exception $ex) {
            return send_error(['msg' => 'Something went wrong.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->delete();
            return send_success(["msg" => "Coupon deleted successfully."]);
        } catch( Exception $ex ) {
            return send_error(["msg" => "Something went wrong."]);
        }
    }

    public function applyCoupon($coupon)
    {
        $coupon = Coupon::where('name', trim($coupon))->first();
        if( ! empty( $coupon ) ) {
            if( ! empty($coupon->expire) && strtotime($coupon->expire) > time() ) {
                if( ! empty($coupon->limit) && $coupon->limit > $coupon->used ) {
                    return send_success(['msg' => 'Coupon verified successfully', "type" => $coupon->type, "amount" => $coupon->amount, "coupon_id" => $coupon->id]);
                }
                return send_error(['msg' => 'Max. limit crossed.']);    
            }
            return send_error(['msg' => 'Coupon expired.']);
        }
        return send_error(['msg' => 'Coupon not found.']);
    }

}
