<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use App\Teammember;

class ApiController extends Controller
{
    public function listdata()
    {
    	return Paket::with('jenis')->get();
    }
}
