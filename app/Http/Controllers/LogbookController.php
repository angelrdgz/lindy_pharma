<?php

namespace App\Http\Controllers;

use Request;

use App\Logbook;

use Mail;
use Input;

class LogbookController extends Controller
{
    public function index()
    {
        $date = Request::query('date', false);
        if ($date){
            $logbooks = Logbook::whereRaw('DATE(created_at) = "' . date('Y-m-d', strtotime($_GET['date'])) . '"')->get();
        } else {
            $logbooks = Logbook::whereRaw('DATE(created_at) = "' . date('Y-m-d') . '"')->get();
        }
        return view('logbook.index', ["logbooks" => $logbooks]);
    }
}
