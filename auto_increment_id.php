iske click par:
<div class="col-md-4">
	<div class="form-group">
		<label>Outdoor media format for which applying / बाहरी मीडिया
			प्रारूप जिसके लिए आवेदन किया जा रहा है</label>
		<select name="Applying_For_OD_Media_Type[]" class="form-control form-control-sm mediaclass"
			style="width: 100%;" id="applying_media_0" data-val="showcategory_0">
			<option value="">Select Category</option>
			<option value="1">Airport</option>
			<option value="2">Railway Station</option>
			<option value="3">Moving Media</option>
			<option value="4">Public utility</option>
		</select>
	</div>
</div>


<div class="col-md-4" id="subcategory" >
	<div class="form-group">
		<label>Media Sub-Category : </label>
		<select name="od_media_type" class="form-control-sm form-control" id="showcategory_0">
			
		</select>
	</div>
</div>





$(document).on('change', '.mediaclass', function() {
    if ($(this).val() != '') {
        var id = $(this).attr("data-val");
        console.log(id);
        $("#" + id).empty();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: "{{Route('fetchmedia')}}",
            data: {
                media_code: $(this).val()
            },
            success: function(response) {
                // console.log("#" + id);
                // $("#" + id).html(response.message);
                $("#" + id).html(response);

            }
        });
    }
});



public function fetchmedia(Request $request)
    {
        $media_code= $request->media_code;
        $table='BOC$OD Media Category';
        $data=DB::table($table)->get();
        foreach($data as $cat)
        {
            echo "<option>".$cat->Name."</option>";
        }
    }
