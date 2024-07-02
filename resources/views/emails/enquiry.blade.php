<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="2">
		<tr>
			<td>Name</td>
			<td>{{$data['name']}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{$data['email']}}</td>
		</tr>
		<tr>
			<td>Phone</td>
			<td>@if(!empty($data['country_code'])){{$data['country_code']}}-@endif{{$data['number']}}</td>
		</tr>
		<tr>
			<td>Subject</td>
			<td>{{$data['subject']}}</td>
		</tr>
		<tr>
			<td>Message</td>
			<td>{{$data['message']}}</td>
		</tr>
	</table>
</body>
</html>