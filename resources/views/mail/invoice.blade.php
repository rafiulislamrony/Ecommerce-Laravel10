<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <li>Payment Id: {{ $data['payment_id'] }}</li>
        <li>Total Amount: {{ $data['total'] }}</li>
        <li>Payment Type: {{ $data['payment_type'] }}</li>
        <li>Status Code: {{ $data['status_code'] }}</li>
        <li>Date: {{ $data['date'] }}</li>
    </ul>

</body>
</html>
