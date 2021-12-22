if($check_media_work == '' || $check_media_work == null)
{
    //media work donedata   save
    $table4 = '[BOC$OD Media Work done]';
    if (count($request->ODMFO_Year) > 0) {
        $dataFile = array();
        $File_Uploaded_Status = 0;
        if ($request->hasfile('ODMFO_Upload_Document')) {
            foreach ($request->file('ODMFO_Upload_Document') as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();

                $fileUploaded = $file->move(public_path() . '/uploads/personal-media/', $fileName);
                if ($fileUploaded) {
                    $File_Uploaded_Status = 1;
                    $dataFile['Upload_Document_FileName'][] = $fileName;
                }
            }
        } else {
            $dataFile['Upload_Document_FileName'] = '';
        }

        foreach ($request->ODMFO_Year as $key => $value) {
            $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
            if (empty($line_no)) {
                $line_no = 10000;
            } else {
                $line_no = $line_no[0]->{"Line No_"};
                $line_no = $line_no + 10000;
            }
            $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
            $ODMFO_Year = isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
            $ODMFO_Quantity_Of_Display_Or_Duration = isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
            $ODMFO_Billing_Amount = isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
            $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';

            DB::unprepared('SET ANSI_WARNINGS OFF');

            $sql4 = DB::insert("insert into $table4([timestamp],[OD Media Type],[OD Media ID],[Line No_],[Work Name],[Year],[Qty Of Display_Duration],[Billing Amount],[File Name],[File Uploaded]) values(DEFAULT,$od_media_category,'" . $odmedia_id . "',$line_no,'" . $workName . "','" . $ODMFO_Year . "',$ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,'" . $Document_FileName . "',$File_Uploaded_Status)");
            $lineno2[] = $line_no;
            $request->session()->put('line2', $lineno2);
            DB::unprepared('SET ANSI_WARNINGS ON');
        }
        if (!$sql4) {
            return $this->sendError('Some Error Occurred!.6666');
            exit;
        }
    }
}
