<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Invoice</h1>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Delivery Address</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{ $data->recipient_name }}</td>
                <td>{{ $data->recipient_phone }}</td>
                <td>{{ $data->product->product_name }}</td> {{---- product_name is not present in order table and itis being fetched from product table using foreign key--}}
                <td>{{ $data->total_price }}</td>
                <td>{{ $data->delivery_address }}</td>
            </tr>

        </tbody>
    </table>

</body>

</html>