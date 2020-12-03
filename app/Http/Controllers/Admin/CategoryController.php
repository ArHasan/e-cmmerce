<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_category_id = Category::all();
        return view('admin.category.index',compact('parent_category_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::simplePaginate(10);
        return view('admin.category.show',compact('category'));
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
            'category_name' => ['required', 'unique:categories'],
            'description' => ['required'],
            'parent_category_id' => ['required'],

        ]);

        if ($request->hasfile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 622)->save(public_path('/img/category/' . $filename));
            Category::insert([
                'category_name' => ucwords($request->category_name),
                'slug' => Str::slug($request->category_name),
                'parent_category_id' => $request->parent_category_id,
                'status' => $request->status,
                'description' => $request->description,
                'thumbnail' => $filename,
                'created_at' => Carbon::now(),
            ]);
        } else {
            Category::insert([
                'category_name' => ucwords($request->category_name),
                'slug' => Str::slug($request->category_name),
                'parent_category_id' => $request->parent_category_id,
                'status' => $request->status,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', 'Added Category Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent_category_id = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category','category','parent_category_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = Category::findorfail($id);
        $request->validate([
            'category_name' => ['required'],
            'parent_category_id' => ['required'],
        ]);

        if ($request->hasfile('thumbnail')) {
            //old photo delete start
            $delete_photo_location = public_path('/img/category/') . $category->thumbnail;
            if (file_exists($delete_photo_location)) {
                unlink($delete_photo_location);}
            //old photo delete end

            //new photo update start
            $upload_photo = $request->file('thumbnail');
            $new_name = time() . '.' . $upload_photo->getClientOriginalExtension();
            $new_uploade_location = public_path('/img/category/' . $new_name);
            Image::make($upload_photo)->resize(600, 470)->save($new_uploade_location);
            //new photo end

            $category->update([
                'category_name' => $request->category_name,
                'slug' => Str::slug($request->category_name),
                'parent_category_id' => $request->parent_category_id,
                'status' => $request->status,
                'description' => $request->description,
                'thumbnail' => $new_name,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $category->update([
                'category_name' => $request->category_name,
                'slug' => Str::slug($request->category_name),
                'parent_category_id' => $request->parent_category_id,
                'status' => $request->status,
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]);
        }
        return redirect(route('categroy.create'))->with('success', 'Successfully Updated  Category ! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delet_photo_location = public_path('/img/category/') . Category::find($id)->thumbnail;
        unlink($delet_photo_location);
        Category::findOrFail($id)->delete();
        return back()->with('delete', 'Successfully Category Deleted');
    }
}
