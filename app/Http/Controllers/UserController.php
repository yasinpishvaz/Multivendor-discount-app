<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\City;
use App\Models\Category;


class UserController extends Controller
{

    //show the form for editing the specified user
    public function edit()
    {
        $user = User::FindOrFail(Auth::id());
        return view('front.edit', compact('user'));
    }

    //update the specified user
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id),],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:11']
        ]);

        $request->merge(['password' => Hash::make($request->password)]);
        Auth::user()->update($request->all());

        return back()->with('message', 'Profile Updated');
    }

    public function merchantSignup()
    {
        $category = new Category();
        $cities = City::getAll();
        $categories = $category->mainCategories();
        return view('merchant.auth.register', compact('cities', 'categories'));
    }

    public function storeMerchant(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users'),],
            'phone' => ['required', 'numeric', 'min:11', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'category' => ['required', 'not_in:0'],
            'city' =>  ['required', 'not_in:0']
        ]);


        $role = 'merchant';

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => bcrypt($request['password']),
            'role' => $role,
            'city_id' => $request['city'],
            'category_id' =>  $request['category']
        ]);

        Auth::login($user);

        return redirect('/merchant/panel/editprofile');
    }


    //show the form for editing the specified merchant
    public function merchanteEdit()
    {
        $user = User::FindOrFail(Auth::id());
        return view('merchant.edit', compact('user'));
    }


    //  public function merchantEdit()
    //  {
    //     $category = new Category();
    //     $categories = $category->mainCategories();
    //     $selectedCategory = Category::findOrFail(1);
    //      return view('merchant.edit', compact('categories', 'selectedCategory'));
    //  }



    // admin

    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('back.users.index', compact('users'));
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 2;
        $user->update();

        return back();
    }

    public function activeBlockedUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->update();

        return back();
    }

}
