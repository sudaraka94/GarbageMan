<?php

namespace Tests\Feature;

use App\Admin;
use App\Client;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

//    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $this->assertTrue(true);
    }

    public function testAdmin()
    {
        $admin=User::where('type','ADMIN')->get();
        $count=$admin->count();
        $this->assertGreaterThan(0,$count);
    }

    public function create_user()
    {
        $req=new Request();
        $req->name="Dummy User";
        $req->email="dummy@dummy.com";
        $req->password=bcrypt('dummy123');
        AdminController::add_user($req);
        $user=User::where('email',$req->email)->get();
        $this->assertNotNull($user);
    }
//this deletes the user
    public function testCollectionPoint()
    {
        $req=new Request();
        $req->name="Piliyandala";
        $req->lat_in="2.000000";
        $req->lng_in="1.000000";
        $cntrl=new AdminController();
        $cntrl->edit_council_pos($req);
        $col_point=Client::where('user_id','1');
        $this->assertNotNull($col_point);
    }

//    this tests the homepage
    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
//this checks the login
    public function testLogin()
    {
        Auth::attempt(['email'=>'sudarakayasindu@gmail.com','password'=>'111111']);
        $this->assertTrue(Auth::check());
    }
    //this checks a fake login
    public function testFakeLogin()
    {
        Auth::attempt(['email'=>'fake@gmail.com','password'=>'fake123']);
        $this->assertNotTrue(Auth::check());
    }
//this checks the logout
    public function testLogout()
    {
        Auth::logout();
        $this->assertNotTrue(Auth::check());
    }
    
//    this checks the permissions for the application
    public function testPermission()
    {
        Auth::attempt(['email'=>'sudarakayasindu@gmail.com','password'=>'111111']);
        $response = $this->get('/add_garbage_record');
        $response->assertStatus(302);
    }

    public function testAdminPermission()
    {
        Auth::logout();
        Auth::attempt(['email'=>'vishaka@gmail.com','password'=>'111111']);
        $response = $this->get('/add_user');
        $response->assertStatus(302);
    }
}


