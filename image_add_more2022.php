<div class="form-group">
	<label for="upload_doc_{{$key}}">Upload Document / दस्तावेज़ अपलोड
		करें</label>
	<div class="input-group">
		<div class="custom-file">
			<input type="file" readonly="readonly" name="ODMFO_Upload_Document[]" class="custom-file-doc {{$click}}" data="{{$key}}" onchange="return uploadFile({{$key}},this)" id="upload_doc_{{$key}}" accept="application/pdf" {{$read}} tabindex="{{$tab}}" style="cursor: not-allowed;">
			<label class="custom-file-label" for="upload_doc_{{$key}}" id="choose_file{{$key}}">Choose file</label>
			
			<input type="hidden" name="ODMFO_Upload_Document_[]" value="{{ @$work_done_data['File Name']}}"> 
		</div>

		@if(@$work_done_data['File Name'] != '')
		<div class="input-group-append">
			<span class="input-group-text"><a
					href="{{ url('/uploads') }}/personal-media/{{@$work_done_data['File Name']}}"
					target="_blank"><i class="fa fa-eye"
						aria-hidden="true"></i></a></span>
		</div>
		@else
		<div class="input-group-append">
			<span class="input-group-text" id="upload_file{{$key}}">Upload</span>
		</div>
		@endif
	</div>
	<span id="upload_doc_error{{$key}}" class="error invalid-feedback"></span>
</div>






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
	}
} else {
	$Document_FileName = $request->ODMFO_Upload_Document_[$key];
}
