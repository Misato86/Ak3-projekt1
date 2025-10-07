<?php

namespace App\Repositories\Implementations;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;
use App\Storage\JsonDbConnection;
use App\Storage\JsonFileHandler;


class JsonUppgiftRepo implements UppgiftRepo {

    private array $lista = [];
    private $path;

    public function __construct(JsonDbConnection $dbConnection) {
        $this -> path = new JsonFileHandler('uppgifter', $dbConnection);
        //Läs hela filen
        $content = $this -> path -> read();  
        //Skapa uppgift objekt för varje uppgiftobjekt från filen
        foreach ($content as $item) {
            $this->lista[$item['id']] = new Uppgift($item);
        }
    }
    /**
     * Returnerar alla uppgifter
     *
     * @inheritDoc
     */
    public function all(): array {
        return $this -> lista;
     }
    /**
     * @inheritDoc
     */

    public function get(string $id):?Uppgift {
        return isset($this->lista[$id]) ? $this -> lista[$id] : null;
    }
    /**
     * @inheritDoc
     */
    public function add(Uppgift $uppgift): Void {
        if($uppgift -> id === 0) {
            $ids = array_keys($this -> lista);
            $nextid = empty($ids) ? 1 : max($ids) + 1;
            $uppgift -> id = $nextid;
        }

        $this -> lista[$uppgift -> id] = $uppgift;
        $this -> path -> write($this -> lista);
    }
    /**
     * @inheritDoc
     */
    public function update(Uppgift $uppgift): void {
        $this -> add($uppgift);

    }
    /**
     * @inheritDoc
     */
    public function delete(string $id): void {
        unset($this -> lista[$id]);
        $this -> path -> write($this -> lista);
    }
}

