<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('td_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên nhà cung cấp <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên thương hiệu" name="td_name" value="{{ old('td_name',isset($trademark) ? $trademark->td_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('td_name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('td_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Email <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="email" class="form-control"  placeholder="Email" name="td_email" value="{{ old('td_email',isset($trademark) ? $trademark->td_email : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('td_email') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('td_phone') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Số điện thoại <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Phone" name="td_phone" value="{{ old('td_phone',isset($trademark) ? $trademark->td_phone : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('td_phone') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('td_address') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Địa chỉ <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Địa chỉ" name="td_address" value="{{ old('td_address',isset($trademark) ? $trademark->td_address : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('td_address') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('td_fax') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Fax <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Địa chỉ" name="td_fax" value="{{ old('td_fax',isset($trademark) ? $trademark->td_fax : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('td_fax') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('td_link') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Link </label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Link" name="td_link" value="{{ old('td_link',isset($trademark) ? $trademark->td_link : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('td_link') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('td_description') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Mô tả </label>
                            <div>
                                <textarea name="td_description" style="resize:vertical" rows="9" class="form-control" placeholder="Mô tả ...">{{ old('td_description',isset($trademark) ? $trademark->td_description : '') }}</textarea>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('td_description') }}</p></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Xuất bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-body -->
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh </h3>
                    </div>
                    <div class="card-body" style="min-height: 288px">
                        <div class="form-group">
                            <div class="input-group input-file" name="images">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Chọn tệp</button>
                                </span>
                                <input type="text" class="form-control" placeholder='Không có tệp nào ...'/>
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>
                            @if(isset($trademark) && !empty($trademark->td_image))
                                <img src="{{ asset(pare_url_file($trademark->td_image)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @else
                                <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%; display: none">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
