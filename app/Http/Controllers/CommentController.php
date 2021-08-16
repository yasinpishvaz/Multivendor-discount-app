<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    

    public function store(Request $request)
    {
        $request->validate([
            'comment_text'  =>  ['required'],
            'product_id'  =>  ['required'],
            'product_id'  =>  ['required'],
        ]);     

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        Comment::create($input);

        return redirect()->back();
    }
}
