foreach ($request->year as $key => $year)
{
  if ($request->hasfile('pic')) {
    $file = $request->pic[$key];
    $filename = time() . '-' . $file->getClientOriginalName();
    $file->move('/img', $filename);
  }
  $sql=DB::table('login')->insert([
      "name" =>$request->name[$key],
      "year" =>$year,
      "pic" => $filename
  ]);
}
