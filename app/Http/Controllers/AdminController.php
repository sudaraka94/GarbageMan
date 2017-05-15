<?php

namespace App\Http\Controllers;
use App\Area;
use App\Client;
use App\Council;
use App\Truck;
use App\UserComplaint;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function get_all_complaints(){
        $complaints=UserComplaint::get();
        return view('admin.view_user_complaints')->with('complaints',$complaints);
    }

    public function manage_users(){
        $users=User::get();
        return view('admin.manage_users')->with('users',$users);
    }

    public function get_edit_user(Request $request){
        $user=User::where('id',$request->id)->get()->first();
        return view('auth.register')->with('edit',true)->with('admin',true)->with('user',$user);
    }
    
    public function edit_user(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'required|string|min:6|confirmed',
        ]);
            $user=User::where('id',$request->id)->get()->first();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->type=$request->type;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->route('manage_users');
    }

    public function delete_user(Request $request){
        $user=User::where('id',$request->id)->get()->first();
        $user->delete();
        return redirect()->route('manage_users');
    }

    public function add_user(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->type=$request->type;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->route('manage_users');
    }

    public function get_add_user(){
        return view('auth.register')->with('admin',true);
    }

    public function get_add_collection_point(){
        $users=User::where('type',"USER")->get();
        $council=Council::get()->first();
        $areas=Area::get();
        return view('admin.add_collection_point')->with('users',$users)->with('areas',$areas)->with('council',$council);
    }

    public function add_collection_point(Request $request){
        $this->validate($request, [
            'email' => 'required|string|email|max:255|exists:users,email',
            'address' => 'required|string|min:6',
            'area' => 'required',
            'lat_in' => 'required|string',
            'lng_in' => 'required|string',
        ]);
        $client=new Client();
        $user=User::where('email',$request->email)->first();
        $client->user_id=$user->id;
        $client->address=$request->address;
        $client->area_id=$request->area;
        $client->lat_in=$request->lat_in;
        $client->lng_in=$request->lng_in;
        $client->save();
        return redirect()->route('manage_collection_points');
    }
    
    public function view_route($area){
        return 'ok';
        $clients=$area->client;
        return view('admin.view_route')->with('clients',$clients);
    }

    public function edit_council_pos(){
        $council=Council::get()->first();
        return view('admin.edit_council')->with('council',$council);
    }

    public function edit_council_pos_post(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'lat_in' => 'required|string',
            'lng_in' => 'required|string',
        ]);
        $council=Council::where('id',$request->id)->get()->first();
        $council->name=$request->name;
        $council->lat_in=$request->lat_in;
        $council->lng_in=$request->lng_in;
        $council->save();
        return redirect()->route('home');
    }
    
    public function manage_areas(){
        $areas=Area::get();
        return view('admin.manage_areas')->with('areas',$areas);
    }

    public function add_area()
    {
        return view('admin.add_area');

    }

    public function post_add_area(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        $area=new Area();
        $area->name=$request->name;
        $area->council_id=1;
        $area->save();
        return redirect()->route('manage_areas');
    }

    public function get_edit_area(Request $request)
    {
        $area=Area::where('id',$request->id)->first();
        return view('admin.add_area')->with('edit',true)->with('area',$area);
    }

    public function edit_area(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        $area=Area::where('id',$request->id)->first();
        $area->name=$request->name;
        $area->council_id=1;
        $area->save();
        return redirect()->route('manage_areas');
    }

    public function delete_area(Request $request)
    {
        $area=Area::where('id',$request->id)->first();
        $area->delete();
        return redirect()->route('manage_areas');
    }


    //methods for client management
    public function manage_collection_points(){
        $clients=Client::get();
        return view('admin.manage_collection_points')->with('clients',$clients);
    }

    public function get_edit_collection_point(Request $request)
    {
        $areas=Area::get();
        $users=User::where('type',"USER")->get();
        $client=Client::where('id',$request->id)->first();
        return view('admin.add_collection_point')->with('areas',$areas)->with('edit',true)->with('client',$client)->with('users',$users);
    }

    public function edit_collection_point(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|exists:users,email',
            'address' => 'required|string|min:6',
            'area' => 'required',
            'lat_in' => 'required|string',
            'lng_in' => 'required|string',
        ]);
        $client=Client::where('id',$request->id)->get()->first();
        $user=User::where('email',$request->email)->first();
        $client->user_id=$user->id;
        $client->address=$request->address;
        $client->area_id=$request->area;
        $client->lat_in=$request->lat_in;
        $client->lng_in=$request->lng_in;
        $client->save();
        return redirect()->route('manage_collection_points');
    }

    public function delete_collection_point(Request $request)
    {
        $client=Client::where('id',$request->id)->first();
        $client->delete();
        return redirect()->route('manage_collection_points');
    }


//    methods for truck managemant
    public function manage_trucks(){
        $trucks=Truck::get();
        return view('admin.manage_trucks')->with('trucks',$trucks);
    }

    public function add_truck()
    {
        return view('admin.add_truck');

    }

    public function post_add_truck(Request $request)
    {
        $this->validate($request, [
            'registration_no' => 'required|string|max:255',
        ]);
        $truck=new Truck();
        $truck->registration_no=$request->registration_no;
        $truck->council_id=1;
        $truck->save();
        return redirect()->route('manage_trucks');
    }

    public function get_edit_truck(Request $request)
    {
        $truck=Truck::where('id',$request->id)->first();
        return view('admin.add_truck')->with('edit',true)->with('truck',$truck);
    }

    public function edit_truck(Request $request)
    {
        $this->validate($request, [
            'registration_no' => 'required|string|max:255',
        ]);
        $truck=Truck::where('id',$request->id)->first();
        $truck->registration_no=$request->registration_no;
        $truck->council_id=1;
        $truck->save();
        return redirect()->route('manage_trucks');
    }

    public function delete_truck(Request $request)
    {
        $truck=Truck::where('id',$request->id)->first();
        $truck->delete();
        return redirect()->route('manage_trucks');
    }

    public function view_suggestions()
    {
        $areas=$this->area_suggestion();
        $trucks=Truck::get();
        return view('admin.route_list')->with('areas',$areas)->with('trucks',$trucks);
    }

    public function view_path($area_id)
    {
        $area=Area::where('id',$area_id)->first();
        $clients=$area->get_active_points();
        return view('admin.view_route')->with('clients',$clients);

    }

    //this is the implementation of the area suggestion algorythem. THis algorithem is the key feature of the whole system
    public function area_suggestion()
    {
        $truck_count= count(Truck::get()); //gets the number of trucks
        $areas = Area::get(); //gets all the areas in the council
        $chosen_areas=[]; //areas chosen for collecting garbage
        if(count($areas)==0){
            return null;
        }
        for ($i=0 ; $i<$truck_count ;$i++){
            $max_weight=0;
            $temp_chosen=$areas[0];
            foreach ($areas as $area){  
                if ($temp_chosen==null){
                    $temp_chosen=$area;
                }
                elseif($area->get_garbage_amount()>$max_weight){
                    $max_weight=$area->get_garbage_amount();
                    $temp_chosen=$area;
                }
            }
            if($max_weight!=0) {
                array_push($chosen_areas, $temp_chosen);
                $areas->keyBy('id');
                $key=$temp_chosen->id;
                $areas=$areas->except($key);
            }
        }
        return $chosen_areas;
    }
}
