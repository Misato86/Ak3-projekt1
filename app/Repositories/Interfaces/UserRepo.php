<?php

namespace App\Repositories\Interfaces;
use App\Models\User;

interface UserRepo {
    /**
     * Returnerar alla Userer
     *
     * @return User[]
     */
    public function all():array;
    /**
     * Returnerar en User med angivet id
     * @param string $id
     * @return User|null
     *  
     */
    public function get(string $id): ?User;
    /**
     * Skapar en ny User
     * @param User $User
     * @return User
     */
    public function add(User $User): Void;
    /**
     * Uppdaterar en User
     * @param User $user
     * @return Void
     */
    public function update(User $user): Void;
    /**
     * @param string $id
     * @return void
     */


    public function delete(string $id): Void;
    /**
     * 
     * 
     */


    public function getuserByEmail(string $email):?User;

    /**
     * 
     * 
     */
}
