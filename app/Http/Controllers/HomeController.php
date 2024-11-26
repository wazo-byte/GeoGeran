<?php

namespace App\Http\Controllers;

use App\Models\GeoLocation;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function admin_dashboard(){

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->paginate(10);

        if(!empty($users) && count($users) > 0){

            return view('admin.dashboard')->with('users', $users);

        }
        else{

            $users = '0';

            return view('admin.dashboard')->with('users', $users);

        }

    }

    //
    public function user_dashboard()
    {
        
        $user = Auth::user();

        $get_list = GeoLocation::where('user_id', $user->id)->paginate(10);

        if(!empty($get_list) && count($get_list) > 0){

            return view('user.dashboard')->with('lists', $get_list);

        }
        else{

            $get_list = '0';

            return view('user.dashboard')->with('lists', $get_list);

        }

    }

    public function admin_delete_user(Request $request){

        $request->validate([
            'id' => 'required',
        ]);

        $find_user = User::findOrFail($request->id);

        if(!empty($find_user)){

            $find_location = GeoLocation::where('user_id', $find_user->id)->get();

            if(!empty($find_location) && count($find_location) > 0){

                foreach($find_location as $location){

                    $location->delete();

                }

            }

            $find_user->delete();

            return redirect()->back()->with('success', 'Berjaya padam pengguna.');

        }
        else{

            return redirect()->back()->with('error', 'Gagal padam pengguna.');

        }

    }

}
