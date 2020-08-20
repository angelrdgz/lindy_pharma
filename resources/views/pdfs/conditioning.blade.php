<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Orden de Acondicionamiento</title>
 <style>
   @page{
     margin: 15px;
   }
   body{
    font-family: sans-serif;
   }
   .text-center{
     text-align: center;
   }
   .text-right{
     text-align: right;
   }
   .ot{
     background: #ccc;
     font-size: 20px;
     text-transform: uppercase;
   }
   .lot{
     background: #ccc;
     border: 1px solid #000;
     font-size: 20px;
     text-transform: uppercase;
   }
     table.bordered{
         font-size: 10px;
     }
     table.bordered tr td{
     }

     table.item { 
    width: 100%; 
    border-collapse: collapse; 
    margin: 0px auto;
    font-size:9px;
    }
    table.item th { 
    background: #ccc; 
    border: 1px solid #888; 
    color: #000; 
    font-weight: bold; 
    }
    table.item td, table.item th { 
    padding: 10px; 
    border: 1px solid #888;
    font-size: 9px;
    }
    .logo{
      width: 100px;
    }
    .qr{
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
         <h2 class="text-center ">ORDEN DE ACONDICIONAMIENTO</h2>
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
        <td class="ot text-right">{{ sprintf("%05s",  $order->id) }}/1.0</td>
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
        <td rowspan="2">No. de lote	</td>
        <td class="lot text-center" rowspan="2">{{ $order->lot}}</td>
      </tr>
      <tr>
          <td>Código de producto:</td>
        <td colspan="4"><b>{{ $order->product->code }}</b></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
          <td>Nombre del producto:</td>
        <td colspan="4"><b>{{ $order->product->name }}</b></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
          <td>Forma Farmacéutica:</td>
        <td colspan="2"> {{ $order->form }} </td>
        <td></td>
        <td colspan="2">Tamaño de Lote:</td>
        <td class="text-right"><b>{{ number_format($order->quantity) }}</b></td>
        <td></td>
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
        <td>{{ date('d', strtotime($order->date_expire)).' de '.$months[date('n', strtotime($order->date_expire))].' de '.date('Y', strtotime($order->date_expire))}}</td>
      </tr>
      <tr>
        <td>Fecha de emisión:</td>
        <td colspan="4"><b>{{ $days[date('N', strtotime($order->created_at))].', '.date('d', strtotime($order->created_at)).' de '.$months[date('n', strtotime($order->created_at))].' de '.date('Y', strtotime($order->created_at))}}</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Precio Máximo al publico</td>
        <td>${{ number_format($order->price, 4) }}</td>
      </tr>
      <tr>
        <td>Presentación:</td>
        <td>{{ $order->presentation }}</td>
        <td></td>
        <td></td>
        <td></td>        
        <td>Cliente:</td>
        <td colspan="2">{{ $order->client->name }}</td>
        <td></td>
      </tr>
    </table>
    <h4 class="text-center" style="margin-top:45px; margin-bottom: 0px;">INSUMOS REQUERIDOS</h4>
    <table class="item" width="100%" class="bordered" border="0">
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
        </tr>
      </thead>
      <tbody>
        @foreach($order->product->recipes as $recipe)
         <tr>
           <td class="text-center">{{ $recipe->recipe->code }}</td>
           <td>{{ $recipe->recipe->name }}</td>
           <td class="text-right">{{ number_format($recipe->quantity,4) }}</td>
           <td class="text-center">caps</td>
           <td class="text-center">{{ $recipe->excess }}</td>
           <td class="text-right">{{ number_format(($recipe->quantity + ($recipe->quantity * ($recipe->excess / 100))),4) }}</td>
           <td class="text-center">caps</td>
           <td class="text-right">{{ number_format((($recipe->quantity + ($recipe->quantity * ($recipe->excess / 100))) * $order->quantity),4)  }}</td>
           <td class="text-center">caps</td>
         </tr>
        @endforeach
        @foreach($order->supplies as $supply)
         <tr>
           <td class="text-center">{{ $supply->supply->code }}</td>
           <td>{{ $supply->supply->name }}</td>
           <td class="text-right">{{ number_format($supply->quantity,4) }}</td>
           <td class="text-center">{{ $supply->supply->measurementUse->code }}</td>
           <td class="text-center">{{ $supply->excess }}</td>
           <td class="text-right">{{ number_format(($supply->quantity + ($supply->quantity * ($supply->excess / 100))),4) }}</td>
           <td class="text-center">{{ $supply->supply->measurementUse->code }}</td>
           <td class="text-right">{{ number_format(((($supply->quantity + ($supply->quantity * ($supply->excess / 100))) * $order->quantity)),4)  }}</td>
           <td class="text-center">{{ $supply->supply->measurementUse->code }}</td>
         </tr>
        @endforeach
      </tbody>
    </table>
    <br>
    <br>
    <br>
    <img class="qr" src="{{ public_path().'/images/qrcode/packing/qrcode_packing_'.$order->id.'.png' }}" alt="">

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

