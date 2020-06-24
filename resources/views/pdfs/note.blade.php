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
        <h2 class="text-center ">NOTA DE REMISIÓN</h2>
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
    <!--<tr>
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
    </tr>-->
  </table>
  <h5>DATOS DEL CLIENTE</h5>
  <table class="bordered" style="width: 100%;" cellspacing="0" border="0">
      <thead>
          <tr>
              <th class="box-blue font-10">Cliente</th>
              <th class="box-blue font-10">No de Orden de Cliente</th>
              <th class="box-blue font-10">Nota Número</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>{{ $order->client->name }}</td>
              <td>{{ $order->order_number }}</td>
              <td>{{ $order->id }}</td>
          </tr>
          <tr>
              <td>{{ $order->client->address.', '.$order->client->neight }}</td>
              <td></td>
              <td></td>
          </tr>
          <tr>
              <td>{{ $order->client->city.', '.$order->client->state.', CP:'.$order->client->zip}}</td>
              <td></td>
              <td></td>
          </tr>
          <tr>
              <td>RFC: {{ $order->client->rfc }}</td>
              <td></td>
              <td></td>
          </tr>
          <tr>
              <td>{{ $order->client->contact }}</td>
              <td></td>
              <td></td>
          </tr>
          <tr>
              <td>TEL: {{ $order->client->phone }}</td>
              <td></td>
              <td></td>
          </tr>
          <tr>
              <td>{{ $order->client->email }}</td>
              <td></td>
              <td></td>
          </tr>
      </tbody>
  </table>
  <h5>DESCRIPCIÓN DEL PEDIDO</h5>
  <table class="bordered tablePadding" style="width: 100%;" cellspacing="0" border="0">
    <thead>
      <tr>
      <th class="text-center box-blue font-10">CÓDIGO</th>
      <th class="text-center box-blue font-10" style="width:25%;">PRODUCTO</th>
        <th class="text-center box-blue font-10">CANTIDAD SOLICITADA</th>
        <th class="text-center box-blue font-10">CANTIDAD ENTREGADA</th>
        <th class="text-center box-blue font-10">LOTE</th>
        <th class="text-center box-blue font-10">PZAS POR CAJA</th>
        <th class="text-center box-blue font-10">CAJAS COMPLETAS</th>
        <th class="text-center box-blue font-10">PARCIAL (PZA)</th>        
        <th class="text-center box-blue font-10">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
      <tr>
      <td class="text-center">{{ $item->product->code }}</td>
      <td class="text-center">{{ $item->product->name }}</td>
      <td class="text-center">{{ intval($item->quantity) }}</td>
      <td class="text-center">{{ intval($item->quantity_real) }}</td>
      <td class="text-center">{{ $item->lot }}</td>
        <td class="text-center">{{ intval($item->pieces) }}</td>
        <td class="text-center">{{ intval($item->boxes) }}</td>
        <td class="text-center">{{ intval($item->partial)}}</td>
        <td class="text-right">{{ intval($item->total) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <br>
  <table style="width:100%;" cellspacing="0">
    <tbody>
    <tr>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ $order->delivery }}</td>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ $order->receiver }}</td>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ date('d').' de '.$months[date('n')].' de '.date('Y').' '.date('H:i') }}</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td>_______________________</td>
        <td></td>
        <td>_______________________</td>
        <td></td>
        <td>_______________________</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td class="text-center" style="font-size: 13px;">Entrega</td>
        <td></td>
        <td class="text-center" style="font-size: 13px;">Recibe</td>
        <td></td>
        <td class="text-center" style="font-size: 13px;">Fecha y Hora</td>
        <td></td>
      </tr>
    </tbody>
  </table>
  <h5>DESCRIPCIÓN DE LA TRANSPORTISTA</h5>
  <table class="tablePadding" cellspacing="0">
  <tbody>
      <tr>
          <td class="font-10">
              <b>Tipo de Caja</b>
            </td>
            <td class="font-10">
                {{ $order->box_type == 0 || $order->box_type == NULL ? "Caja Seca":"Caja Fria"}}
            </td>
            <td class="font-10"></td>
      </tr>
      <tr>
          <td class="font-10">
              <b>Caja Limpia</b>
              <p>(Libre de polvo, alimentos, aceite, agua, olores)</p>
            </td>
            <td class="font-10">
                {{ $order->clean_box == 0 || $order->clean_box == NULL ? "Cumple":"No cumple"}}
            </td>
            <td class="font-10"></td>
      </tr>
      <tr>
          <td class="font-10">
              <b>Observaciones</b>
            </td>
            <td class="font-10">
                {{ $order->observations }}
            </td>
            <td class="font-10"></td>
      </tr>
      <tr>
          <td class="font-10">
              <b>Certificado de Fumigación</b>
            </td>
            <td class="font-10">
                {{ $order->fumigation == 0 || $order->fumigation == NULL ? "Sí":"No"}}
            </td>
            <td class="font-10">
                <b>Fecha de Vigencia:</b> {{ date("d/m/y", strtotime($order->fumigation_date)) }}
            </td>
      </tr>
      <tr>
          <td class="font-10">
              <b>Transporte Propio</b>
            </td>
            <td class="font-10">
                {{ $order->own_delivery == 0 || $order->own_delivery == NULL ? "Sí":"No"}}
            </td>
            <td class="font-10">
                <b>Empresa Transportista: </b>{{ $order->company }}
            </td>
      </tr>
      <tr>
          <td class="font-10">
              <b>Placas</b>
            </td>
            <td class="font-10">
                {{ $order->plates }}
            </td>
            <td class="font-10"></td>
      </tr>
  </tbody>
  </table>
  <!--<div style="width:80%; float:left;">
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
  <img class="qr" src="{{ public_path().'/images/qrcode/orders/qrcode_order_'.$order->id.'.png' }}" alt="">-->
</div>

</body>

</html>