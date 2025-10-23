<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UppgiftRepo;
use Illuminate\Http\Request;
use App\Models\Uppgift;
use Illuminate\Support\Facades\Log;

class TodoAPiController extends Controller {
    public function __construct(private uppgiftRepo $repo) {

    }

    public function all() {
        $lista = $this -> repo -> all();
        return response() -> json (['todo' => $lista]);
    }

    public function get(Request $request) {
        $item = $this -> repo -> get($request -> route('id'));
        return response() -> json(['todo' => $item]);
    }

    public function add(Request $request) {
        $text = $request -> input ('uppgift');
        $uppgift = Uppgift::factory() -> make(['text' => $text, 'done' => false]);

        $this -> repo -> add($uppgift);
        return response() -> json(['todo' => $uppgift], 201);

    }
    
    public function update(Request $request, $id) {
        $id = filter_var($id, FILTER_VALIDATE_INT); // Hämta id från URL
        $uppgift = $this -> repo -> get($id);

        $uppgift -> text = $request -> input('uppgift');
        $uppgift -> done = $request -> input('done', $uppgift -> done);

        $this -> repo -> update($uppgift);

        return response()->json(['todo' => $uppgift]);
    }

    public function check(Request $request, $id) {
        $id = filter_var($request -> route('id'), FILTER_VALIDATE_INT); // Hämta id från URL
        $uppgift = $this->repo->get($id);

        $uppgift -> done = !$uppgift -> done;
        $this->repo->update($uppgift);

        return response()->json(['todo' => $uppgift]);
    }

    public function remove(Request $request, $id) {
        $id = filter_var($request ->input('id'), FILTER_VALIDATE_INT); // Hämta id från URL

        $this->repo->delete($id);
        return response()->json([null, 204]);
    }
}