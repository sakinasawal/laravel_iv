<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referral Counts</title>
</head>
<body>

    <h1>Members Referral Counts</h1>
    <table border="1">
        <thead>
            <tr>
                <th>MemberID</th>
                <th>Name</th>
                <th>Number of Members Referred</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referralCounts as $referral)
                <tr>
                    <td>{{ $referral->MemberID }}</td>
                    <td>{{ $referral->Name }}</td>
                    <td>{{ $referral->referred_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/members/purchaseReferral') }}">Total purchase</a>
</body>
</html>
