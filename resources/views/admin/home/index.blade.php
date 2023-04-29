@extends('admin.layouts.main')
@section('title', 'Quản lý bán hàng')
@section('style-css')
    <!-- fullCalendar -->
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý bán hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý bán hàng</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Dữ liệu website</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="ion ion-ios-cart-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tổng số đơn hàng</span>
                                    <span class="info-box-number">{{  number_format($transaction) }}<small><a href="{{  route('transaction.index') }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Sản phẩm</span>
                                    <span class="info-box-number">{{  $product }} <small><a href="{{ route('product.index') }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Thành viên</span>
                                    <span class="info-box-number">{{ number_format($user) }} <small><a href="{{ route('user.index') }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i class="fas fa-file-word"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Số lượng bài viết</span>
                                    <span class="info-box-number">{{ number_format($article) }} <small><a href="{{ route('article.index') }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu ngày</span>
                                    <span class="info-box-number">{{ number_format($totalMoneyDay,0,',','.') }} <small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu tuần</span>
                                    <span class="info-box-number">{{ number_format($totalMoneyWeed ,0,',','.') }}<small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu tháng</span>
                                    <span class="info-box-number">{{number_format($totalMoneyMonth,0,',','.')  }} <small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu năm</span>
                                    <span class="info-box-number">{{ number_format($totalMoneyYear ,0,',','.') }} <small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Biểu đồ thống kê</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-sm-8">
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <?php $month = date('m'); ?>
                                        <div class="form-group">
                                            <select name="select_month" id="" class="form-control">
                                                <option value="">Chọn tháng</option>
                                                @for($i = 1; $i < 13; $i++)
                                                    @if(Request::get('select_month'))
                                                        <option {{ Request::get('select_month') == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                    @else
                                                        <option {{ $month == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <?php $year = date('Y'); ?>
                                        <div class="form-group">
                                            <select name="select_year" id="" class="form-control">
                                                <option value="">Chọn năm</option>
                                                @for($i = $year - 15; $i <= $year + 5; $i++)
                                                    @if(Request::get('select_year'))
                                                        <option {{ Request::get('select_year') == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                    @else
                                                        <option {{ $year == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Lọc dữ liệu </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <figure class="highcharts-figure">
                                <div id="container2" data-list-day="{{ $listDay }}"
                                     data-money-default={{ $arrRevenueTransactionMonthDefault }}
                                     data-money={{ $arrRevenueTransactionMonth }}
                                     data-money-cancel={{ $arrRevenueTransactionMonthCancel }}
                                     data-money-transport={{ $arrRevenueTransactionMonthTransport }}
                                >
                                </div>
                            </figure>
                        </div>
                        <div class="col-sm-4">
                            <figure class="highcharts-figure">
                                <div id="container" data-json="{{ $statusTransaction }}"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Danh sách đơn hàng mới</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Thông tin</th>
                                        <th>TỔng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactionsNew as $key => $transaction)
                                        <tr>
                                            <td style="vertical-align: middle;"> {{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">
                                                <ul>
                                                    <li>Name: {{ $transaction->tst_name }}</li>
                                                    <li>Email: {{ $transaction->tst_email }}</li>
                                                    <li>Phone: {{ $transaction->tst_phone }}</li>
                                                </ul>
                                            </td>
                                            <td style="vertical-align: middle;">{{ number_format($transaction->tst_total_money,0,',','.') }} đ</td>
                                            <td style="vertical-align: middle;">
                                                <button type="button" class="btn btn-block {{ $classStatus[$transaction->tst_status] }} btn-xs">{{ $status[$transaction->tst_status] }}</button>
                                            </td>
                                            <td style="vertical-align: middle;">{{  date('Y-m-d H:i', strtotime($transaction->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop
@section('script')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        let dataTransaction = $("#container").attr('data-json');
        dataTransaction  =  JSON.parse(dataTransaction);

        let listday = $("#container2").attr("data-list-day");
        listday = JSON.parse(listday);

        let listMoneyMonth = $("#container2").attr('data-money');
        listMoneyMonth = JSON.parse(listMoneyMonth);

        let listMoneyMonthDefault = $("#container2").attr('data-money-default');
        listMoneyMonthDefault = JSON.parse(listMoneyMonthDefault);

        let listMoneyMonthCancel = $("#container2").attr('data-money-cancel');
        listMoneyMonthCancel = JSON.parse(listMoneyMonthCancel);

        let listMoneyMonthTransport = $("#container2").attr('data-money-transport');
        listMoneyMonthTransport = JSON.parse(listMoneyMonthTransport);

        Highcharts.chart('container', {

            chart: {
                styledMode: true
            },

            title: {
                text: 'Thống kê trạng thái đơn hàng'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: dataTransaction,
                showInLegend: true
            }]
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Biểu đồ doanh thu các ngày trong tháng'
            },
            subtitle: {
                text: 'Danh sách ngày'
            },
            xAxis: {
                categories: listday
            },
            yAxis: {
                title: {
                    text: 'Temperature'
                },
                labels: {
                    formatter: function () {
                        return this.value + '°';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [
                {
                    name: 'Hoàn tất giao dịch',
                    marker: {
                        symbol: ''
                    },
                    data: listMoneyMonth
                },
                {
                    name: 'Đang vận chuyển',
                    marker: {
                        symbol: ''
                    },
                    data: listMoneyMonthTransport
                },
                {
                    name: 'Tiếp nhận',
                    marker: {
                        symbol: ''
                    },
                    data: listMoneyMonthDefault
                },
                {
                    name: 'Hủy',
                    marker: {
                        symbol: ''
                    },
                    data: listMoneyMonthCancel
                },



            ]
        });
    </script>
@stop