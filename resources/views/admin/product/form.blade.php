<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('pro_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên sản phẩm <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên sản phẩm " name="pro_name" value="{{ old('pro_name',isset($product) ? $product->pro_name : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pro_name') }}</p></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Danh mục <sup class="text-danger">(*)</sup></label>
                                    <select class="custom-select" name="pro_category_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach($categories as $category)
                                            @if (isset($category->children) && count($category->children) > 0)
                                                <optgroup label="{{ $category->c_name }}">
                                                    @foreach($category->children as $children)
                                                    <option
                                                            {{old('pro_category_id', isset($product->pro_category_id ) ? $product->pro_category_id  : '') == $children->id ? 'selected="selected"' : ''}}
                                                            value="{{$children->id}}"
                                                    >
                                                        {{$children->c_name}}
                                                    </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option
                                                        {{old('pro_category_id', isset($product->pro_category_id ) ? $product->pro_category_id  : '') == $category->id ? 'selected="selected"' : ''}}
                                                        value="{{$category->id}}"
                                                >
                                                    {{$category->c_name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pro_category_id') }}</p></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Nhãn hiệu <sup class="text-danger">(*)</sup></label>
                                    <select class="custom-select" name="pro_trademark_id">
                                        <option value="">Chọn nhãn hiệu</option>
                                        @foreach($trademarks as $trademark)
                                            <option
                                                    {{old('pro_trademark_id', isset($product->pro_trademark_id ) ? $product->pro_trademark_id  : '') == $trademark->id ? 'selected="selected"' : ''}}
                                                    value="{{$trademark->id}}"
                                            >
                                                {{$trademark->td_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pro_trademark_id') }}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kiểu sản phẩm <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select select2" name="types[]" multiple="">
                                <option value="">Chọn kiểu </option>
                                @foreach($types as $key => $type)
                                    <option value="{{$type->id}}"
                                            @if( null !== old('types') and in_array($type->id, old('types'))
                                            or isset($typeEdit) and in_array($type->id, $typeEdit)) selected ="selected" @endif >
                                        {{$type->tp_name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pro_category_id') }}</p></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group {{ $errors->first('pro_price') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class="control-label default">Giá sản phẩm</label>
                                    <div>
                                        <input type="number" maxlength="100" class="form-control"  placeholder="Giá sản phẩm" name="pro_price" value="{{ old('pro_price',isset($product) ? $product->pro_price : '') }}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('pro_price') }}</p></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group {{ $errors->first('pro_sale') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class="control-label default">Giảm giá</label>
                                    <div>
                                        <input type="number" max="100" class="form-control"  placeholder="Giảm giá" name="pro_sale" value="{{ old('pro_sale',isset($product) ? $product->pro_sale : '') }}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('pro_sale') }}</p></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group {{ $errors->first('pro_number') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class="control-label default">Số lượng </label>
                                    <div>
                                        <input type="text" class="form-control"  placeholder="Số lượng" name="pro_number" value="{{ old('pro_number',isset($product) ? $product->pro_number : '') }}">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pro_number') }}</p></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group {{ $errors->first('pro_number') ? 'has-error' : '' }} ">
                                    <div>
                                        <div class="col-md-12 role-item" style="margin-top: 33px;">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" value="1" {{ old('pro_is_sale', isset($product) ? $product->pro_is_sale : '') == 1 ? 'checked' : '' }} name="pro_is_sale" id="checkbox">
                                                <label for="checkbox">
                                                    Khuyến mại
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('pro_keywords') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Keyword </label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Keyword sản phẩm " name="pro_keywords" value="{{ old('pro_keywords',isset($product) ? $product->pro_keywords : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pro_keywords') }}</p></span>
                            </div>
                        </div>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Thuộc tính</legend>
                            <div class="col-md-12 permission_role" style="padding: 0px;">
                                @if($attributes)
                                    @foreach($attributes as $attribute)
                                        <div class="attribute">
                                            <h4 class="title-role">{{$attribute->a_name}}</h4>
                                            <div class="row content-role default">
                                                @foreach($attribute->values as $value)
                                                    <div class="col-md-3 role-item">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" class="{{safeTitle($value->v_name)}}"
                                                                   @if( null !== old('values') and in_array($value->id, old('values'))
                                                                   or isset($attributeEdit) and in_array($value->id, $attributeEdit)) checked @endif
                                                                   value="{{$value->id}}" name="values[]" id="checkbox{{ $value->id }}">
                                                            <label for="checkbox{{ $value->id }}">
                                                                {{$value->v_name}}
                                                            </label>
                                                        </div>
                                                        <input type="text" class="form-control" name="pv_price[{{$value->id}}]"
                                                           placeholder="Giá" style="margin-top: 10px; display: {{ $attribute->id == 3 ? 'block' : 'none' }}"
                                                               value="{{ old('pv_price.'. $value->id, isset($priceEdit[$value->id]) ? $priceEdit[$value->id] : '' ) }}"
                                                        >
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </fieldset>
                        <div class="form-group {{ $errors->first('pro_description') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Mô tả hoặc khuyến mại </label>
                            <div>
                                <textarea name="pro_description" id="pro_description" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('pro_description', isset($product) ? $product->pro_description : '') }}</textarea>
                                <script>
                                    ckeditor(pro_description);
                                </script>
                                @if ($errors->first('pro_description'))
                                    <span class="text-danger">{{ $errors->first('pro_description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('pro_content') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Bài viết mô tả </label>
                            <div>
                                <textarea name="pro_content" id="pro_content" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('pro_content', isset($product) ? $product->pro_content : '') }}</textarea>
                                <script>
                                    ckeditor(pro_content);
                                </script>
                                @if ($errors->first('pro_content'))
                                    <span class="text-danger">{{ $errors->first('pro_content') }}</span>
                                @endif
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
                    <div class="card-header">
                        <h3 class="card-title">Ảnh đại diện </h3>
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
                            @if(isset($product) && !empty($product->pro_avatar))
                                <img src="{{ asset(pare_url_file($product->pro_avatar)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @else
                                <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @endif
                        </div>
                    </div>
                    {{--<div class="card-header">--}}
                        {{--<h3 class="card-title">Ảnh mô tả </h3>--}}
                    {{--</div>--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="file" name="files" class="form-control" multiple>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
