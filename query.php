select :-
$data = DB::table('BOC$Vend Emp - AV Producer')
        ->select(
        'Status as status',
        'AV Producer ID as category',
        'Legal cert_ of regist_ as registration_certificate')
        ->where('User ID', $user_id)->first();
        
        
        return view('admin.pages.fresh-empanelment-av-media-form',compact('data'));
