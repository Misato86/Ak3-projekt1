<?php
namespace App\Http\Controllers;

//use app\Http\Controllers\Controller;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TodoController extends Controller {

    public function __construct(private UppgiftRepo $repo) {
        //
    }

    function show()
    {
        //$lista = ['Cykla', 'Sova', 'Andas', 'Äta'];
        $lista = $this -> repo -> all();
        return View::make('todo', ['lista' => $lista]);
    }

    function add(Request $request)
    {
        //Läs från formuläret
        $text = $request -> get('uppgift');
        $uppgift = Uppgift::factory() -> make (['text' => $text, 'done' => false]);

        //Spara uppgiften
        $this -> repo -> add($uppgift);

        //Läs hela förvaret
        $lista = $this -> repo -> all();
        return View::make('todo', ['lista' => $lista]);
    }
    function remove(Request $request) {
        $id = $request -> get('uppgift');
        $this -> repo -> delete($id);

        //Läs hela förvaret
        $lista = $this -> repo -> all();

        return View::make('todo', ['lista' => $lista]);
    }
    function check(Request $request) { 
        $id = $request -> get('uppgift');
        $uppgift = $this -> repo -> get($id);
        $uppgift -> done = !$uppgift -> done;
        $this -> repo -> update($uppgift);

        //Läs hela förvaret
        $lista = $this -> repo -> all();
        return View::make('todo', ['lista' => $lista]);
    
    }
}

