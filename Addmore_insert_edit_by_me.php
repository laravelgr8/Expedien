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












With File:-
Controller:-
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

		$destinationPath = public_path() . '/image/';

    		$Document_FileName = '';
		$File_Uploaded_Status = 0;
		if (!empty($request->file('pic')[$key]) && array_key_exists($key, $request->file('pic')) ) 
		{
			if ($request->hasFile('pic')) 
			{
				$file = $request->file('pic')[$key];
				$fileName = time() . '-' . $file->getClientOriginalName();
				$file->move($destinationPath, $fileName);
				$Document_FileName = $fileName;
			}
		} 
		else 
		{
			$Document_FileName = $request->pic_[$key];
		}

		if(empty($data))
		{
			DB::table('logins')->insert([
				"name" => $value,
				"pic"=>$Document_FileName
			]);
		}
		else
		{
			DB::table('logins')->where('id',$id)->update([
				"name" => $value,
				"pic"=>$Document_FileName
			]);
		}

	}
	return redirect()->route('index');
}


On View:-
<div class="container">
	<div class="col-xl-6">
		<form action="/insert" method="post" enctype="multipart/form-data">
			@csrf
			<div class="btn btn-info" id="add" style='float:right;'>Add</div>
			<table class="table table-borderless" id="myid">
				@foreach($data as $key => $list)
				<tr>
					<input type="hidden" name="id[]" value="{{$list->id ?? ''}}">
					<td><input type="text" name="name[]" id="name" value="{{@$list->name ?? ''}}" class="form-control"></td>
					<td><input type="file" name="pic[]" id="pic" class="form-control"></td>
					<input type="hidden" name="pic_[]" value="{{ @$list->pic ?? ''}}">
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
		$("#myid").append('<tr row="id'+i+'"><td><input type="text" name="name[]" id="name" class="form-control"></td><td><input type="file" name="pic[]" id="email" class="form-control"></td><td>X</td></tr>');
	});
});
</script>
