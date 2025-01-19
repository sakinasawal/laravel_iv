<!DOCTYPE html>
<html lang="en">
<body>
<h1>Members Registered from January to March 2024</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Member Code</th>
                <th>Full Name</th>
                <th>Date of Register</th>
                <th>Mobile Phone Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->MemberID }}</td>
                    <td>{{ $member->Name }}</td>
                    <td>{{ $member->DateJoin }}</td>
                    <td>{{ $member->TelM }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
<br>
<a href="{{ url('/members/topPurchase') }}">click sini untuk jawapan no 2</a>
<br>
</body>
</html>