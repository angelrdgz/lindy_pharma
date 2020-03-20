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
            $logbooks = Logbook::whereRaw('DATE(created_at) = "' . date('Y-m-d', strtotime($_GET['date'])) . '"')->orderBy('created_at', 'DESC')->get();
        } else {
            $logbooks = Logbook::whereRaw('DATE(created_at) = "' . date('Y-m-d') . '"')->orderBy('created_at', 'DESC')->get();
        }
        return view('logbook.index', ["logbooks" => $logbooks]);
    }

    public function export()
    {
        $csvExporter = new \Laracsv\Export();
        $users = Logbook::whereRaw('DATE(created_at) = "2020-02-27"')->orderBy('created_at', 'DESC')->get();

        // Register the hook before building
        $csvExporter->beforeEach(function ($user) {
            $user->type_id = $user->type->name;
            $user->user_id = $user->user->name;
        });

        $csvExporter->build($users, ['title'=>'Titulo', 'type_id'=>'Tipo','user_id'=>'Responsable', 'content'=>'Descripción','created_at'=>'Fecha y Hora'])->download('bitacora_'.date('d_m_Y').'.csv');
    }
}
