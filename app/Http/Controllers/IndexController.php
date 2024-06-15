<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class IndexController extends Controller
{
    public function index(){
        // return Inertia::render(
        //     'index'
        // );
        return inertia('Index/index',[
            'message' => 'Give Me Massage'
        ]);

    }
    public function show(){
        return inertia('Index/show',);
    }
}
