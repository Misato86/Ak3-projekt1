<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UppgiftRepo;

class TodoAPiController extends Controller {
    public function __construct(private uppgiftRepo $repo) {

    }

    public function all() {
        $lista = $this -> repo -> all();
        return response() -> json (['todo' => $lista]);
    }
}