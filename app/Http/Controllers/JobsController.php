<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::with('company')->get();
        return response()->json($jobs);
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
    public function store(Request $request, $id)
    {

        $jobType = JobType::find($request->job_type);

        Validator::make($request->all(), [
            'salary' => Rule::requiredIf($request->job_type == 2 || $request->job_type == 3),
            'start_time' => Rule::requiredIf($request->job_type == 2 || $request->job_type == 3),
            'exit_time' => Rule::requiredIf($request->job_type == 2 || $request->job_type == 3),
        ]);

        if($jobType == 2){

            if($request->salary < $jobType->min_salary){

                return response()->json([
                    'message'   => 'The salary value must be bigger than R$ 1212,00',
                ], 406);
            }
        }
        if($jobType == 3){

            $to = Carbon::createFromFormat('H:i', $request->start_time);
            $from = Carbon::createFromFormat('H:i', $request->exit_time);

            $diff_in_hours = $to->diffInHours($from);

            if($diff_in_hours > 6){
                return response()->json([
                    'message'   => 'Working hours cannot be more than 6 hours',
                ], 406);
            }
        }

        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $plan = Company::find($id)->plans;

        if($plan->name == 'P'){
            if($plan->number_of_jobs <= 10){
                $job = new Job();
                $job->fill($request->all());
                $job->company_id = $id;
                if( $job->save() ){
                    return response()->json([
                        "message" => "Job created",
                        "data" => $job
                    ], 201);
                }
            }else{
                return response()->json([
                    'message'   => 'You have reached the number of jobs to this plan',
                ], 404);
            }
        }else{
            if($plan->number_of_jobs <= 5){
                $job = new Job();
                $job->fill($request->all());
                $job->company_id = $id;
                if( $job->save() ){
                    return response()->json([
                        "message" => "Job created",
                        "data" => $job
                    ], 201);
                }
            }else{
                return response()->json([
                    'message'   => 'You have reached the number of jobs to this plan',
                ], 404);
            }
        }

        $job = new Job();
        $job->fill($request->all());
        $job->save();

        return response()->json($job, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::with('company')->find($id);

        if(!$job) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $jobType = JobType::find($request->job_type);

        Validator::make($request->all(), [
            'salary' => Rule::requiredIf($request->job_type == 2 || $request->job_type == 3),
            'start_time' => Rule::requiredIf($request->job_type == 2 || $request->job_type == 3),
            'exit_time' => Rule::requiredIf($request->job_type == 2 || $request->job_type == 3),
        ]);

        if($jobType == 2){

            if($request->salary < $jobType->min_salary){

                return response()->json([
                    'message'   => 'The salary value must be bigger than R$ 1212,00',
                ], 406);
            }
        }
        if($jobType == 3){

            $to = Carbon::createFromFormat('H:i', $request->start_time);
            $from = Carbon::createFromFormat('H:i', $request->exit_time);

            $diff_in_hours = $to->diffInHours($from);

            if($diff_in_hours > 6){
                return response()->json([
                    'message'   => 'Working hours cannot be more than 6 hours',
                ], 406);
            }
        }

        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $plan = Company::find($id)->plans;

        if($plan->name == 'P'){
            if($plan->number_of_jobs <= 10){
                $job = Job::find($id);
                $job->fill($request->all());
                $job->company_id = $id;
                if( $job->save() ){
                    return response()->json([
                        "message" => "Job updated",
                        "data" => $job
                    ], 201);
                }
            }else{
                return response()->json([
                    'message'   => 'You have reached the number of jobs to this plan',
                ], 404);
            }
        }else{
            if($plan->number_of_jobs <= 5){
                $job = Job::find($id);
                $job->fill($request->all());
                $job->company_id = $id;
                if( $job->save() ){
                    return response()->json([
                        "message" => "Job updated",
                        "data" => $job
                    ], 201);
                }
            }else{
                return response()->json([
                    'message'   => 'You have reached the number of jobs to this plan',
                ], 404);
            }
        }

        $job->save();

        return response()->json($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        if(!$job) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $job->delete();
    }
}
