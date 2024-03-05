<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Plan\StoreRequest;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {

            $plans = SubscriptionPlan::orderBy('created_at', 'desc')->paginate(20);
            return Inertia::render('Admin/SubscriptionPlans/Index', compact('plans'));

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/SubscriptionPlans/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        try {

            $data = $request->validated();

            $data['features'] = json_encode($data['features']);

            SubscriptionPlan::create($data);

            return redirect()->route('plans.index')->with('success', 'Plan created successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        try {

            $plans = SubscriptionPlan::all();

            return Inertia::render('SubscriptionPlans', compact('plans'));

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $plan)
    {
        return Inertia::render('Admin/SubscriptionPlans/Edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, SubscriptionPlan $plan)
    {

        try {

            $data = $request->validated();

            $data['features'] = json_encode((Object)$data['features']);

            $plan->update($data);

            return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');


        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPlan $plan)
    {
        try {

            $plan->delete();
            return redirect()->route('plans.index')->with('success', 'Plans deleted successfully.');

        } catch (\Exception $ex) {

            $message = 'Error en el método' . __METHOD__ . ' / ' . $ex;
            Log::error($message);
            return false;

        }
    }
}
