@php
$ary=
	array(
		0=> array('sareavalue'=>1,'saname'=>'BORDER AREA' ),
		1=> array('sareavalue'=>2,'saname'=>'LWE AREA'),
		2=> array('sareavalue'=>3,'saname'=>'MINORITIES AREA'),
		3=> array('sareavalue'=>4,'saname'=>'NORTH-EASTERN AREA'),
		4=> array('sareavalue'=>5,'saname'=>'ASPIRATIONAL DISTRICTS'),
		5=> array('sareavalue'=>6,'saname'=>'OTHER AREA')
);


@endphp
<select size="4" name="special_area[]" disabled multiple="multiple"  id="ddl_area_type" style="height:100px;">
  {{-- <option id="special1" value="1">BORDER AREA</option>
  <option id="special2" value="2">LWE AREA</option>
  <option id="special3" value="3">MINORITIES AREA</option>
  <option id="special4" value="4">NORTH-EASTERN AREA</option>
  <option id="special5" value="5">ASPIRATIONAL DISTRICTS</option>
  <option id="special6" value="6">OTHER AREA</option> --}}
  @foreach($ary as $val)

	  <option value="{{$val['sareavalue']}}" {{ @in_array($val['sareavalue'],$special_data)? 'selected':''}}>{{$val['saname']}}</option>
  @endforeach
</select>
