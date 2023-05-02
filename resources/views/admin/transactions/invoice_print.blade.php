<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin| Invoice Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin/dist/css/adminlte.min.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{!! asset('admin/dist/css/style.css') !!}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="container">
    <section class="col-12" style="margin-top: 15px">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <i class="fas fa-globe"></i> AdminRmsport
                    <small class="float-right">{{ date('Y-m-d') }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Người gửi
                <address>
                    <strong>Admin, Inc.</strong><br>
                    180 Cao Lỗ<br>
                    phường 4, quận 8<br>
                    Phone: 0703732218<br>
                    Email: rmsportfootball21@gmail.com

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Người nhận
                <address>
                    <strong>{{isset($transaction->user) ? $transaction->user->name :  $transaction->tst_name}}</strong><br>
                    Phone: {{isset($transaction->user) ? $transaction->user->phone : $transaction->tst_phone}}<br>
                    Email: {{isset($transaction->user) ? $transaction->user->email : $transaction->tst_email}}<br>
                    Địa chỉ : {{isset($transaction->city) ? $transaction->city->loc_name : ''}} - {{isset($transaction->district) ? $transaction->district->loc_name : ''}} - {{isset($transaction->street) ? $transaction->street->loc_name : ''}} <br>
                    Địa chỉ cụ thể : {{ isset($transaction) ? $transaction->tst_address : '' }}<br>
                    Ghi chú : {{ isset($transaction) ? $transaction->tst_note : '' }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Thông tin giao dịch
                <address>
                    <b>Mã giao dịch: {{ isset($transaction) ? $transaction->id : '' }}</b><br>
                    <span>Mã tài khoản :</span> {{ isset($transaction->user) ? $transaction->user->id : '' }}<br>
                    <span>Trạng thái : {{ $status[$transaction->tst_status] }}</span><br>
                    <span>PT thanh toán : @if($transaction->tr_payment_methods == 1) <span>Nhận hàng</span> @else <span>Thanh toán online</span> @endif</span>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th class="text-center">Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (isset($transaction->order))
                            <?php $total = 0; ?>
                            @foreach($transaction->order as $key => $product)
                                @if ($product->pc_qty > 0)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                        <td style="vertical-align: middle;">
                                            {{$product->pc_name}}
                                            <ul class="list-invoice">
                                                @if ($product->pc_color)
                                                <li>Color : {{ $product->pc_color}}</li>
                                                @endif
                                                @if ($product->pc_size)
                                                <li>Size : {{ $product->pc_size}}</li>
                                                @endif
                                            </ul>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $product->pc_qty }}</td>
                                        <td style="vertical-align: middle;">
                                            <?php

                                                if ($product->pc_sale) {
                                                    $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100 ;
                                                } else {
                                                    $price = $product->pc_price;
                                                }

                                                if ($product->pc_status != 4) {
                                                    $total = $total + (intval($product->pc_qty) * $price);
                                                }

                                            ?>
                                            {{ number_format($price,0,',','.') }} vnđ
                                        </td>
                                        <td style="vertical-align: middle;">{{ number_format(($product->pc_qty * $price),0,',','.') }} vnđ</td>
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-block {{ $classStatus[$product->pc_status] }} btn-xs">{{ $status[$product->pc_status] }}</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
            </div>
            <!-- /.col -->
            <div class="col-6">
                <p class="lead"></p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Phí vận chuyển:</th>
                            <td>{{ $total > 0 ? number_format(20000, 0,',','.') : 0 }} vnđ</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Thuế :</th>
                            <td>{{ $total > 0 ? number_format(($total * 5 / 100), 0,',','.') : 0 }} vnđ</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Tổng tiền:</th>
                            <td>{{ $total > 0 ? number_format($total + 20000 + ($total * 10 / 100), 0,',','.') : 0 }} vnđ</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-6 text-center">
                <p><b>Nhân viên giao hàng</b></p>
                <p style="font-size: 12px;">( Ký ghi rõ họ tên )</p>
            </div>
            <div class="col-6 text-center">
                <p><b>Khách hàng</b></p>
                <p style="font-size: 12px;">( Ký ghi rõ họ tên )</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i> Print </button>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    //window.addEventListener("load", window.print());
</script>
</body>
</html>
