<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\CompanyRequest;
use App\Models\User;
use App\Service\CompanyService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends BaseAPIController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request, User $user)
    {
        try{

            DB::beginTransaction();

            $addCompany = (new CompanyService)->setCompanyName($request->company_name)
                ->setCompanyAddress($request->company_address)
                ->setCompanyEmail($request->company_email)
                ->setCompanyPhone($request->company_phone)
                ->setStaff($request->no_of_staff)
                ->setAbout($request->about_company)
                ->setService($request->services)
                ->setAdminName($request->admin_name)
                ->setAdminEmail($request->admin_email)
                ->setAdminUser($request->admin_user)
                ->setRCNumber($request->RC_number)
                ->create();

         
            //Update Logo if Exist

            //Send Notification to Email if Exist as job Queue that company successfully registered

            //Add Observer to Send Notification for company to be activated

            DB::commit();

            return $this->error($addCompany, "Company Successfully Added", Response::HTTP_OK);

        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), "ERROR!", Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
