<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members and Purchases</title>
</head>
<body>
<h1>Members List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>MemberID</th>
                <th>Name</th>
                <th>DateJoin</th>
                <th>TelM</th>
                <th>Email</th>
                <th>BirthDate</th>
                <th>ParentID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->MemberID }}</td>
                    <td>{{ $member->Name }}</td>
                    <td>{{ $member->DateJoin }}</td>
                    <td>{{ $member->TelM }}</td>
                    <td>{{ $member->Email }}</td>
                    <td>{{ $member->BirthDate }}</td>
                    <td>{{ $member->ParentID }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

<h1>Purchases List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>BillNo</th>
                <th>MemberID</th>
                <th>SalesDate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->BillNo }}</td>
                    <td>{{ $purchase->MemberID }}</td>
                    <td>{{ $purchase->SalesDate }}</td>
                    <td>{{ $purchase->Amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
<br><br>
<a href="{{ url('/members/filter') }}">click here to see answer for question 1</a>
</body>
</html>