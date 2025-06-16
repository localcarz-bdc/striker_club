<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCardController extends Controller
{
    public function index()
    {
       return view('backend.card.card-page');
    }
}
