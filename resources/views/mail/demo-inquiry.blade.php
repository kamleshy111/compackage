From: <span><</span>demos@compackage.com<span>></span><br>
Subject: COMPackage DEMO SIGN UP<br>
Date: {{$data['date_submitted_mail']}}<br>
To: <span><</span>jblattner@compackage.com<span>></span><br><br>

FIRST NAME:  {{$data['firstname']}}<br>
LAST NAME:  {{$data['lastname']}}<br>
EMAIL:  {{$data['email']}}<br>
PHONE:  {{preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $data['phone'])}}<br>
PHONE EXT:  {{$data['phoneext']}}<br>
STATE:  {{$data['state']}}<br>
COMPANY:  {{$data['company']}}<br>
NUMBER OF EMPLOYEES:  {{$data['num_employees']}}<br>
SUBSCRIBE TO NEWS?:  {{$data['subscribe']}}<br><br>

How did you learn about us?:  {{$data['signup_reference_from']}}<br><br>

@if ($data['OtherPleasedefine'])
    Please define?: {{ $data['OtherPleasedefine'] }}<br><br>
@elseif ($data['UniversityWhichone'])
    Which one?: {{ $data['UniversityWhichone'] }}<br><br>
@elseif ($data['Organizationwhichone'])
    Which one?: {{ $data['Organizationwhichone'] }}<br><br>
@elseif ($data['WebSearchtermsearched'])
    Term searched?: {{ $data['WebSearchtermsearched'] }}<br><br>
@endif

DATE SUBMITTED:  {{$data['date_submitted']}}<br><br>

IP Address: {{$data['ip']}}