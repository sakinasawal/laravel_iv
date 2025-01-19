<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Purchases</title>
</head>
<body>

    <h1>Members' Personal and Referral Purchases</h1>
    <table border="1">
        <thead>
            <tr>
                <th>MemberID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Total Personal Purchase</th>
                <th>Total Referral Purchase</th>
                <th>Total Group Purchase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($totalPurchases as $data)
                <tr>
                    <td>{{ $data->MemberID }}</td>
                    <td>{{ $data->Name }}</td>
                    <td>{{ $data->TelM }}</td>
                    <td>{{ $data->total_personal_purchase }}</td>
                    <td>{{ $data->total_referral_purchase }}</td>
                    <td>{{ $data->total_group_purchase }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/members/familyTree') }}">sini no 5 tapi saya tappaham</a>
</body>
</html>
