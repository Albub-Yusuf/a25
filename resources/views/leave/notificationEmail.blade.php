<!DOCTYPE html>
<html>
<head>
    <title>Leave Notification</title>
</head>
<body>


<p>Hi <b>{{$leaveRequest['name']}}</b>, </p>


<p>We have received your leave request for these dates: <b>{{$leaveRequest['startDate']}}  to  {{$leaveRequest['endDate']}} </b>, totalling <b>{{$leaveRequest['totalDays']}} days</b>.
</p><br>

<p>As of <b>{{$leaveRequest['startDate']}}</b>, your leave request is <b @if($leaveRequest['status']=="approved") style="color:green;"@endif  @if($leaveRequest['status']=="rejected") style="color:red;"@endif >{{$leaveRequest['status']}}</b>. </p>


@if($leaveRequest['status']=="approved")
<p>Per your request, this time off will be marked as <b>{{$leaveRequest['leaveType']}}</b> leave.</p>
@endif

<p>Thanks,</p><br>

<p>{{$leaveRequest['approvedBy']}}</p>
<p>Manager</p>

</body>
</html>