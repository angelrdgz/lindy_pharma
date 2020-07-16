<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Listado de MP</title>
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
    <table width="100%" class="bordered" style="width:100%;" border="0">
        <tr>
            <td>
                <img src="{{ public_path().'/images/logo.png' }}" class="logo" alt="">
            </td>
            <td class="">
                <h2 class=" ">LISTADO DE MP</h2>
            </td>
            <td colspan="4"></td>
        </tr>
    </table>
    <br><br>
    <table class="table">
        <tbody>
            <tr>
                <td class="font-12" style="width: 3%;"><b>OT</b></td>
                <td class="font-12 text-left" style="width: 10%;">{{ sprintf("%05s", $package->id) }}/1.</td>
                <td class="font-12" style="width: 10%;"><b>PRODUCTO</b></td>
                <td class="font-12 text-left">{{ $package->product->name}}</td>
                <td class="font-12" style="width: 18%;"><b>CÓDIGO PRODUCTO</b></td>
                <td class="font-12 text-left">{{ $package->product->code}}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <td class="box-blue text-center">Código (MP)</td>
                <td class="box-blue text-center">Nombre</td>
                <td class="box-blue text-center">Cantidad</td>
                <td class="box-blue text-center">Cantidad Surtida</td>
                <td class="box-blue text-center">No. Entrada</td>
                <td class="box-blue text-center">Fecha</td>
            </tr>
        </thead>
        <tbody>
            @foreach($package->recipes as $recipe)
            @foreach($recipe->lots as $lot)
            <tr>
                <td class="font-12 text-center">{{ $lot->recipe->code}}</td>
                <td class="font-12 text-center">{{ $lot->recipe->name}}</td>
                <td class="font-12 text-center">{{ number_format($lot->quantity,2) }} pza</td>
                <td class="font-12 text-center">{{ number_format($lot->delivery_quantity,2) }} pza</td>
                <td class="font-12 text-center">{{ $lot->lot_number == NULL ? "No definido":sprintf("%05s", $lot->lot_number) }}</td>
                <td class="font-12 text-center" style="width:25%;">{{ date('d/m/Y', strtotime($recipe->deliver_date))}}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <td class="box-blue text-center">Código (MP)</td>
                <td class="box-blue text-center">Nombre</td>
                <td class="box-blue text-center">Cantidad</td>
                <td class="box-blue text-center">Cantidad Surtida</td>
                <td class="box-blue text-center">No. Entrada</td>
                <td class="box-blue text-center">Fecha</td>
            </tr>
        </thead>
        <tbody>
            @foreach($package->supplies as $supply)
            @foreach($supply->entrances as $entrance)
            <tr>
                <td class="font-12 text-center">{{ $entrance->supply->code}}</td>
                <td class="font-12 text-center">{{ $entrance->supply->name}}</td>
                <td class="font-12 text-center">{{ number_format($entrance->quantity,2) }} pza</td>
                <td class="font-12 text-center">{{ number_format($entrance->delivery_quantity,2) }} pza</td>
                <td class="font-12 text-center">{{ $entrance->entrance_number == NULL ? "No definido":sprintf("%05s", $entrance->entrance_number) }}</td>
                <td class="font-12 text-center" style="width:25%;">{{ date('d/m/Y', strtotime($supply->deliver_date))}}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    <br><br><br><br><br>
    <table class="table">
        <tbody>
            <tr>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td class="text-right"><b>Surtió:</b></td>
                <td style="width:19.8%; text-align:center;">______________________</td>
                <td style="width:16.6%;" class="text-right"><b>Fecha:</b></td>
                <td style="width:16.6%;">______________________</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table class="table">
        <tbody>
            <tr>
                <td style="width:15%;"></td>
                <td style="width:15%;"></td>
                <td class="text-right"><b>Recibió:</b></td>
                <td style="width:19.8%; text-align:center;">______________________</td>
                <td style="width:16.6%;" class="text-right"><b>Fecha:</b></td>
                <td style="width:16.6%;">______________________</td>
            </tr>
        </tbody>
    </table>
</body>

</html>