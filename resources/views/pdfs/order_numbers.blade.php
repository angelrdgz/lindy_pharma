<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Orden de Compra</title>
  <style>
    @page {
      margin: 15px;
    }

    body {
      font-family: sans-serif;
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

    .table{
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
      display:block;
      margin:0 auto;
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
</body>
 <table class="table">
 <tbody>
 <tr>
 <td><b>OT</b></td>
 <td class="font-12">{{ $departure->order_number }}/1.</td>
 <td><b>PRODUCTO</b></td>
 <td class="font-12">{{ $departure->recipe->name}}</td>
 <td><b>CÓDIGO</b></td>
 <td class="font-12">{{ $departure->recipe->code}}</td>
 </tr>
 </tbody>
 </table>
 <br><br>
 <table class="table">
     <thead>
         <tr>
             <td class="box-blue">Código (MP)</td>
             <td class="box-blue">Nombre</td>
             <td class="box-blue">Cantidad</td>
             <td class="box-blue">No. Entrada</td>
             <td class="box-blue">Fecha</td>
         </tr>
     </thead>
     <tbody>
         @foreach($departure->items as $item)
         <tr>
             <td class="font-12 text-center">{{ $item->supply->code}}</td>
             <td class="font-12 text-center">{{ $item->supply->code}}</td>
             <td class="font-12 text-center">{{ $item->quantity }} gr</td>
             <td class="font-12 text-center">{{ sprintf("%05s", $item->order_number) }}</td>
             <td class="font-12 text-center" style="width:25%;"></td>
         </tr>
         @endforeach
     </tbody>
 </table>
 <br><br><br><br><br>
 <table class="table">
     <tbody>
         <tr>
             <td style="width:75%" class="text-right">Surtido</td>
             <td>_________________________</td>
         </tr>
     </tbody>
 </table>
</html>