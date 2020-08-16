<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (auth('admin')->check()) {

            return redirect(route('admin.home'));

        }
        else if (auth('editor')->check()) {

            return redirect(route('editor.home'));
            
        }
        else if (auth('web')->check()) {

            return redirect(route('home'));
            
        }
        else if (auth('writer')->check()) {

            return redirect(route('writer.home'));
            
        }
        else {

            return view('welcome');;
            
        }
    }
}
