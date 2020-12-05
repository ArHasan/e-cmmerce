<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attribute.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $attribute = Attribute::simplePaginate(10);
        return view('admin.attribute.show',compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);
        Attribute::insert([
            'name' => ucwords($request->name),
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Added Attribute Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.edit',compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attribute = Attribute::findorfail($id);
        $attribute->update([
            'name' => ucwords($request->name),
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);
        return redirect(route('attribute.create'))->with('success', 'Successfully Updated  Attribute ! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attribute::findOrFail($id)->delete();
        return back()->with('delete', 'Successfully Category Deleted');
    }
}
