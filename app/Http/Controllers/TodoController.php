<?php
namespace App\Http\Controllers;

//use app\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TodoController extends Controller {
    function show()
    {
        $lista = ['Cykla', 'Sova', 'Andas', 'Äta'];
        return View::make('todo', ['lista' => $lista]);
    }

    function add(Request $request)
    {
        $lista = json_decode($request -> get('lista'));
        if (!in_array($request -> get('uppgift'), $lista)) {
            $lista[] = $request -> get('uppgift');
        }
        $lista[] = $request -> get('uppgift');

        return View::make('todo', ['lista' => $lista]);
    }
    function remove(Request $request) {
        $lista = json_decode($request -> get('lista'));
        $lista = array_values(array_diff($lista, [$request -> get('uppgift')]));

        return View::make('todo', ['lista' => $lista]);
    }
}

