First Create A view:-
<form action="{{route('user.form')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="name"> Name : </label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email"> Email : </label>
        <input type="text" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password"> Password : </label>
        <input type="text" name="password" id="password" class="form-control">
    </div>
    <input type="submit" class="btn btn-success">
</form>

Now go to route web.php
and call view
now create a route on web.php for form submit
Route::get('/',[UserController::class,'index']);
Route::post('User-Form',[UserController::class,'userForm'])->name('user.form');

Now go to normal controller:-
first import api controller like.
use App\Http\Controllers\Api\ApiController as Api;
public function index()
{
    return view('home');
}
public function userForm(Request $request)
{
    $res=(new Api)->user($request);  //here user is a function on ApiController
    return $res;
}

Now go to ApiController:
public function user($request)
{
    // return $request;
    // return "Api Call";
}
