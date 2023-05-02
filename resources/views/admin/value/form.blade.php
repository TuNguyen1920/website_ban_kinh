<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Thuộc tính <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="v_attribute_id">
                                <option value="">Chọn thuộc tính</option>
                                @foreach($attributes as $attribute)
                                    <option
                                            {{old('v_attribute_id', isset($value->v_attribute_id) ? $value->v_attribute_id : '') == $attribute->id ? 'selected="selected"' : ''}}
                                            value="{{$attribute->id}}"
                                    >
                                        {{$attribute->a_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $errors->first('v_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên giá trị <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên giá trị" name="v_name" value="{{ old('v_name',isset($value) ? $value->v_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('v_name') }}</p></span>
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
                </div>
            </div>
        </div>
    </form>
</div>
