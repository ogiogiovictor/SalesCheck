<?php

namespace App\Service;

use App\Models\User;
use App\Models\Companies\Company;
use App\Helpers\UniqueNo;
use Illuminate\Support\Facades\DB;
use App\Enums\CompanyStatusEnum;

class CompanyService
{

   // protected ?User $user;
    protected array $services = [];
    protected string $company_name;
    protected string $company_address;
    protected ?string $company_phone;
    protected ?string $no_of_staff;
    protected ?string $about_company;
    protected ?string $admin_name;
    protected ?string $admin_email;
    protected ?string $admin_user;
    protected ?string $RC_number;
    protected ?string $company_email;


    public function create(): Company
    {

      $company = Company::create([
        'company_uuid' => (new UniqueNo)->generate(fn($companyNo) => DB::table('companies')->select('company_uuid', $companyNo)->exists(), 12, true, 'CP' ),
        'company_name' => optional($this->company_name),
        'company_phone' => optional($this->company_phone),
        'company_address' => optional($this->company_address),
        'company_email' => optional($this->company_email),
        'RC_number' => optional($this->RC_number),
        'no_of_staff' => $this->no_of_staff,
        'about_company' => $this->about_company,
        'services' => $this->services,
        'admin_name' => $this->admin_name,
        'admin_email' => $this->admin_email,
        'admin_user' => $this->admin_user,
        'status' => CompanyStatusEnum::Inactive,
        //'logo' => $this->logo,

      ]);

      return $company;

    }


    /* public function setUser(?User $user = null): self
    {
        $this->user = $user;
        return $this;
    }
*/
    public function setCompanyName(?string $company_name = null): self
    {
        $this->company_name = $company_name;
        return $this;
    }

    public function setCompanyAddress(?string $company_address = null): self
    {
        $this->company_address = $company_address;
        return $this;
    }

    public function setCompanyEmail(?string $company_email = null): self
    {
        $this->company_email = $company_email;
        return $this;
    }

    public function setCompanyPhone(?string $company_phone = null): self
    {
        $this->company_phone = $company_phone;
        return $this;
    }

    public function setStaff(?string $no_of_staff = null): self
    {
        $this->no_of_staff = $no_of_staff;
        return $this;
    }

    public function setAbout(?string $about_company = null): self
    {
        $this->about_company = $about_company;
        return $this;
    }

    public function setService(?array $services = []): self
    {
        $this->services = $services;
        return $this;
    }


    public function setAdminName(?string $admin_name = null): self
    {
        $this->admin_name = $admin_name;
        return $this;
    }

    public function setAdminEmail(?string $admin_email = null): self
    {
        $this->admin_email = $admin_email;
        return $this;
    }

    public function setAdminUser(?string $admin_user = null): self
    {
        $this->admin_user = $admin_user;
        return $this;
    }

    public function setRCNumber(?string $RC_number = null): self
    {
        $this->RC_number = $RC_number;
        return $this;
    }


}