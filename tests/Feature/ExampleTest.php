<?php

namespace Tests\Feature;

use App\Admin;
use App\Client;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
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
}
