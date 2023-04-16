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