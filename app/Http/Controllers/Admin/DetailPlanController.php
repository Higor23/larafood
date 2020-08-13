<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPlan;
use App\Models\Plan;

class DetailPlanController extends Controller
{
    protected $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
        
    }

    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }
        return view('admin.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }


    public function store(Request $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

            //$data = $request->all();
            //$data['plan_id'] = $plan->id
            // $this->repository->create($request->all());

            $plan->details()->create($request->all());
        
            return redirect()->route('details.plan.index', $plan->url);

        
    }
}
