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
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none">
                                        {{$i =  ($customer_all->currentPage()-1)*$items}}
                                    </div>
                                    @foreach($customer_all as $customer)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$customer->id}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->mobile}}</td>
                                            <td>{{$customer->address}}</td>
                                            <td>
                                                <div class="row">
                                                    <a href="{{route('customer.edit',$customer->id)}}"><span title="Edit" type="button"
                                                                                                         class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
                                                    <form action="{{route('customer.destroy',$customer->id)}}" method="post">
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
                                {{ $customer_all->links() }}
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


