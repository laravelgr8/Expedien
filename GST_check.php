public function checkgst(Request $request)
{
    $getGST=$request->gstNumber;
    //Server url 09AADCS2308B1ZU
    $url = "https://apisetu.gov.in/gstn/v1/taxpayers/$getGST";
    $apiKey = 'LoYt543GxbGJJuV6KXbgvs0EmNv9INJk'; // should match with Server key
    $headers = array(
        // 'Authorization: '.$apiKey
        "accept: application/json", 
        "X-APISETU-CLIENTID: in.nic.davp",
        "X-APISETU-APIKEY: LoYt543GxbGJJuV6KXbgvs0EmNv9INJk",

    );
    // Send request to Server
    $ch = curl_init($url);
    // To save response in a variable from server, set headers;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // Get response
    $response = curl_exec($ch);
    // Decode
    $result = json_decode($response);
    // dd($result);
    echo $result->legalName;
}





$(document).ready(function(){
  $("#GST_No").on('blur',function(){
    $("#PM_Agency_Name").val('');
    var gstNumber=$("#GST_No").val();

    $.ajax({
      url : '/checkgst',
      type:'GET',
      data:{gstNumber:gstNumber},
      success:function(data)
      {
        console.log(data);
        $("#PM_Agency_Name").val(data);

      }
    });
  });
});
