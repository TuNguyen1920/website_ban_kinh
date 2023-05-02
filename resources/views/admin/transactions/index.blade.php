@extends('admin.layouts.main')
@section('title', 'Quản lý giao dịch')
@section('style-css')
    <!-- fullCalendar -->
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý giao dịch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý giao dịch</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h3 class="card-title">From tìm kiếm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="user_name" class="form-control mg-r-15" placeholder="Tên khách hàng">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="user_email" class="form-control mg-r-15" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="user_phone" class="form-control mg-r-15" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Tìm kiếm </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Danh sách giao dịch</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-hover text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th width="4%" class=" text-center">STT</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th class=" text-center">Thời gian</th>
                                <th>Trạng thái</th>
                                <th class=" text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!$transactions->isEmpty())
                            @php $i = $transactions->firstItem(); @endphp
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class=" text-center" style="vertical-align: middle;">{{ $i }}</td>
                                    <td style="vertical-align: middle;">
                                        <ul class="user-transaction">
                                            <li>Họ tên : {{isset($transaction->user) ? $transaction->user->name :  $transaction->tst_name}}</li>
                                            <li>Email : {{isset($transaction->user) ? $transaction->user->email : $transaction->tst_email}}</li>
                                            <li>Phone : {{isset($transaction->user) ? $transaction->user->phone : $transaction->tst_phone}}</li>
                                            <li>
                                                Địa chỉ : {{isset($transaction->city) ? $transaction->city->loc_name : ''}} -
                                                {{isset($transaction->district) ? $transaction->district->loc_name : ''}} -
                                                {{isset($transaction->street) ? $transaction->street->loc_name : ''}}
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="vertical-align: middle;"><p>{{ number_format($transaction->tst_total_money, 0, ',', '.') }} vnđ</p></td>
                                    <td style="vertical-align: middle;">
                                        @if($transaction->tr_payment_methods == 1)
                                            <p>Nhận hàng</p>
                                        @else
                                            <p>Thanh toán online</p>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <p>{{ date('Y-m-d H:i', strtotime($transaction->created_at)) }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button type="button" class="btn btn-block {{ $classStatus[$transaction->tst_status] }} btn-xs">{{ $status[$transaction->tst_status] }}</button>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm">Hành động</button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu action-transaction" role="menu">
                                                <li><a href="{{ route('transaction.delete', $transaction->id) }}" class="btn-confirm-delete"><i class="fa fa-trash"></i>  Delete</a></li>
                                                <li class="update_transaction" url='{{ route('transaction.update.status', ['1', $transaction->id]) }}'><a><i class="fas fa-check"></i>  Tiếp nhận</a></li>
                                                <li class="update_transaction" url='{{ route('transaction.update.status', ['2', $transaction->id]) }}'><a><i class="fas fa-check"></i>  Đang giao hàng</a></li>
                                                <li class="update_transaction" url='{{ route('transaction.update.status', ['3', $transaction->id]) }}'><a><i class="fas fa-check"></i>  Đã giao hàng</a></li>
                                                <li class="update_transaction" url='{{ route('transaction.update.status', ['4', $transaction->id]) }}'><a><i class="fa fa-ban"></i>  Huỷ</a></li>
                                            </ul>
                                        </div>
                                        <a class="btn btn-info btn-sm" target="_blank" href="{{ route('transaction.invoice.print', $transaction->id) }}" title="Thông tin đơn hàng">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if($transactions->hasPages())
                        <div class="pagination float-right margin-20">
                            {{ $transactions->appends($query = '')->links() }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@section('script')

@stop
