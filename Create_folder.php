How To image uploade and folder create automatic:-


$mypath=public_path() . '/uploads/fresh-empanelment/'.$newspaper_code."/";
if(!File::isDirectory($mypath)){
	File::makeDirectory($mypath, 0777, true, true);          
}


if ($request->hasFile('rni_reg_file_name') || $request->hasFile('rni_reg_file_name_modify')) 
{
	$file = $request->file('rni_reg_file_name') ?? $request->file('rni_reg_file_name_modify');
	$rni_reg_file_name = time() . '-' . $file->getClientOriginalName();
	$file_uploaded = $file->move($destinationPath, $rni_reg_file_name);
	File::copy($destinationPath.$rni_reg_file_name, $mypath.$rni_reg_file_name); //store file in another folder

}
