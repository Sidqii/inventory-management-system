<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Inventory Dashboard</h1>

    <br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Name</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>