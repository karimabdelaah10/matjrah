<?php

namespace Tests\Feature;

use App\Modules\Users\Models\CompanyLoginStatistics;
use App\Modules\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function Couchbase\defaultDecoder;

class CompanyLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_login_page()
    {
        $subdomain ='company_name';  // subdomain example
        $company = User::where('subdomain' ,$subdomain)->company()->active()->first();
        $this->assertNotNull($company);
    }
    public function test_post_login_page()
    {
        $subdomain ='company_name';  // subdomain example
        $email ='email@gmail.com';  // subdomain example
        $company = User::where('subdomain' ,$subdomain)
            ->where('email',$email)
            ->company()
            ->active()
            ->first();
        $this->assertNotNull($company);
    }

}
