<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $member_count = User::where('role','!=',1)->where('name','!=','Marif Akter')->count();
        $debutante_membership_count = Member::count();
        // dd($member_count,$debutante_membership_count);
        return view('backend.home',compact('member_count','debutante_membership_count'));
    }

    public function blank()
    {
        return view('backend.blank');
    }
}
