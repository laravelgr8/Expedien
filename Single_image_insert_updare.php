$odmedia_id = $request->vendorid_tab_3;
$mtable = 'BOC$Vendor Emp - OD Media';
$mod=DB::table($mtable)->where('OD Media ID',$odmedia_id)->first();

//change modify  present
$Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';
if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
	$file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
	$Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
	$file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
	if ($file_uploaded) {
		$Notarized_Copy_Of_Agreement = 1;
	} else {
		$Notarized_Copy_File_Name = '';
	}
}
