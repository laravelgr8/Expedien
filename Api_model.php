On Controller:-

Get data Api:-
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\login;
class ApiController extends Controller
{
   function fetchData()
   {
   		// $result=DB::table('logins')->get();
   		$result=login::fetchdata();
   		if(count($result) > 0)
   		{
   			$response["status"]=200;
   			$response["message"]="Student Record Found";
   			$temp=[];
   			foreach($result as $list)
   			{
   				$temp["id"]=$list->id;
   				$temp["name"]=$list->name;
   				$temp["email"]=$list->email;
   				$temp["mobile"]=$list->mobile;

   				$response["data"][]=$temp;
   			}
   		}
   		else
   		{
   			$response["status"]=400;
   			$response["message"]="data Not Found";
   		}
   		return json_encode($response);
		//return view('userhome')->with('leads', json_decode(json_encode($response),true));
   } 
}


On Model:
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class login extends Model
{
    use HasFactory;
    public static function fetchdata()
    {
    	$response = DB::table("logins")
            	->get();
        return $response;
    }
}
?>


On view:-
@foreach($leads['data'] as $list)
	<tr>
		<td>{{ $list['id'] }}</td>
		<td>{{ $list['name'] }}</td>
		<td>{{ $list['email'] }}</td>
		<td>{{ $list['mobile'] }}</td>
	</tr>
@endforeach
=============================================================================

Insert data Api:-
On controller
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\login;
class ApiController extends Controller
{
   function insertdata(Request $request)
   {
   		$validate=$request->validate([
   			"name"=>"required",
   			"email"=>"required",
   			"mobile"=>"required"
   		]);
   		$data=array(
   			"name"=>$request->name,
   			"email"=>$request->email,
   			"mobile"=>$request->mobile
   		);
   		$table="logins";
    	$result=login::insert_data($table,$data);
    	if($result)
    	{
    		return ["message"=>"Insert Success"];
    	}
    	else
    	{
    		return ["Message"=>"Insert faield"];
    	}
   }
}


On Model:-
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class login extends Model
{
    use HasFactory;
    public $timestamps = false;
    public static function fetchdata()
    public static function insert_data($table,$data)
    {
    	$response = DB::table($table)->insert($data);
        return $response;
    }
}
==============================================================




Data display by api:-
on controller:
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as api;
class UserController extends Controller
{
    function index()
    {
    	$alldata = (new api)->fetchData();
    	// return view('userhome')->with('leads', json_decode($alldata, true));
    	return view('userhome')->with(["leads"=>json_decode($alldata, true)]);
    }
}

On View:-
@foreach($leads['data'] as $list)
	<tr>
		<td>{{ $list['id'] }}</td>
		<td>{{ $list['name'] }}</td>
		<td>{{ $list['email'] }}</td>
		<td>{{ $list['mobile'] }}</td>
	</tr>
@endforeach
