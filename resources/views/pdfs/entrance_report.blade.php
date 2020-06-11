<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Arribo</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table th{
            font-weight: bolder;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 class="text-center">Reporte de Arribo</h1>
    <table class="table">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Código Producto</td>
                <td>Nombre Producto</td>
                <td>Número de Compra</td>
                <td>Número de Entrada</td>
                <td>Lote de Proveedor</td>
                <td>Cantidad Kg</td>
                <td>Cantidad Disponible Kg</td>
                <td>No de Envases</td>
                <td>Fecha de Caducidad</td>
                <td>Fecha de Reanalisis</td>
                <td>Proveedor</td>
            </tr>
        </thead>
        <tbody>
            <td>{{ $supply->entrance->created_at }}</td>
            <td>{{ $supply->supply->code }}</td>
            <td>{{ $supply->supply->name }}</td>
            <td>{{ '#' . strval(sprintf("%05s", $supply->entrance->id)) }}</td>
            <td>{{ '#' . strval(sprintf("%05s", $supply->id)) }}</td>
            <td>{{ $supply->lot_supplier}}</td>
            <td>{{ $supply->quantity }}</td>
            <td>{{ $supply->available_quantity }}</td>
            <td>{{ $supply->cups }}</td>
            <td>{{ $supply->expired_date }}</td>
            <td>{{ $supply->reanalized_date }}</td>
            <td>{{ $supply->supplier = $supply->entrance->supplier->name }}</td>
        </tbody>
    </table>
</body>

</html>