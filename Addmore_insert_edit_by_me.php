<div class="container">
	<div class="col-xl-6">
		<form action="/insert" method="post">
			@csrf
			<div class="btn btn-info" id="add" style='float:right;'>Add</div>
			<table class="table table-borderless" id="myid">
				@foreach($data as $key => $list)
				<tr>
					<input type="hidden" name="id[]" value="{{$list->id ?? ''}}">
					<td><input type="text" name="name[]" id="name" value="{{@$list->name ?? ''}}" class="form-control"></td>
					<td><input type="text" name="email[]" id="email" value="{{@$list->email ?? ''}}" class="form-control"></td>
					<td></td>
				</tr>
				@endforeach
			</table>
			<input type="hidden" name="count" id="count" value="{{@$key ?? ''}}">
			<input type="submit" class="btn btn-info">
		</form>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script>
$(document).ready(function(){
	var i=$("#count").val();
	$("#add").click(function(){
		i++;
		$("#myid").append('<tr row="id'+i+'"><td><input type="text" name="name[]" id="name" class="form-control"></td><td><input type="text" name="email[]" id="email" class="form-control"></td><td>X</td></tr>');
	});
});
</script>






public function index()
{
	$data=DB::table('logins')->get();
	return view('home',compact('data'));
}

public function insert(Request $request)
{
	foreach($request->name as $key => $value)
	{	
		@$id=$request->id[$key] ?? '';
		@$data=DB::table('logins')->select('id')->where('id',$id)->first();
		if(empty(@$data))
		{
			DB::table('logins')->insert([
				"name" =>$value,
				"email"=>$request->email[$key]
			]);
		}
		else
		{
			DB::table('logins')->where('id',$id)->update([
				"name" => $value,
				"email" => $request->email[$key]
			]);
		}
	}
	return redirect()->route('index');
}
