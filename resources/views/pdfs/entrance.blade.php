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
        <h2 class="text-center ">ORDEN DE COMPRA</h2>
      </td>
      <td class="text-right">Fecha:</td>
      <td class="block">{{ date('d/m/Y', strtotime($entrance->created_at))}}</td>
    </tr>
    <tr>
      <td class="text-right">OC #</td>
      <td class="block">{{ $entrance->id }}</td>
    </tr>
    <tr>
      <td>Av. San Jose #1210 Col. Los Cajetes </td>
      <td class="text-right">REQUISICIÓN #</td>
      <td class="block">{{ $entrance->requisition }}</td>
    </tr>
    <tr>
      <td>Zapopan , Jal C.P. 45234 </td>
      <td class="text-right">DEPARTAMENTO #</td>
      <td class="block">{{ $entrance->department }}</td>
    </tr>
    <tr>
      <td>RFC: LPH 15051484A Tel. +52 (33) 1543 2480</td>
      <td class="text-right">CTO. DE COSTOS</td>
      <td class="block"> {{$entrance->cost->name }} </td>
    </tr>
    <tr>
      <td class="box-blue" colspan="4">Proveedor</td>
      <td></td>
      <td class="box-blue" colspan="8">Enviar A:</td>
    </tr>
    <tr>
      <td colspan="4">{{ $entrance->supplier->name }}</td>
      <td></td>
      <td colspan="8">ATN: {{ $buyer->name}}</td>
    </tr>
    <tr>
      <td colspan="4">{{ $entrance->supplier->address.', '.$entrance->supplier->neight }}</td>
      <td></td>
      <td colspan="8">LINDY PHARMA SAPI de C.V.</td>
    </tr>
    <tr>
      <td colspan="4">{{ $entrance->supplier->city.', '.$entrance->supplier->state.', CP:'.$entrance->supplier->zip}}</td>
      <td></td>
      <td colspan="8">AV. SAN JOSE 1210</td>
    </tr>
    <tr>
      <td colspan="4">RFC: {{ $entrance->supplier->rfc }}</td>
      <td></td>
      <td colspan="8">COL: LOS CAJETES</td>
    </tr>
    <tr>
      <td colspan="4">{{ $entrance->supplier->contact }}</td>
      <td></td>
      <td colspan="8">ZAPOPAN JAL. </td>
    </tr>
    <tr>
      <td colspan="4">TEL: {{ $entrance->supplier->phone }}</td>
      <td></td>
      <td colspan="3">CP: 45234</td>
      <td colspan="5">TEL: 33 1543 2480</td>
    </tr>
    <tr>
      <td colspan="4">{{ $entrance->supplier->email }}</td>
      <td></td>
      <td colspan="8">Email {{ $buyer->email }}</td>
    </tr>
  </table>
  <br>
  <table class="bordered" style="width: 100%;" cellspacing="0" border="0">
    <thead>
      <tr>
        <th class="text-center box-blue font-10">Uso Cfdi</th>
        <th class="text-center box-blue font-10">INCOTERM</th>
        <th class="text-center box-blue font-10">FECHA ESTIMADA DE ENTREGA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">{{ $entrance->CFDI->code.' - '.$entrance->CFDI->name }}</td>
        <td class="text-center"></td>
        <td class="text-center">{{ $days[date('N', strtotime($entrance->expected_date))].', '.date('d', strtotime($entrance->expected_date)).' de '.$months[date('n', strtotime($entrance->expected_date))].' de '.date('Y', strtotime($entrance->expected_date))}}</td>
      </tr>
    </tbody>
  </table>
  <br>
  <table class="bordered tablePadding" style="width: 100%;" cellspacing="0" border="0">
    <thead>
      <tr>
        <th class="text-center box-blue font-10">CANTIDAD</th>
        <th class="text-center box-blue font-10">UNIDAD / CLAVE</th>
        <th class="text-center box-blue font-10">DESCRIPCION</th>
        <th class="text-center box-blue font-10">PU</th>
        <th class="text-center box-blue font-10">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $subtotal = 0;
      $mainCurrency = '';
      $x = 0;
      ?>
      @foreach($entrance->items as $item)
      <?php 
      if ($x == 0) {
        $mainCurrency = $item->currency->code;
      } 
      ?>
      <tr>
        <td class="text-center">{{ $item->quantity }}</td>
        <td class="text-center">{{ $item->supply->measurementBuy->code == NULL ? "N/A":$item->supply->measurementBuy->code }}</td>
        <td class="text-center">{{ $item->supply->code.' - '.$item->supply->name }}</td>
        <td class="text-right">${{ number_format($item->price,2).' '.$mainCurrency }}</td>
        <td class="text-right">${{ number_format(($item->quantity * $item->price),2).' '.$mainCurrency }}</td>
      </tr>
      <?php
      $subtotal += $item->quantity * $item->price;
      $x++;
      ?>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3"></td>
        <td>SUBTOTAL</td>
        <td class="text-right subtotal">${{ number_format($subtotal, 2).' '.$mainCurrency}}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td>IVA</td>
        <td class="text-right">${{number_format(($subtotal * 0.16),2).' '.$mainCurrency}}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td>TOTAL</td>
        <td class="text-right total">${{ number_format($subtotal + ($subtotal * 0.16), 2).' '.$mainCurrency}}</td>
      </tr>
    </tfoot>
  </table>
  <br>
  <br>
  <table style="width:100%;" cellspacing="0">
    <tbody>
      <tr>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ $entrance->mader }}</td>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ $entrance->owner }}</td>
        <td></td>
        <td class="text-center" style="font-size: 10px;">{{ $entrance->authorizer }}</td>
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
        <td class="text-center" style="font-size: 13px;">Elabora</td>
        <td></td>
        <td class="text-center" style="font-size: 13px;">Solicita</td>
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
              @foreach($entrance->comments as $comment)
              <li>{{ $comment->comment }}</li>
              @endforeach
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="width:20%; float:right;">
    <img class="qr" src="{{ public_path().'/images/qrcode/entrances/qrcode_entrance_'.$entrance->id.'.png' }}" alt="">
  </div>

</body>

</html>