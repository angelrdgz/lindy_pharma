<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Pedido</title>
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
  @php
  $days = ["", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo"];
  $months = ["","enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
  @endphp



  <table width="100%" class="bordered" style="width:100%;" border="0">
    <tr>
      <td rowspan="2">
        <img src="{{ public_path().'/images/logo.png' }}" class="logo" alt="">
      </td>
      <td rowspan="5" colspan="7">
        <h2 class="text-center ">FORMATO DE PEDIDO</h2>
      </td>
      <td class="text-right">Fecha:</td>
      <td class="block">{{ date('d/m/Y', strtotime($order->created_at))}}</td>
    </tr>
    <tr>
      <td class="text-right">No Pedido</td>
      <td class="block">{{ $order->id }}</td>
    </tr>
    <tr>
      <td>Av. San Jose #1210 Col. Los Cajetes </td>
      <td class="text-right">No OC Cliente</td>
      <td class="block"> {{ $order->order_number }} </td>
    </tr>
    <tr>
      <td>Zapopan , Jal C.P. 45234 </td>
      <td class="text-right"></td>
      <td class=""></td>
    </tr>
    <tr>
      <td>RFC: LPH 15051484A Tel. +52 (33) 1543 2480</td>
      <td class="text-right"></td>
      <td></td>
    </tr>
    <tr>
      <td class="box-blue" colspan="4">Cliente</td>
      <td></td>
      <td class="text-right" colspan="8">Fecha Compromiso Entrega: {{ date('d/m/Y', strtotime($order->commitment_date))}}</td>
    </tr>
    <tr>
      <td colspan="4">{{ $order->client->name }}</td>
      <td></td>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="4">{{ $order->client->address.', '.$order->client->neight }}</td>
      <td></td>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="4">{{ $order->client->city.', '.$order->client->state.', CP:'.$order->client->zip}}</td>
      <td></td>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="4">RFC: {{ $order->client->rfc }}</td>
      <td></td>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="4">{{ $order->client->contact }}</td>
      <td></td>
      <td colspan="8"></td>
    </tr>
    <tr>
      <td colspan="4">TEL: {{ $order->client->phone }}</td>
      <td></td>
      <td colspan="3"></td>
      <td colspan="5"></td>
    </tr>
    <tr>
      <td colspan="4">{{ $order->client->email }}</td>
      <td></td>
      <td colspan="8"></td>
    </tr>
  </table>
  <br>
  <table class="bordered tablePadding" style="width: 100%;" cellspacing="0" border="0">
    <thead>
      <tr>
        <th class="text-center box-blue font-10">CANTIDAD</th>
        <th class="text-center box-blue font-10">UNIDAD / CLAVE</th>
        <th class="text-center box-blue font-10">CÓDIGO</th>
        <th class="text-center box-blue font-10">NOMBRE DE PRODUCTO</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
      <tr>
        <td class="text-center">{{ $item->quantity }}</td>
        <td class="text-center">Pza</td>
        <td class="text-center">{{ $item->product->code}}</td>
        <td class="text-right">{{ $item->product->name }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <br>
  <table style="width:100%;" cellspacing="0">
    <tbody>
    <tr>
        <td class="text-center" style="font-size: 10px;">{{ $order->mader }}</td>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ $order->authorizer }}</td>
        <td></td>
      </tr>
      <tr>
        <td class="text-center">_______________________</td>
        <td></td>
        <td class="text-center">_______________________</td>
        <td></td>
      </tr>
      <tr>
        <td class="text-center" style="font-size: 13px;">Elabora</td>
        <td></td>
        <td class="text-center" style="font-size: 13px;">Autoriza</td>
        <td></td>
      </tr>
    </tbody>
  </table>
  <br>
  <div style="width:80%; float:left;">
    <table class="table-gray" cellspacing="0">
      <thead>
        <tr>
          <th>Comentarios o instrucciones especiales</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <ul>
              @foreach($order->comments as $comment)
              <li>{{ $comment->comment }}</li>
              @endforeach
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="width:20%; float:right;">
  <img class="qr" src="{{ public_path().'/images/qrcode/orders/qrcode_order_'.$order->id.'.png' }}" alt="">
</div>

</body>

</html>