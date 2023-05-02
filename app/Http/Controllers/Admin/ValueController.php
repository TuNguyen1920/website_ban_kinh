<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Value;
use App\Models\Attribute;
use App\Http\Requests\ValueRequest;

class ValueController extends Controller
{
    protected $value;
    /**
     * constructor.
     */
    public function __construct(Value $value, Attribute $attribute)
    {
        view()->share([
            'value_active' => 'active',
            'data_product_active' => 'active',
            'attributes' => $attribute::all(),
        ]);
        $this->value = $value;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $values = Value::with('attribute')->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.value.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.value.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValueRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->value->createOrUpdate($request);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $value = Value::findOrFail($id);

        if (!$value) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.value.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValueRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->value->createOrUpdate($request, $id);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $value = Value::findOrFail($id);
        if (!$value) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $value->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
