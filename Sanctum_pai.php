Laravel Sanctum:-

Install Laravel Sanctum.
composer require laravel/sanctum

Publish the Sanctum configuration and migration files .
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

Run your database migrations.
php artisan migrate


Add the Sanctum's middleware.
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

...

    protected $middlewareGroups = [
        ...

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    ...
],





To use tokens for users.
Go to user models
import
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
}



Let's create the seeder for the User model
php artisan make:seeder UsersTableSeeder


Now let's insert as record
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
...
...
DB::table('users')->insert([
    'name' => 'John Doe',
    'email' => 'john@doe.com',
    'password' => Hash::make('password')
]);


php artisan db:seed --class=UsersTableSeeder




create a controller nad /login route in the routes/api.php file:
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    // 

    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }
}





On route:-
Make Details API or any other with secure route
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    });
