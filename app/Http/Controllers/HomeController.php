<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::check('be-admin')) {
            return redirect(route('admin.index'));
        }
        else if (Gate::check('be-teacher'))
        {
            return redirect(route('teacher.index'));
        }
        else if (Gate::check('be-student'))
        {
            return redirect(route('student.index'));
        }
        else
        {
            return view('home');
        }
    }
}
