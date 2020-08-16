<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{

    protected $exceptData = [
        'id',
        'hash',
        'slug',
        'created_at',
        'updated_at'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan([
            'name' => '',
            "plan_identifier" => '',
            "limit_list" => 1,
            "limit_space" => 1000,
            "price" => 0
        ]);

        return view('plans.create', compact('plan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function delete(Plan $plan)
    {
        return view('plans.delete', compact('plan'));
    }

    public function api_index(Request $request)
    {
        $strKeywords = $request->input('q', null);
        
        $plans = Plan::ofKeywords($strKeywords)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return response()->json($plans);
    }

    public function api_store(PlanRequest $request)
    {
        $plan = Plan::create($request->except($this->exceptData));
        return response()->json($plan, 201);
    }

    public function api_show(Plan $plan)
    {
        return response()->json($plan);
    }

    public function api_update(PlanRequest $request, Plan $plan)
    {
        $plan->update($request->except($this->exceptData));
        return response()->json($plan, 200);
    }

    public function api_destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json(null, 204);
    }
}
