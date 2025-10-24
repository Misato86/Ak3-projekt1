<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\UserRepo;

class UserController extends Controller {

    public function __construct(private UserRepo $repo) {

    }

    function show(Request $request) {
        $lista = $this -> repo -> all();

        // Hämta inloggad användare
        $me = $request -> user();

        return View::make('user', ['lista' => $lista, 'me' => $me]);
    }

    public function showUser(Request $request) {
        $id = $request -> route('id');
        $user = $this -> repo -> get($id);
        
        // Hämta inloggad användare
        $me = $request->user();
        if ($me->admin || isset($user) && $me->id == $user->id) {
            return View::make('user', ['user' => $user, 'me' => $me]);
        }

        else {
            // Aja baja!
            return View::make('ajabaja');
        }
    }

    function add (Request $request) {
        //Bara admin ska kunna lägga till användare
        $me = $request -> user ();
        if (!$me -> admin) {
            return View::make('ajabaja');
        }
        $user = User::factory() -> make ($request -> request -> all());
        $this -> repo -> add($user);
        return redirect('/anvandare');        
    }

    public function modifyUser(Request $request) {
        $me = $request->user();
        $id = $request -> route ('id');

        //Bara admin får radera men inte sig själv
        if($request -> request -> has('delete') && ($id == $me -> id || !$me -> admin)) {
            return View::make('ajabaja');
        } 
        //kontrollera för uppdateringsrättigheter
        if($id != $request -> request -> get('id')) {
            return View::make('ajabaja');
        }

        //Allt ok
        if($request -> request -> has('delete')) {
            $this -> repo -> delete($id);
        } else {
            $user = $this -> repo -> get($id);
            $user -> fill($request -> request -> all());
            if(!$me -> admin) {
                $user -> admin =0;
            }
                
            $this -> repo -> update($user);
        }
        return redirect('anvandare');
    }

}