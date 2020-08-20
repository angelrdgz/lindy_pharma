<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Orden de Fabricación</title>
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
      padding: 3px 10px;
      border: 1px solid #888;
      font-size: 9px;
    }

    .logo {
      width: 100px;
    }

    .qr {
      width: 100px;
      height: 100px;
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
      <td>
        <img src="{{ public_path().'/images/logo.png' }}" class="logo" alt="">
      </td>
      <td colspan="8">
        <h2 class="text-center ">ORDEN DE PRODUCCIÓN</h2>
      </td>
      <td class="text-right">
        <p style="margin:1px;">Anexo 1</p>
        <p style="margin:1px;">LPH-4K-02</p>
        <p style="margin:1px;">rev: Nuevo</p>
      </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Orden de Trabajo</td>
      <td class="ot text-right">{{ $order->order_number }}/1.0</td>
    </tr>
    <tr>
      <td>Código del granel:</td>
      <td><b>{{ $recipe->code }}</b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td rowspan="2">No. de lote </td>
      <td class="lot text-center" rowspan="2">{{ $order->lot}}</td>
    </tr>
    <tr>
      <td>Nombre del producto:</td>
      <td colspan="4"><b>{{ $recipe->name }}</b></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Forma Farmacéutica:</td>
      <td colspan="2"> Cápsula de gelatina blanda</td>
      <td></td>
      <td colspan="2">Tamaño de Lote:</td>
      <td class="text-right"><b>{{ number_format($order->quantity) }}</b></td>
      <td>cápsulas </td>
      <td>Fecha de Fabricación:</td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>Fecha de Caducidad:</td>
      <td></td>
    </tr>
    <tr>
      <td>Fecha de emisión:</td>
      <td colspan="4"><b>{{ $days[date('N', strtotime($order->created_at))].', '.date('d', strtotime($order->created_at)).' de '.$months[date('n', strtotime($order->created_at))].' de '.date('Y', strtotime($order->created_at))}}</b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td rowspan="4" class="text-center">
        <img class="qr" src="{{ public_path().'/images/qrcode/qrcode_'.$order->id.'.png' }}" alt="">
      </td>
    </tr>
    @php
    if($order->type == 1){
    $supplies = $recipe->supplies;
    }else{
    $supplies = $recipe->suppliesCover;
    }
    @endphp
    <tr>
      <td>Peso de contenido:</td>
      <td>{{ number_format($totalContent,2) }}</td>
      <td>mg</td>
      <td></td>
      <td>Molde:</td>
      <td>{{ $order->recipe->mold->code }}</td>
      <td></td>
      <td>Cliente:</td>
      <td>{{ $order->client->name }}</td>
    </tr>
    <tr>
      <td>Peso máximo:</td>
      <td>{{ number_format(($totalContent + ($totalContent * 0.03)),2) }}</td>
      <td>mg</td>
      <td></td>
      <td colspan="3">Tiempo de encapsulado:</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Peso mínimo:</td>
      <td>{{ number_format(($totalContent - ($totalContent * 0.03)),2) }}</td>
      <td>mg</td>
      <td></td>
      <td>Línea:</td>
      <td>{{ $order->line }}</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>
  @if($order->type == 1)
  <h4 class="text-center" style="margin-top:45px; margin-bottom: 0px;">CONTENIDO DE LA CAPSULA</h4>
  @elseif($order->type == 2)
  <h4 class="text-center" style="margin-top:45px; margin-bottom: 0px;">ENVOLVENTE DE LA CAPSULA 1</h4>
  @else
  <h4 class="text-center" style="margin-top:45px; margin-bottom: 0px;">ENVOLVENTE DE LA CAPSULA 2</h4>
  @endif
  <table class="item" width="100%" class="bordered" border="0">
    <thead>
      <tr>
        <th>Código del Insumo</th>
        <th style="width: 30%;">Descripción del Insumo</th>
        <th>Cantidad Unitaria</th>
        <th>UM</th>
        @if($order->type == 1)
        <th>Exceso (%)</th>
        <th>Cantidad Unitaria</th>
        @else
        <th>Composición de la formula</th>
        @endif
        <th>UM</th>
        <th>Cantidad Total</th>
        <th>UM</th>
        <th>Número de Entrada Utilizada</th>
      </tr>
    </thead>
    <tbody>
      @php
      $totalFirst = 0;
      $totalSecond = 0;
      $totalThird = 0;

      @endphp
      @foreach($order->items as $supply)
      <tr>
        <td class="text-center">{{ $supply->supply->code }}</td>
        <td>{{ $supply->supply->name }}</td>
        <td class="text-right">{{ number_format($supply->quantity,4) }}</td>
        <td class="text-center">{{ $supply->supply->measurementUse->code }}</td>
        @if($order->type == 1)
        <td class="text-center">{{ $supply->excess }}</td>
        <td class="text-right">{{ number_format(($supply->quantity + ($supply->quantity * ($supply->excess / 100))),4) }}</td>
        <td class="text-center">{{ $supply->supply->measurementUse->code }}</td>
        @else
        <td class="text-right">{{ number_format(($supply->quantity * 100) / $totalSupplies,2) }}</td>
        <td class="text-center">%</td>
        @endif

        <td class="text-right">{{ number_format(((($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $order->quantity) / 1000),4)  }}</td>
        <td class="text-center">g</td>
        <td class="text-center">
         <?php
          if($supply->processed == 1){
            $ids = $supply->entrances()->pluck('entrance_number')->toArray();
            foreach ($ids as $id) { ?>
              {{ sprintf("%05s", $id) }},
            <?php
            }
          }else{
            echo "";
          }
         ?>
        </td>
      </tr>
      @php
      $totalFirst += $supply->quantity;
      $totalSecond += ($supply->quantity + ($supply->quantity * ($supply->excess / 100)));
      $totalThird += ($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $order->quantity;
      @endphp
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td></td>
        <td><b>Total</b></td>
        <td class="text-right"><b>{{ number_format($totalFirst,4) }}</b></td>
        <td class="text-center"><b>mg</b></td>
        @if($order->type == 1)
        <td></td>
        <td class="text-right"><b>{{ number_format($totalSecond,4) }}</b></td>
        <td class="text-center"><b>mg</b></td>
        @else
        <td class="text-right"><b>100.00</b></td>
        <td class="text-center">%</td>
        @endif
        <td class="text-right"><b>{{ number_format(($totalThird/ 1000),1) }}</b></td>
        <td class="text-center">g</td>
        <td></td>
      </tr>
    </tfoot>
  </table>

  <footer>
    <table style="width:100%;">
      <tbody>
        <tr>
          <td>Emite:</td>
          <td>_______________________________</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Verifica:</td>
          <td>________________________________</td>
        </tr>
        <tr>
          <td></td>
          <td class="text-center" style="font-size: 13px;">Planeación (Firma y fecha)</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-center" style="font-size: 13px;">Aseguramiento de Calidad (Firma y fecha)</td>
        </tr>
      </tbody>
    </table>
  </footer>

</body>

</html>