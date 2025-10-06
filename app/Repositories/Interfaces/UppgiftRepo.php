<?php

namespace App\Repositories\Interfaces;
use App\Models\Uppgift;

interface UppgiftRepo {
    /**
     * Returnerar alla uppgifter
     *
     * @return Uppgift[]
     */
    public function all():array;
    /**
     * Returnerar en uppgift med angivet id
     * @param string $id
     * @return Uppgift|null
     *  
     */
    public function get(string $id): ?Uppgift;
    /**
     * Skapar en ny uppgift
     * @param Uppgift $uppgift
     * @return Uppgift
     */
    public function add(Uppgift $uppgift): Void;
    /**
     * Uppdaterar en uppgift
     * @param Uppgift $uppgift
     * @return Void
     */
    public function update(Uppgift $uppgift): Void;
    
    public function delete(string $id): Void;

}
