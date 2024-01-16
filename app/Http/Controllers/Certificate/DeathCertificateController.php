<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\DeathCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class DeathCertificateController extends Controller
{

    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['certificates'] = DeathCertificate::with('user')
        ->whereHas('user', function($q1){
            $q1->where('institute_id', Auth::user()->institute_id);
        })->latest()->get();
        return view('backend.pages.certificate.death.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::with('people')->where('status', true)->where('role_id', 5)->get();
        return view('backend.pages.certificate.death.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $result = DB::transaction(function () use ($request) {


                $certificate = new DeathCertificate();
                $certificate->user_id = $request->user_id;
                $certificate->date_of_death = $request->date_of_death;
                $certificate->created_by = Auth::id();
                $certificate->save();

                if ($certificate) {
                    $data['status'] = true;
                    $data['message'] = "Certificate generated successfully!";
                    $data['result'] = $certificate;
                    $data['code'] = 200;
                    $data['redirect_url'] = route('death.show', $request->user_id);
                    return $data;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Family comment save failed!";
                    $data['code'] = 500;
                    return $data;
                }
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\DeathCertificate  $deathCertificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::with('people', 'familyInfo', 'addressInfo')->find($id);
        return view('backend.pages.certificate.death.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\DeathCertificate  $deathCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(DeathCertificate $deathCertificate)
    {
        return view('backend.pages.certificate.death.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\DeathCertificate  $deathCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeathCertificate $deathCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\DeathCertificate  $deathCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeathCertificate $deathCertificate)
    {
        //
    }
}
