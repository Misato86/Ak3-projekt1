<?php

namespace App\Repositories\Implementations;

use App\Models\Uppgift;
use App\Repositories\Interfaces\UppgiftRepo;


class JsonUppgiftRepo implements UppgiftRepo {

    private array $lista = [];
    private string $path= __DIR__ . '/../../../storage/app/uppgifter.json';

    public function __construct() {
        if (!file_exists($this->path)) {
            return;
        }
        //Läs hela filen
        $content = file_get_contents($this->path);
        // Gör om från sträng till Json-objekt 
        $json = json_decode($content, true) ?? [];
        
        //Skapa uppgift objekt för varje uppgiftobjekt från filen
        foreach ($json as $item) {
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
        file_put_contents($this -> path, json_encode(($this -> lista)));
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
        file_put_contents($this -> path, json_encode(($this -> lista)));
    }
}

