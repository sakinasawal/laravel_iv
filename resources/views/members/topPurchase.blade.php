<!DOCTYPE html>
<html lang="en">
<body>
<h1>Top 10 Members Who Made the Most Purchases in March 2024</h1>
    <table border="1">
        <thead>
            <tr>
                <th>MemberID</th>
                <th>Name</th>
                <th>Total Purchase Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topMembers as $member)
                <tr>
                    <td>{{ $member->MemberID }}</td>
                    <td>{{ $member->Name }}</td>
                    <td>{{ $member->total_purchase }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/members/referral') }}">The number of member refer for each member</a>
</body>
</html>