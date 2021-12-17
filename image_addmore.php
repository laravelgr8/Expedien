if (count($request->ODMFO_Year) > 0) 
{
    $table66 = '[BOC$OD Media Work done]';
    $table55 = 'BOC$OD Media Work done';
        $line_no_val = DB::select("select [Line No_] from $table66 where [OD Media ID] = '" . $odmedia_id . "'");

    $linenn_no=!empty($line_no_val) ? count($line_no_val) :0;
    if($linenn_no > 0)
    {
        DB::table($table55)->where('OD Media ID',$odmedia_id)->where('OD Media Type',0)->delete();
    }

    foreach ($request->ODMFO_Year as $key => $value) { //ram code start

        $Document_FileName = '';
        $File_Uploaded_Status = 0;
        if (!empty($request->file('ODMFO_Upload_Document')[$key]) && array_key_exists($key, $request->file('ODMFO_Upload_Document'))) {
            if ($request->hasFile('ODMFO_Upload_Document')) {
                $file = $request->file('ODMFO_Upload_Document')[$key];
                $fileName = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move(public_path() . '/uploads/personal-media/', $fileName);
                if ($fileUploaded) {
                    $File_Uploaded_Status = 1;
                    $Document_FileName = $fileName;
                }
            } else {
                $Document_FileName = '';
                // unlink(public_path() . '/uploads/personal-media/'.$request->ODMFO_Upload_Document_[$key]); 
            }
        } else {
            $Document_FileName = $request->ODMFO_Upload_Document_[$key];
        }
        $table6 = '[BOC$OD Media Work done]';
        $table5 = 'BOC$OD Media Work done';
        $ODMFO_Year  =
            isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
        $ODMFO_Quantity_Of_Display_Or_Duration =
            isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
        $ODMFO_Billing_Amount =
            isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
            

            $unique_id = $odmedia_id;
            $msg = 'Personal Media Vender Data Updated Successfully!';

            
            $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
            //sk change
            $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
            if (empty($next_line_no)) {
                $next_line_no = 10000;
            } else {
                $next_line_no = $next_line_no[0]->{"Line No_"};
                $next_line_no = $next_line_no + 10000;
            }

            DB::unprepared('SET ANSI_WARNINGS OFF');

            $sql4 = DB::insert(
                "insert into $table6 
            ([timestamp],
            [OD Media Type],
            [OD Media ID],
            [Line No_],
            [Work Name],
            [Year],
            [Qty Of Display_Duration],
            [Billing Amount],
            [File Name],
            [File Uploaded]
            ) values(DEFAULT,
            $od_media_category,
            '" . $odmedia_id . "',
            $next_line_no,
            '" . $workName . "',
            '" . $ODMFO_Year . "',
            $ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,
            '" . $Document_FileName . "',
            $File_Uploaded_Status)"
            );

            DB::unprepared('SET ANSI_WARNINGS ON');
        // }
    } //ram code end
}


On View:-
<div class="row" id="details_of_work_done">
@foreach($OD_work_dones as $key => $work_done_data)
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="year">Year / वर्ष<font color="red">*</font></label>
            <select name="ODMFO_Year[]" id="Years{{$key}}"
                class="form-control form-control-sm ddlYears" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                @if(@$work_done_data['Year'] == '')
                <option value="">Select Year</option>
                @else
                <option value="{{ $work_done_data['Year'] }}">
                    {{ $work_done_data['Year'] }}
                </option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="quantity_duration">Quantity of Display or Duration /
                प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label>
            <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]"
                id="quantity_duration{{$key}}" placeholder="Enter Quantity of Display or Duration"
                class="form-control form-control-sm" maxlength="8"
                onkeypress="return onlyNumberKey(event)"
                value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
            <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}"
                name="line_no[]">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि
                (रु)<font color="red">*</font></label>
            @php
            if(@$work_done_data['Billing Amount'] == 0)
            {
            $work_done_data1 = '';
            }
            else
            {
            $work_done_data1 = round(@$work_done_data['Billing Amount'],2);
            }
            @endphp
            <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$key}}"
                placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm"
                onkeypress="return onlyNumberKey(event)" maxlength="8"
                value="{{$work_done_data1}}" {{$disabled}} {{$read}} tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
        </div>
    </div>
    <div class="col-md-4">

        <div class="form-group">
            <label for="upload_doc_{{$key}}">Upload Document / दस्तावेज़ अपलोड
                करें</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" readonly="readonly" name="ODMFO_Upload_Document[]" class="custom-file-doc {{$click}}"
                        data="{{$key}}" onchange="return uploadFile({{$key}},this)" id="upload_doc_{{$key}}"
                            accept="application/pdf" {{$read}} tabindex="{{$tab}}" style="cursor: not-allowed;">
                    <label class="custom-file-label" for="upload_doc_{{$key}}" id="choose_file{{$key}}">Choose
                        file</label>
                        <input type="hidden" name="ODMFO_Upload_Document_[]" value="{{ @$work_done_data['File Name']}}"> <!-- ram code -->
                    <!-- <span id="alert_upload_doc" style="color: red;"></span> -->
                    
                </div>

                @if(@$work_done_data['File Name'] != '')
                <div class="input-group-append">
                    <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{@$work_done_data['File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                </div>
                @else
                <div class="input-group-append">
                    <span class="input-group-text" id="upload_file{{$key}}">Upload</span>
                </div>
                @endif
            </div>
            <span id="upload_doc_error{{$key}}" class="error invalid-feedback"></span>
        </div>


    </div>
</div>
@php
if(@$work_done_data['Line No_']) {
$dd_line[] = $work_done_data['Line No_'];
}

$exline2=implode(',',$dd_line);
$i++;
@endphp

@endforeach
</div>


JS Part:-
$("#add_row_next").click(function() {
        var i = $("#count_i").val();
        i++;

        var html = '<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><select name="ODMFO_Year[]" id="Years' +
            i +
            '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration'+i+'" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount'+i+'" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"><label for="upload_doc_0' +
            i +
            '">Upload Document / दस्तावेज़ अपलोड करें</label><div class="input-group"><div class="custom-file"><input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" id="upload_doc_' +
            i + '"  onchange="return uploadFile(' + i + ',this)" data="' + i +
            '"><label class="custom-file-label" for="upload_doc_' + i + '" id="choose_file' + i +
            '">Choose file</label></div><div class="input-group-append"><span class="input-group-text" id="upload_file' +
            i + '">Upload</span></div></div><span id="upload_doc_error' + i +
            '" class="error invalid-feedback"></span></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row_next" style="margin-left: -16px;"><i class="fa fa-minus"></i> Remove</button></div></div>';

        $("#details_of_work_done").append(html);
        $("#count_i").val(i);
        for (var i = 1980; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            $(".ddlYears").append(option);
        }
    });
    $("#details_of_work_done").on('click', '.remove_row_next', function() {
        $(this).parent().parent().remove();

        var add_count = $("#count_i").val();

        $("#count_i").val(add_count-1);
    });
