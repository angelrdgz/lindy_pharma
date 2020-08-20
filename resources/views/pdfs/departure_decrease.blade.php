<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descarga Extra de Granel</title>
    <style>
        @page {
            margin: 15px;
        }

        body {
            font-family: sans-serif;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-10 {
            font-size: 10px !important;
        }

        .font-12 {
            font-size: 12px !important;
        }

        .box-blue {
            background: #3c4e88;
            color: #fff;
            text-transform: uppercase;
            padding: 5px;
            font-size: 14px;
        }

        .total {
            background: #a7b3d8;
            font-weight: bold;
        }

        .subtotal {
            background: #f2f2f2;
            font-weight: bold;
        }

        .tablePadding tr td,
        .tablePadding tr th {
            padding: 5px;
        }

        .ot {
            background: #ccc;
            font-size: 20px;
            text-transform: uppercase;
        }

        .lot {
            background: #ccc;
            border: 1px solid #000;
            font-size: 20px;
            text-transform: uppercase;
        }

        .table-gray {
            width: 100%;
            font-size: 10px;
        }

        .table-gray thead tr th {
            background: #bfbfbf;
            color: #000;
            padding: 8px;
            border: 1px solid #000;
        }

        .table-gray tbody tr td {
            padding: 8px;
            border: 1px solid #000;
        }

        .table {
            width: 100%;
        }

        table.bordered {
            font-size: 10px;
        }

        table.bordered tr td {}

        table.item {
            width: 100%;
            border-collapse: collapse;
            margin: 0px auto;
            font-size: 9px;
        }

        table.item th {
            background: #ccc;
            border: 1px solid #888;
            color: #000;
            font-weight: bold;
        }

        table.item td,
        table.item th {
            padding: 10px;
            border: 1px solid #888;
            font-size: 9px;
        }

        .logo {
            width: 100px;
        }

        .qr {
            width: 100px;
            display: block;
            margin: 0 auto;
            height: 100px;
        }

        .block {
            padding: 5px 2px;
            text-align: center;
            border: 1px solid #000;
        }

        footer {
            position: fixed;
            bottom: 40px;
            left: 0px;
            right: 0px;
        }
    </style>
</head>

<body>
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <img src="{{ public_path().'/images/logo.png' }}" class="logo" alt="">
                </td>
                <td class="text-right">
                    <h2>Descarga Extra de Granel</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center box-blue font-10">OT</th>
                <th class="text-center box-blue font-10">Producto</th>
                <th class="text-center box-blue font-10">No. De Lote</th>
                <th class="text-center box-blue font-10">Código</th>
                <th class="text-center box-blue font-10">Receta</th>
                <th class="text-center box-blue font-10">Cantidad</th>
                <th class="text-center box-blue font-10">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($decrease->recipes as $recipe)
                @foreach($recipe->ots as $ot)
                <tr>
                    <td class="font-10">{{ $decrease->package_id == NULL ? 'Sin asignar':$decrease->package->id }}</td>
                    <td class="font-10">{{ $decrease->package_id == NULL ? 'Sin asignar':$decrease->package->product->name }}</td>
                    <td class="font-10">{{ $decrease->package_id == NULL ? 'Sin asignar':$decrease->package->lot }}</td>
                    <td class="font-10">{{ $recipe->recipe->code }}</td>
                    <td class="font-10">{{ $recipe->recipe->name }}</td>
                    <td class="font-10">{{ number_format($recipe->quantity,2) }}</td>
                    <td class="font-10">{{ date("d/m/Y H:i", strtotime($decrease->created_at)) }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <br><br>
    <h2 class="text-center"></h2>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center box-blue font-10">OT</th>
                <th class="text-center box-blue font-10">Producto</th>
                <th class="text-center box-blue font-10">No. De Lote</th>
                <th class="text-center box-blue font-10">Código</th>
                <th class="text-center box-blue font-10">Insumo</th>
                <th class="text-center box-blue font-10">Cantidad</th>
                <th class="text-center box-blue font-10">No. de Entrada</th>
                <th class="text-center box-blue font-10">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($decrease->supplies as $supply)
                @foreach($supply->entrances as $entrance)
                <tr>
                    <td class="font-10">{{ $decrease->package_id == NULL ? 'Sin asignar':$decrease->package->id }}</td>
                    <td class="font-10">{{ $decrease->package_id == NULL ? 'Sin asignar':$decrease->package->product->name }}</td>
                    <td class="font-10">{{ $decrease->package_id == NULL ? 'Sin asignar':$decrease->package->lot }}</td>
                    <td class="font-10">{{ $supply->supply->code }}</td>
                    <td class="font-10">{{ $supply->supply->name }}</td>
                    <td class="font-10">{{ number_format($supply->quantity,2) }}</td>
                    <td class="font-10">{{ '#' . strval(sprintf("%05s", $entrance->entrance_number)) }}</td>
                    <td class="font-10">{{ date("d/m/Y H:i", strtotime($decrease->created_at)) }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <br><br>
    <table style="width:100%;" cellspacing="0">
        <tbody>
            <tr>
                <td style="font-size: 10px;">Entregó</td>
                <td style="width:15%;">_________________
                <td>
                <td class="text-left" style="font-size: 10px;">Fecha</td>
                <td style="width:15%;"></td>
                <td style="font-size: 10px;">Recibió</td>
                <td style="width:15%;">_________________</td>
                <td style="font-size: 10px;">Fecha</td>
                <td style="width:15%;"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>