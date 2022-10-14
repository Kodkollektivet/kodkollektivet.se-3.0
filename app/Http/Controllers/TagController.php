<?php

namespace App\Http\Controllers;


class TagController extends Controller
{
    
    public function tagNames() {
        return \App\Models\Tag::all()->pluck('name');
    }

}
