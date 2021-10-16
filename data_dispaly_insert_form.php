jaha se insert form call ho raha hai usi function me deta fetch ka v query write karenge or pass karenge
data milege to data display karega nahi to blank form rahega

on view:-
<a href="/empform/{{$list->eid}}" class="btn btn-info">View</a>

sabse pahle route me 
Route::get('/empform/{id?}',[EmpController::class,'empform'])->name('empform');

on controlller:-
public function empform($id='')
{
  $data=DB::table('emp_detail')->where('eid',$id)->get();
  return view('empform',["data"=>$data]);
}

if you use first function for get data:-
@if(!empty($data)) value="{{$data->name}}" @endif

if you use get function for get data:-
<input type="text" name="name" @if(!empty($data[0]->name)) value="{{$data[0]->name}}" @endif class="form-control">
