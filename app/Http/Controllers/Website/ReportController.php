<?php

namespace App\Http\Controllers\Website;

use Illuminate\Support\Facades\DB;
use Redirect;
use App\Http\Requests;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportController extends WebsiteController
{
    /**
     * @return Response
     */
    public function index()
    {
    //    $report = Report::where('ls_id', 164)->orderBy('datum')->get()->toArray();
        
        $report = DB::table('isha_spielplan')
            ->leftJoin('isha_playgrounds', 'isha_spielplan.playground_id', '=', 'isha_playgrounds.id')
              ->where('ls_id', 164)
              ->orderBy('datum')
             ->get();
              //  ->toArray();
        //print_r($report);die;
        return $this->view('reports.index')
            ->with('items', $report);
    }


}
