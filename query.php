select :-
$data = DB::table('BOC$Vend Emp - AV Producer')
        ->select(
        'Status as status',
        'AV Producer ID as category',
        'Legal cert_ of regist_ as registration_certificate')
        ->where('User ID', $user_id)->first();
        
        
        return view('admin.pages.fresh-empanelment-av-media-form',compact('data'));


Update :-
$update = array(
    'Owner Name' => $request->owner_name,
    'Mobile No_' => $request->mobile,
    'Email ID' => $request->email,
    'State' => $request->state
);
$where = array('Owner ID' => $owner_id);
$sql = ApiFreshEmpanelment::updateAllRecords($Owner_table, $update, $where);
$msg = 'Data Updated Successfully!';

On model:
public static function updateAllRecords($table,$update,$where){
        return $res = DB::table($table)->where($where)->update($update);
    }
