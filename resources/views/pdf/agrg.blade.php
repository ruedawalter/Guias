<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="referrer" content="no-referrer" />
	<title>Reporte de Guias Agentes</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style type="text/css">
  		@page {
  			size: 29.7cm 21cm;
  			margin: 0cm;
  			font-size: 12px;
        font-family: Arial, Helvetica, Verdana;

  		}
  		body {
        font-size: 12px;
        font-family: Arial, Helvetica, Verdana;
        margin-top: 3cm;
        margin-left:0cm;
        margin-right: 0cm;
        margin-bottom: 3cm;

  		}
  		header {
  			position: fixed;
  			top: 1cm;
  			left:1cm;
  			right: 1cm;
  			height: 1cm;
  			/*background-color: #2f069d;*/
  			color: #fe5442;
  			text-align: left;
  			line-height: 25px;
        font="Comic Sans MS, Arial, MS Sans Serif";
  		}
  		footer {
  			position: fixed;
  			bottom: 0cm;
  			left:0cm;
  			right: 0cm;
  			height: 1cm;
  			background-color: #2f069d;
  			color: #fe5442;
  			text-align: center;
  			line-height: 25px;
  		}
  		.page-break {
    			page-break-after: always;
		}
    .total {
      color:blue;
      font-size: 18px;
      text-align: right;


    }
	</style>
</head>
<body>
	<header>
		<img alt="Gutierrez Courier" src="img/logo.png" width="50" height="50" ><p><strong>Control de Guias V-1.0</p></strong>
	</header>
<div class="container">
	<h3 style="text-align: center">Reporte de Guias - Agentes</h3>
  <h3 style="text-align: left">Agente:   {{ $guias[0]->agente }} </h3>


<table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Guia</th>
      <th scope="col">Cliente</th>
      <th scope="col">Distrito</th>
      <th scope="col">Remitente</th>
      <th scope="col">Monto</th>
      <th scope="col">Monto Servicio</th>
      <th scope="col">Monto a cobrar</th>
      {{-- <th scope="col">Agente</th> --}}

    </tr>
  </thead>
  <tbody>
    @php
        $totalm=0;
        $totals=0;
        $totalc=0;
    @endphp
  	@foreach($guias as $guias)
        @php
          $totalm+=$guias->monto;//sumanos los valores, ahora solo fata mostrar dicho valor
          $totals+=$guias->smonto;
          $totalc=$totalm + $totals;
        @endphp
   <tr>
      <th scope="row">{{ $guias->fecha }}</th>
      <td>{{ $guias->guia }}</td>
      <td>{{ $guias->cliente }}</td>
      <td>{{ $guias->distrito }}</td>
      <td>{{ $guias->remitente }}</td>
      <td>{{ number_format($guias->monto, 2) }}</td>
      <td>{{ number_format($guias->smonto, 2) }}</td>
      <td>{{ number_format($guias->totald, 2) }}</td>
      {{-- <td>{{ $guias->agente }}</td> --}}

    </tr>

    @endforeach

  </tbody>

</table>


{{-- @php
    $suma=0;
@endphp
 <table>
   <tr>
     <td>
        @foreach($guias as $guias)
        @php
          $suma+=$guias->monto;//sumanos los valores, ahora solo fata mostrar dicho valor
        @endphp
      @endforeach
      {{$suma}}
     </td>
   </tr>
 </table>
 <td>

     {{--  @foreach ($guias as $g)
        @php
        $g;
          // $suma+=$g;//sumanos los valores, ahora solo fata mostrar dicho valor
        @endphp
      @endforeach
      {{$suma}} --}}

 </td>

  <div class="total">Total  Remitente --> <strong>{{(number_format($totalm,2))}}</strong> </div>
  <div class="total">Total  servicio    --> <strong>{{(number_format($totals,2))}}</strong>  </div>
  <div class="total">Total  a reportar     --> <strong>{{(number_format($totalc,2))}}</strong>  </div>

</div>



<script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(730, 570, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
                $pdf->text(62, 570, "https://gutierrezcourier.com" , $font, 10);
            ');
        }
    	</script>
</body>
</html>