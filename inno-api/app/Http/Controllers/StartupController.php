<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StartupController extends Controller
{
    /**
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $query=$request->get('query','');
        $page=$request->get('page',1);
        $direction=$request->get('direction_id',false);
        $project_stage=$request->get('project_stage_id',false);
        $transport_type_id=$request->get('transport_type_id',false);
        $cert_type_id=$request->get('cert_type_id',false);

        $startups = Startup::search($query);

        if($direction) {
            $startups=$startups->where('directions.id',$direction);
        }
        if($project_stage) {
            $startups=$startups->where('project_stage_id',$project_stage);
        }
        if($transport_type_id) {
            $startups=$startups->where('transport_type_id',$transport_type_id);
        }
        if($cert_type_id) {
            $startups=$startups->where('cert_type_id',$cert_type_id);
        }
        $startups = $startups->paginate(10, 'page', $page);

        return [
           'items'=> $startups->items(),
            'current_page'=>$page,
            'total_page'=>$startups->lastPage(),
            'count'=>DB::table('startups')->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function show(Startup $startup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function edit(Startup $startup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startup $startup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startup $startup)
    {
        //
    }
}
