@php
	$arr = explode(", ",$ticket->company_id);
	$array = [];
	$companies = \DB::table('companies')
	            	->select('name')
	                ->WhereIn('id',$arr)
	                ->get();
	foreach ($companies as $company)
		array_push($array, $company->name);
	$companies = implode(" , ", $array);
	echo $companies;
@endphp