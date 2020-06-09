<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Sale;
use App\Sale_detail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = 50;
        $page_name = "Sale History";
        $sale_all = DB::table('sales')->orderBy('created_at','desc')->paginate($items);
        return view('admin.sale.sale_manage',compact('page_name','sale_all','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Add Sale";
        $all_customer = Customer::all();
        $all_product = Product::all();
        return view('admin.sale.sale_create',compact('page_name','all_customer','all_product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = 0;

        foreach ((array)$request->product_id as $product) {
            $count++;
        }
        $products = $request->input('product_id',[]);
        $first_weight = $request->input('first_weight',[]);
        $second_weight = $request->input('second_weight',[]);
        $less = $request->input('less',[]);
        $main_weight = $request->input('main_weight',[]);
        $rate = $request->input('rate',[]);
        $total_price = $request->input('total_price',[]);

        $sale = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->employee_id = Auth::id();
        $sale->sale_date = $request->sale_date;
        $sale->save();
        $sale_id = Sale::all()->last()->id;

        for($i = 0; $i < 2; $i++){
            $sale_detail = new Sale_detail();
            $sale_detail->sale_id = $sale_id;
            $sale_detail->product_id = $request->product_id[$i];
            $sale_detail->first_weight = $request->first_weight[$i];
            $sale_detail->second_weight = $request->second_weight[$i];
            $sale_detail->less = $request->less[$i];
            $sale_detail->main_weight = $request->main_weight[$i];
            $sale_detail->rate = $request->rate[$i];
            $sale_detail->total_price = (($request->first_weight[$i]-$request->second_weight[$i])*((100-$request->less[$i])/100))*$request->rate[$i];
            $sale_detail->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
