{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('member.layout.app')

@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Strikers Club, Inc. Member Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('member.dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Amount</span>
                                    <span class="info-box-number">
                                        {{-- {{ auth()->user()->total_balance ?? 0 }} ({{ auth()->user()->type ?? '' }}) --}}
                                        {{ auth()->user()->total_balance ?? 0 }}
                                        {{-- <small>%</small> --}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="ion ion-pie-graph"></i></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Paid Balance</span>
                                    <span class="info-box-number">
                                        {{-- {{ auth()->user()->total_balance - auth()->user()->due_balance ?? 0 }} ({{ auth()->user()->type ?? '' }}) --}}
                                        {{ auth()->user()->total_balance - auth()->user()->due_balance ?? 0 }}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="ion ion-stats-bars"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Balance Amount</span>
                                    <span class="info-box-number">
                                        {{-- {{ auth()->user()->due_balance ?? 0 }} ({{ auth()->user()->type ?? '' }}) --}}
                                        {{ auth()->user()->due_balance ?? 0 }}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                                {{-- <div class="info-box-content">
                                    <span class="info-box-text">Refferal</span>
                                    <span class="info-box-number">Commimg soon</span>
                                </div> --}}
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                                            <!-- /.col -->
                    </div>
                    <!-- /.row -->



                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-6">


                            <!-- /.row -->

                            <!-- TABLE: LATEST ORDERS -->
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">All Events</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>SL.</th>
                                                    <th>Title</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($events as $key => $event)

                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td><a href="pages/examples/invoice.html">{{$event->title}}</a></td>
                                                    <td>{{$event->from}}</td>
                                                    <td><span class="badge badge-success">{{$event->end}}</span></td>

                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4"  style="text-align:center"><span>There no data to show</span></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-4">
                            <!-- Info Boxes Style 2 -->
                            {{-- <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Inventory</span>
                                    <span class="info-box-number">5,200</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div> --}}
                            <!-- /.info-box -->
                            {{-- <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="far fa-heart"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Mentions</span>
                                    <span class="info-box-number">92,050</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div> --}}
                            <!-- /.info-box -->
                            {{-- <div class="info-box mb-3 bg-danger">
                                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Downloads</span>
                                    <span class="info-box-number">114,381</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div> --}}
                            <!-- /.info-box -->
                            {{-- <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="far fa-comment"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Direct Messages</span>
                                    <span class="info-box-number">163,921</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div> --}}
                            <!-- /.info-box -->

                            {{-- <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Browser Usage</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="chart-responsive">
                                                <canvas id="pieChart" height="150"></canvas>
                                            </div>
                                            <!-- ./chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <ul class="chart-legend clearfix">
                                                <li><i class="far fa-circle text-danger"></i> Chrome</li>
                                                <li><i class="far fa-circle text-success"></i> IE</li>
                                                <li><i class="far fa-circle text-warning"></i> FireFox</li>
                                                <li><i class="far fa-circle text-info"></i> Safari</li>
                                                <li><i class="far fa-circle text-primary"></i> Opera</li>
                                                <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                                            </ul>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                United States of America
                                                <span class="float-right text-danger">
                                                    <i class="fas fa-arrow-down text-sm"></i>
                                                    12%</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                India
                                                <span class="float-right text-success">
                                                    <i class="fas fa-arrow-up text-sm"></i> 4%
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                China
                                                <span class="float-right text-warning">
                                                    <i class="fas fa-arrow-left text-sm"></i> 0%
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.footer -->
                            </div> --}}
                            <!-- /.card -->

                            <!-- PRODUCT LIST -->
                            {{-- <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recently Added Products</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="dist/img/default-150x150.png" alt="Product Image"
                                                    class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                                    <span class="badge badge-warning float-right">$1800</span></a>
                                                <span class="product-description">
                                                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="dist/img/default-150x150.png" alt="Product Image"
                                                    class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">Bicycle
                                                    <span class="badge badge-info float-right">$700</span></a>
                                                <span class="product-description">
                                                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="dist/img/default-150x150.png" alt="Product Image"
                                                    class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">
                                                    Xbox One <span class="badge badge-danger float-right">
                                                        $350
                                                    </span>
                                                </a>
                                                <span class="product-description">
                                                    Xbox One Console Bundle with Halo Master Chief Collection.
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="dist/img/default-150x150.png" alt="Product Image"
                                                    class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                                    <span class="badge badge-success float-right">$399</span></a>
                                                <span class="product-description">
                                                    PlayStation 4 500GB Console (PS4)
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="javascript:void(0)" class="uppercase">View All Products</a>
                                </div>
                                <!-- /.card-footer -->
                            </div> --}}
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection
