//agar rental_agreement me data raha ho to thik hai other wose zero set kar do 
$request->rental_agreement = $request->rental_agreement ?? 0;

on checkbox
if ($request->Self_declaration == 'on') {
	$self_declaration = 1;
}
<option value="0" {{@$data[0]->{'category'} == "0"  ? 'selected' : ''}}>A</option>

value="{{$data[0]->Contact_Person_Fax ?? ''}}"
