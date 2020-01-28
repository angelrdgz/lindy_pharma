<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Orden de Fabricación</title>
 <style>
   .text-center{
     text-align: center;
   }
     table.bordered{
         font-size: 10px;
     }
     table.bordered tr td{
     }

     table.item { 
    width: 750px; 
    border-collapse: collapse; 
    margin:50px auto;
    }
    table.item th { 
    background: #3498db; 
    color: white; 
    font-weight: bold; 
    }
    table.item td, table.item th { 
    padding: 10px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-size: 10px;
    }
    .qr{
      width: 100px;
      height: 100px;
    }
 </style>
</head>
<body>

<h1 class="text-center">Orden de Fabricación</h1>

  <table width="100%" class="bordered" style="width:100%;" border="0">
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
        <td>OT-{{ sprintf("%04s", $order->id)}}</td>
      </tr>
      <tr>
          <td>Código del granel:</td>
        <td>{{ $product->code }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="2">No. de lote	</td>
        <td rowspan="2">PM2001001</td>
      </tr>
      <tr>
          <td>Nombre del producto:</td>
        <td>{{ $product->name }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
          <td>Forma Farmacéutica:</td>
        <td> Cápsula de gelatina blanda</td>
        <td></td>
        <td></td>
        <td>Tamaño de Lote:</td>
        <td>{{ $order->quantity}}</td>
        <td>cápsulas	</td>
        <td></td>
        <td>Fecha de Fabricación:</td>
        <td> {{date('d/m/Y', strtotime($order->created_at))}} </td>
      </tr>
      <tr>
          <td>Código del granel:</td>
        <td>GPM0004</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Fecha de Caducidad:</td>
        <td>___________________________</td>
      </tr>
      <tr>
        <td>Fecha de emisión:</td>
        <td>07ENE20</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Peso de contenido:</td>
        <td>865,00</td>
        <td>mg</td>
        <td></td>
        <td>Molde:</td>
        <td>{{ $order->mold }}</td>
        <td></td>
        <td>Cliente:</td>
        <td>{{ $order->client }}</td>
        <td rowspan="3" class="text-center">
          <img class="qr" src="{{ public_path().'/images/qrcode/qrcode_'.$order->id.'.png' }}" alt="">
        </td>
      </tr>
      <tr>
        <td>Peso máximo:</td>
        <td>951,50</td>
        <td>mg</td>
        <td></td>
        <td>Tiempo de encapsulado:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Peso mínimo:</td>
        <td>778,50</td>
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
    <h4 class="text-center">CONTENIDO DE LA CAPSULA</h4>
    @else
    <h4 class="text-center">ENVOLVENTE DE LA CAPSULA</h4>
    @endif

    

    <table class="item" width="100%" class="bordered" style="width:100%" border="0">
      <thead>
        <tr>
          <th>Código del Insumo</th>
          <th>Descripción del Insumo</th>
          <th>Cantidad Unitaria</th>
          <th>UM</th>
          <th>Exceso (%)</th>
          <th>Cantidad Unitaria</th>
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

         if($order->type == 1){
           $supplies = $product->supplies;
         }else{
          $supplies = $product->suppliesCover;
         }
        @endphp
        @foreach($supplies as $supply)
         <tr>
           <td>{{ $supply->supply->code }}</td>
           <td>{{ $supply->supply->name }}</td>
           <td>{{ $supply->quantity }}</td>
           <td>{{ $supply->supply->measurementUse->code }}</td>
           <td>0.0</td>
           <td>{{ $supply->quantity }}</td>
           <td>{{ $supply->supply->measurementUse->code }}</td>
           <td>{{ number_format(($supply->quantity * $order->quantity),4)  }}</td>
           <td>{{ $supply->supply->measurementUse->code }}</td>
           <td>00004-3</td>
         </tr>
         @php
         $totalFirst += $supply->quantity;
         $totalSecond += $supply->quantity;
         $totalThird += $supply->quantity * $order->quantity;
         @endphp
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td><b>Total</b></td>
          <td><b>{{ number_format($totalFirst,4) }}</b></td>
          <td></td>
          <td></td>
          <td><b>{{ number_format($totalSecond,4) }}</b></td>
          <td></td>
          <td><b>{{ number_format($totalThird,4) }}</b></td>
          <td></td>
          <td></td>
        </tr>
      </tfoot>
    </table>

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

</body>
</html>