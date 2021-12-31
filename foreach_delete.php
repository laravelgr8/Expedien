@foreach($OD_media_address_data as $key => $OD_media_address)
	//all data fetch code here



@php 
$countAdd=count($OD_media_address_data);

@endphp
@if($countAdd > 1)
<div class="col-md-4">
	<input type="hidden" name="sole_id" id="sole_id{{$key}}"  value="{{$OD_media_address['Sole Media ID']}}">
	<input type="hidden" name="li_no" id="li_no{{$key}}" value="{{$OD_media_address['Line No_']}}">
	<br><h4 class="del btn btn-danger" data-sid="li_no{{$key}}" data-sod="sole_id{{$key}}" style="cursor: pointer;">X</h4>
</div>

@endif


@endfreach


On Controller:-
public function soleaddress_delete(Request $request)
{
	$line_no=$request->line_no;
	$od_media_id=$request->od_media_id;

	$where=array("Sole Media ID"=>$od_media_id,'Line No_'=>$line_no);
	$data=DB::table('BOC$Sole Medias Address')->where($where)->delete();
	return "Data Delete Successfully";
}




js part:
$(".del").on("click",function(){
		var get_id=$(this).attr('data-sid');
		var line_no=$("#"+get_id).val();

		var get_odMediaID=$(this).attr('data-sod');
		var od_media_id=$("#"+get_odMediaID).val();
		$.ajax({
			url: 'soleaddress_delete',
			type:'GET',
			data:{line_no: line_no,od_media_id: od_media_id},
			success:function(data)
			{
				console.log(data);
			}
		});
		
	});
