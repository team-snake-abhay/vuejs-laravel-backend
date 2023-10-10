<!DOCTYPE html>
<html>
	<head>
		<title>{{config('app.name')}}</title>
	</head>
    <body>
		<p style="font-family:calibri;color:blue">Sender Name: <span style="color:black">{{$contact->sender_name}}</span></p>
		<p style="font-family:calibri;color:blue">Contact Number: <span style="color:black">{{$contact->sender_contact_number}}</span></p>
		<p style="font-family:calibri;color:blue">Email: <span style="color:black">{{$contact->sender_email}}</span></p>
		<p style="font-family:calibri;color:blue">Subject: <span style="color:black">{{$contact->subject}}</span></p>
		<p style="font-family:calibri;color:blue">Message: <span style="color:black">{{$contact->sender_message}}</span></p>
	</body>
</html>
