<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patients\PatientRequest;
use App\Patient;
use App\Http\Resources\Patients\Patient as PatientResource;
use App\Http\Resources\Patients\PatientCollection;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patients;

    public function __construct(Patient $patients) {
        $this->patients = $patients;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            new PatientCollection(
                $this->patients->orderBy('id','desc')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(PatientRequest $request): JsonResponse
    {
        $request->merge(['birthday' => Carbon::parse($request->birthday)]);

        $patients = $this->patients->create($request->all());
        return response()->json(new PatientResource($patients), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
