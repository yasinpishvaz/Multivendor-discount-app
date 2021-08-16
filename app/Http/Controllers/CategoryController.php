<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Traits\UploadTrait;

class CategoryController extends Controller
{
    use UploadTrait;

    public function create()
    {
        $category = new Category();
        $categories = $category->mainCategories();
        return view('back.categories.create', compact('categories'));
    }


    public function createService()
    {
        $category = new Category();
        $categories = $category::with('childs')->where('parent_id', '0')->get();
        return view('back.categories.createService', compact('categories'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'title'       =>  ['required', 'max:191'],
            'slug'        =>  ['required', 'max:191'],
            'parent_id'   =>  ['required'],
            'description' =>  ['required', 'min:3', 'max:1000'],
            'icon_path'   =>  ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        $category = new Category();

        $category->title = $request->get('title');
        $category->slug  = $request->get('slug');
        $category->parent_id = $request->get('parent_id');
        $category->description = $request->get('description');

        if ($request->has('icon_path')) {

            $image = $request->file('icon_path');

            $folder = '/uploads/images/';

            $imageName = $this->uploadFile($image, $folder, 'public');

            $category->icon_path = $imageName;
        }

        $category->save();
        return back()->with('success', 'دسته با موفقیت اضافه شد!');
    }

    public function serviceStore(Request $request)
    {

        $request->validate([
            'title'       =>  ['required', 'max:191'],
            'slug'        =>  ['required', 'max:191'],
            'parent_id'   =>  ['required'],
            'description' =>  ['required', 'min:3', 'max:1000'],
            'icon_path'   =>  ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        $category = new Category();

        $category->title = $request->get('title');
        $category->slug  = $request->get('slug');
        $category->parent_id = $request->get('parent_id');
        $category->description = $request->get('description');

        if ($request->has('icon_path')) {

            $image = $request->file('icon_path');

            $folder = '/uploads/images/';

            $imageName = $this->uploadFile($image, $folder, 'public');

            $category->icon_path = $imageName;
        }

        $category->save();
        return back()->with('success', 'سرویس با موفقیت اضافه شد!');
    }



    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('back.categories.index', compact('categories'));
    }




    public function edit($id)
    {
        $category = new Category();
        $categories = $category->mainCategories();
        $selectedCategory = Category::findOrFail($id);
        return view('back.categories.edit', compact('selectedCategory', 'categories'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->childs()->delete();
        $category->delete();
        return back();
    }

    public function update(Request $request, $id)
    {
        $targetCategory = Category::findOrFail($id);

        $request->validate([
            'title'       =>  ['required', 'max:191'],
            'slug'        =>  ['required', 'max:191'],
            'parent_id'   =>  ['required'],
            'description' =>  ['required', 'min:3', 'max:1000'],
            'icon_path'   =>  ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);


        $requestData = $request->all();


        if ($request->has('icon_path')) {

            $image = $request->file('icon_path');

            $folder = '/uploads/images/';

            $imageName = $this->uploadFile($image, $folder, 'public');

            $requestData['icon_path'] = $imageName;
        }



        $targetCategory->update($requestData);

        return back();
    }
}
