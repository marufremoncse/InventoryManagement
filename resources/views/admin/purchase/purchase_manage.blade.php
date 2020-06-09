@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if($message = Session::get('success'))
                <div class="alert alert-info">
                    {{$message}}
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$page_name}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Purchase ID</th>
                                        <th>Supplier Name</th>
                                        <th>Employee Name</th>
                                        <th>Total Amount</th>
                                        <th>Total Paid</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$i =  ($purchase_all->currentPage()-1)*$items}}
                                    </div>
                                    @foreach($purchase_all as $purchase)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$purchase->id}}</td>
                                            <td>{{\App\Supplier::where('id','=',$purchase->supplier_id)->pluck('name')->first()}}</td>
                                            <td>{{\App\User::where('id','=',$purchase->employee_id)->pluck('first_name')->first()}}&nbsp{{\App\User::where('id','=',$purchase->employee_id)->pluck('last_name')->first()}}</td>
                                            <td>{{$purchase->total_amount}}</td>
                                            <td>{{$purchase->total_paid}}</td>
                                            <td>{{$purchase->due}}</td>
                                            <td>{{$purchase->purchase_date}}</td>
                                            <td>
                                                <div class="row">
                                                    <a href="{{route('purchase.show',$purchase->id)}}"><span title="Edit" type="button"
                                                    class="btn btn-flat btn-info"><i class="fa fa-info-circle"></i></span></a>&nbsp;
                                                    <a href="{{route('purchase.edit',$purchase->id)}}"><span title="Edit" type="button"
                                                     class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
                                                    <form action="{{route('purchase.destroy',$purchase->id)}}" method="post">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button class="btn btn-flat btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="margin-left: 20px">
                                {{ $purchase_all->links() }}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content -->
@endsection


