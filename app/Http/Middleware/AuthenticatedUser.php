<?php
namespace App\Http\Middleware;

use App\Repositories\Interfaces\UserRepo;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Support\Facades\View;

class AuthenticatedUser {
    public function __construct(private UserRepo $repo) {

    }
    public function handle($request, \Closure $next) {
        if(!$request -> session() -> has('user_id')) {
            //Användaren är inte inloggad, redirecta till login sidan
            return redirect('/login');
        }
        //Hämta användare
        $user = $this -> repo -> get($request -> session() -> get('user_id'));
        if(!$user) {
            throw new BadRequestException('User not found in database');
        }

        //Skicka med användaren i requesten
        $request -> setUserResolver(fn() => $user);
        // Dela användaren med alla vyer så blade alltid har $me
        View::share('me', $user);
        return $next($request);
    }
}