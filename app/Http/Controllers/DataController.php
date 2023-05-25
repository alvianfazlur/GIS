<?php
namespace   App\Http\Controllers;

use App\Models\data_penganggur;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller{
    public function data()
    {
        $data = data_penganggur::all();
        // dd($data);
        return view('data', compact('data'));
    }

}
