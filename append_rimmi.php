<div id="media_address">
@foreach($OD_media_address_data as $key => $OD_media_address)
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="Name">State / राज्य<font color="red">*</font>
            </label>
            <select {{$disabled}} id="state_id_{{$key}}" name="MA_State[]"
                class="form-control form-control-sm call_district" data="dist_id_{{$key}}">
                <option value="">Select State</option>
                
                @if(count($states) > 0)
                @foreach($states as $statesData)
                <option value="{{ $statesData['Code'] }}" {{@$OD_media_address['State'] == $statesData['Code'] ? 'selected' : ''}}>
                    {{$statesData['Description']}}
                </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="Name">District / ज़िला<font color="red">*</font>
            </label>
            <select {{$disabled}} id="dist_id_{{$key}}" name="MA_District[]"
                class="form-control form-control-sm">
                <option value="">Select District</option>
                @if(@$OD_media_address['District'])
                <option selected="selected">
                    {{$OD_media_address['District']}}
                </option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="Name">City / नगर<font color="red">*</font></label>
            <input type="text" name="MA_City[]" class="form-control form-control-sm"
                placeholder="Enter City" maxlength="20"
                value="{{$OD_media_address['City']?? ''}}" {{$disabled}}>
        </div>
    </div>
    <div class="col-md-4" style="margin-top: 24px;">
        <div class="form-group">
            <label for="license_to">Zone / क्षेत्र</label>
            <input type="text" name="MA_Zone[]" placeholder="Zone"
                class="form-control form-control-sm" id="zone" maxlength="8"
                value="{{$OD_media_address['Zone']?? ''}}" {{$disabled}}
                onkeypress="return onlyNumberKey(event)">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Outdoor media format for which applying / बाहरी मीडिया
                प्रारूप जिसके लिए आवेदन किया जा रहा है {{@$OD_media_address['OD Media ID']}}</label>
            <select name="Applying_For_OD_Media_Type[]" class="form-control form-control-sm mediaclass"
                style="width: 100%;" {{$disabled}} id="applying_media_{{$key}}" data-val="showcategory_{{$key}}">
                <option value="">Select Category</option>
                <option value="1" {{@$OD_media_address['OD Media Type']=='1' ? 'selected' : ''}}>Airport</option>
                <option value="2" {{@$OD_media_address['OD Media Type']=='2' ? 'selected' : ''}}>Railway Station</option>
                <option value="3" {{@$OD_media_address['OD Media Type']=='3' ? 'selected' : ''}}>Moving Media</option>
                <option value="4" {{@$OD_media_address['OD Media Type']=='4' ? 'selected' : ''}}>Public utility</option>
            </select>
        </div>
    </div>

    <div class="col-md-4" id="subcategory" >
        <div class="form-group">
            <label>Media Sub-Category : </label>
            <select name="od_media_type[]" class="form-control-sm form-control" id="showcategory_{{$key}}">
            <option value="">Select</option>
            @if(@$OD_media_address['OD Media Type']!='')
                 @foreach($getcat as $cat)
                 <option value="{{$cat->media_uid}}" {{@$OD_media_address['OD Media ID']==$cat->media_uid ? 'selected' : ''}}>{{$cat->name}}</option>
                 @endforeach 
            @endif
            </select>
        </div>
    </div>

    <div class="col-md-4" style="margin-top: 24px;">
        <div class="form-group">
            <label for="year">Display size of media / मीडिया का प्रदर्शन आकार<font color="red">*
                </font></label>
            <input type="text" name="ODMFO_Display_Size_Of_Media[]"
                placeholder="Display size of media" class="form-control form-control-sm lat_media"
                id="size_of_media"  onkeypress="return onlyDotNumberKey(event)" value="{{$OD_media_address['Display Size']?? ''}}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="illumination">Illumination <font color="red">*</font></label>
            <select name="Illumination_media[]" id="Illumination_media"
                class="form-control form-control-sm">
                <option value="">Select Illumination</option>
                <option value="1" {{@$OD_media_address['Illumination Type']=='1' ? 'selected' : ''}}>lit</option>
                <option value="2" {{@$OD_media_address['Illumination Type']=='2' ? 'selected' : ''}}>non lit</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            
            <label>Availability Start Date : </label>
            @if(@$OD_media_address['Availability Start Date']=='')
            <input type="date" name="av_start_date[]" class="form-control form-control-sm" id="av_start_date">
            @else
            <input type="date" name="av_start_date[]" class="form-control form-control-sm" id="av_start_date" value="{{date('Y-m-d', strtotime($start_date)) ?? ''}}">
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Availability End Date : </label>
            @if(@$OD_media_address['Availability End Date']=='')
            <input type="date" name="av_end_date[]" class="form-control form-control-sm" id="av_end_date">
            @else
            <input type="date" name="av_end_date[]" class="form-control form-control-sm" id="av_end_date" value="{{date('Y-m-d', strtotime(@$OD_media_address['Availability End Date'])) ?? ''}}">
            @endif
        </div>
    </div>


    
</div>

@php
if(!empty($OD_media_address['Line No_'])) {
$lineone[] =$OD_media_address['Line No_'];
}
$extline1 =implode(',', $lineone);
@endphp

@endforeach
</div>//media_address id close
<input type="hidden" name="lineno1" id="lineno1" value="{{$extline1 ?? ''}}">
<div class="row" style="float:right;margin-top: 6px;">
    <input type="hidden" name="count_id" id="count_id" value="{{$key ?? 0}}">
    <a class="btn btn-primary {{$disabled}}" id="add_row_media_add"><i class="fa fa-plus"
            aria-hidden="true"></i> Add</a>
</div>


Now js part:-

$(document).ready(function() {
    $("#add_row_media_add").click(function() {
        var i = $("#count_id").val();
        i++;
        $.ajax({
            url: "{{url('fetchStates')}}",
            type: "GET",
            dataType: 'json',
            success: function(result) {
                // var obj = JSON.parse(data);
                var html = '';
                var html = '<option value="">Select any state</option>';
                $.each(result.data, function(key, value) {
                    html += '<option value="' + value.Code + '">' + value
                        .Description + '</option>';
                });

                $("#media_address").append(
                    '<div class="row"><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><select name="MA_State[]" class="form-control form-control-sm call_district" id="state_id_' +
                    i + '" data="dist_id_' + i + '">' + html +
                    '</select><span id="alert_state_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">District / ज़िला<font color="red">*</font></label><select  name="MA_District[]" id="dist_id_' +
                    i +
                    '" class=" form-control form-control-sm"><option value="">Select District</option><option value="1">Uttar Pradesh</option><option value="2">Madhya Pradesh</option><option value="3">Kherla</option></select><span id="alert_dist_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="Name">City / नगर<font color="red">*</font></label> <input type="text" name="MA_City[]" maxlength="20" class="form-control form-control-sm" placeholder="City"><span id="alert_country_dd" style="color: red;"></span></div></div><div class="col-md-4"><div class="form-group"><label for="license_to">Zone  / क्षेत्र</label><input type="text" name="MA_Zone[]" placeholder="Zone" maxlength="8" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="zone"></div></div><div class="col-md-4"><div class="form-group"><label>Outdoor media format for which applying / बाहरी मीडिया प्रारूप जिसके लिए आवेदन किया जा रहा है</label><select name="Applying_For_OD_Media_Type[]" id="applying_media_'+i+'" data-val="showcategory_'+i+'" class="form-control form-control-sm mediaclass" style="width: 100%;"><option value="">Select Category</option><option value="1">Airport</option><option value="2">Railway Station</option><option value="3">Moving Media</option><option value="4">Public utility</option></select></div></div><div class="col-md-4" id="subcategory" ><div class="form-group"><label>Media Sub-Category : </label><select name="od_media_type[]" class="form-control-sm form-control" id="showcategory_'+i+'"></select></div></div><div class="col-md-4" style="margin-top: 24px;"><div class="form-group"><label for="year">Display size of media / मीडिया का प्रदर्शनआकार<font color="red">*</font></label><input type="text" name="ODMFO_Display_Size_Of_Media[]"placeholder="Display size of media" class="form-control form-control-sm"id="size_of_media" maxlength="18"></div></div><div class="col-md-4"><div class="form-group"><label for="year">Illumination / रोशनी</label><select name="Illumination_media[]" id="Illumination_media"class="form-control form-control-sm"><option value="">Select Illumination</option><option value="1">lit</option><option value="2">non lit</option></select></div></div><div class="col-md-4"><div class="form-group"><label>Availability Start Date : </label><input type="date" name="av_start_date[]" class="form-control form-control-sm" id="av_start_date"></div></div><div class="col-md-4"><div class="form-group"><label>Availability End Date : </label><input type="date" name="av_end_date[]" class="form-control form-control-sm" id="av_end_date"></div></div> <div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row"><i class="fa fa-minus"></i> Remove</button></div></div>'
                );
            }
        });
        $("#count_id").val(i);
    });
    $("#media_address").on('click', '.remove_row', function() {
        $(this).parent().parent().remove();
        var add_count = $("#count_id").val();
        $("#count_id").val(add_count - 1);
    });
    });
