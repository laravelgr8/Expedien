how to value set in array.
$line_no_arr=[]; //first you create a blank array.

$line_no = DB::select("select TOP 1 [Line No_] from $table2 where [OD Media Type] = 0 and [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
if (empty($line_no)) {
	$line_no = 10000;
} else {
	$line_no = $line_no[0]->{"Line No_"};
	$line_no = $line_no + 10000;
}

$line_no_arr[] =$line_no;   //$line_no me multiple value aa raha hai usko array me store kiya
$request->session()->put("lineNo",$line_no_arr);

$lineno=$request->session()->get("lineNo");
