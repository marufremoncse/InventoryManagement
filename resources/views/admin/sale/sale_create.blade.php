@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(count($errors)>0)
                <div class="alert alert-danger"  role="alert">
                    <ul>
                        @foreach($errors->all() as $errors)
                            <li>{{$errors}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$page_name}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{$page_name}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{$page_name}} Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form enctype="multipart/form-data" action="{{route('sale.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="supplier_sss" class="col-sm-3 col-form-label">Customer<i class="text-danger">*</i>
                                                </label>
                                                <div class="col-sm-6">
                                                    <select name="customer_id" id="supplier_sss" class="form-control " required="" tabindex="1">
                                                        <option value="">Select One</option>
                                                        @foreach($all_customer as $customer)
                                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-sm-3">
                                                    <a href="{{route('customer.create')}}">Add Customer</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-4 col-form-label">Sales Date<i class="text-danger">*</i></label>
                                                <div class="col-sm-8">
                                                    <input type="text" tabindex="2" class="form-control" data-inputmask-alias="datetime"
                                                           data-inputmask-inputformat="dd/mm/yyyy" data-mask name="sale_date" value="" id="date" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" style="margin-top: 10px">
                                        <table class="table table-bordered table-hover" id="purchaseTable">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Product<i class="text-danger">*</i></th>
                                                <th class="text-center">1st Weight<i class="text-danger">*</i></th>
                                                <th class="text-center">2nd Weight<i class="text-danger">*</i></th>
                                                <th class="text-center">Less(%)<i class="text-danger">*</i></th>
                                                <th class="text-center">Main Weight<i class="text-danger">*</i></th>
                                                <th class="text-center">Rate<i class="text-danger">*</i></th>
                                                <th class="text-center">Total Amount<i class="text-danger">*</i></th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="addSaleItem">
                                            <tr id="invoice_row">
                                                <td class="span3 supplier_load">
                                                    <select class="form-control" name="product_id[]">
                                                        <option value="">Select One</option>
                                                        @foreach($all_product as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td class="text-right">
                                                    <input type="number" name="first_weight[]" required="" id="first_weight" class="form-control first_weight" placeholder="1st wgt" min="0">
                                                </td>

                                                <td class="text-right">
                                                    <input type="number" name="second_weight[]" required="" id="second_weight" class="form-control second_weight" placeholder="2nd wgt" min="0">
                                                </td>

                                                <td class="text-right">
                                                    <input type="number" name="less[]" required="" value="" id="less" class="form-control less" placeholder="0.00" min="0" max="100">
                                                </td>

                                                <td class="text-right">
                                                    <input type="number" name="main_weight[]" required="" id="main_weight" class="form-control main_weight" placeholder="Main wgt" min="0" readonly="readonly">
                                                </td>

                                                <td class="text-right">
                                                    <input type="number" name="rate[]" required="" id="rate" class="form-control rate" placeholder="0.00" min="0">
                                                </td>
                                                <td class="text-right">
                                                    <input class="form-control total_price" type="text" name="total_price[]" id="total_price" value="0.00" readonly="readonly">
                                                </td>
                                                <td>
                                                    <button style="text-align: right;" class="btn btn-danger delete_row" type="button" value="Delete" tabindex="8">Delete</button>
                                                </td>

                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td>
                                                    <input type="button" class="btn btn-info add-invoice-item" name="add-item" value="Add New Item">
                                                </td>
                                                <td style="text-align:right;" colspan="5"><b>Grand Total:</b></td>
                                                <td class="text-right">
                                                    <input type="text" id="grandTotal" tabindex="-1" class="text-right form-control grand_total_price" name="grand_total_price" value="0.00" readonly="readonly">
                                                </td>
                                                <td>
                                                    <input type="button" class="btn btn-warning calculate_price" name="calculate_price" value="Calculate">
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="submit" id="add-purchase" class="btn custom_btn custom_fontcolor btn-large" name="add-purchase" value="Submit" tabindex="10">
                                            <input type="submit" value="Submit And Add Another One" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another" tabindex="11">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('pageSpecificScripts')
    <script>
        var invoice_item = 1;
        $('.add-invoice-item').on('click',function(){
            addrow();
        });
        function addrow() {
            invoice_item++;
            var tr = $('#invoice_row');
            $('tbody').append(tr.clone());
        }

        $('tbody').on('click','.delete_row',function () {
            if(invoice_item>1){
                $(this).parent().parent().remove();
                invoice_item--;
            }
        });

        $('.calculate_price').on('click',function(){
            var i=0;
            var grand_total_price = 0;
            for(i=0;i<invoice_item;i++){
                var first_weight = $('.first_weight').eq(i).val();
                var second_weight = $('.second_weight').eq(i).val();
                var less = $('.less').eq(i).val();
                var rate = $('.rate').eq(i).val();
                var main_weight = (first_weight - second_weight)*((100-less)/100);
                var total_price = main_weight*rate;
                $(".main_weight").eq(i).val(main_weight.toFixed(2));
                $(".total_price").eq(i).val(total_price.toFixed(2));
                grand_total_price+=total_price;
            }
            $(".grand_total_price").val(grand_total_price.toFixed(2));
        });
    </script>
@stop
