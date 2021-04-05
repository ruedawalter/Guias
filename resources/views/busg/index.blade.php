@extends('layouts.app')

@section('content')
<p></p>
<p></p>
<hr>
<body class="h-100 bg-alert">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-sm-8 align-self-center text-center">
                <div class="card shadow ">
                    <div class="card-body shadow">
                        <form id="estadoForm" name="estadoForm" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <h3><label for="buscar" class="col-sm-12 control-label">Ingrese el código de la guía</label></h3>
                                {{-- <div class="col-4 abs-center"> --}}
                                    <input type="text" class="form-control col-sm-3 mx-auto" id="guia" name="guia" placeholder="Ingrese el codigo de su guia" value="" maxlength="15" required title="Por favor ingresa el número de la guía" />
                                {{-- </div> --}}
                            </div>
                            <div class="col clearfix">
                             <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Buscar</button>
                             <a class="btn btn-secondary my-auto" href="https://gutierrezcourier.com"  alt="Volver">  Regresar </a>
                            </div>
                        </form>
                        <p></p>
                    {{-- data --}}
                        <div class="container h-80" id="datos" hide="true">
                            <div class="row justify-content-center h-80">
                                <div class="col-sm-8 align-self-center text-center">
                                    <div class="card shadow " >
                                        <div class="card-body shadow-lg" >
                                            <div class="clear-fix"><b><span class="float-left"><label id="guiab"></label></span></b>
                                            <b><span class="float-right"><label id="fecha"></label></span></b>
                                            </div>

                                            <div class="clear-fix">
                                                <span class="float-left col-12"><label id="servicio"></label></span>
                                            </div>

                                            <div class="col clear-fix"><i><b><span class="float-left"><label id="cliente"></label></span></b></i></div>

                                            <div class="col clear-fix">
                                            <span class="float-left"><label id="dircliente"></label></span>
                                            </div>

                                            <div class="col clear-fix">
                                            <span class="float-left"><label id="telcliente"></label></span>
                                            </div>
                                            <p></p>

                                            <div class="col clear-fix">
                                            <span class="float-left col-6"><label id="celcliente"></label></span>
                                            </div>


                                            <div class="col clear-fix">
                                            <span class="float-left"><label id="fechaestado"></label></span>
                                            </div>

                                            <div class="col clear-fix">
                                            <b><span class="float-left col-6"><label id="estado"></label></span></b><div>
                                            </div>

                                            <div class="col clear-fix">
                                            <span class="float-left"><label id="obs"></label></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- data --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
   </body>


   <script>
   $('#saveBtn').click(function (e) {
        e.preventDefault();
        var guia = $('#guia').val();
        var id =  guia;

        $(this).html('Buscando....');
        $.ajax({
          data: $('#estadoForm').serialize(),
          url: "{{ route('busg.edit') }}" +'/' + id +'/edit',
          type: "GET",
          dataType: 'json',
          success: function (data) {

              $('#datos').show(500);
              $('#saveBtn').html('Buscar');
              if (data[0] == null){
                $('#guiab').html('No se encontraron datos con la Guia No   ' + id);
              }else{
                    $('#guiab').html('Guía:  ' + id);
                    $('#guiab').html('Guía:  ' + (data[0].guia));
                    $('#fecha').html('Fecha:  ' + (data[0].fecha));
                    $('#servicio').html('Servicio:  ' + (data[0].snombre));
                    $('#celcliente').html('Cliente:  ' + (data[0].celc));
                    $('#cliente').html('Cliente:  ' + (data[0].cliente));
                    $('#dircliente').html('Dirección:  ' + (data[0].direccionc) + ', ' + (data[0].distrito));
                    $('#telcliente').html('Teléfono:  ' + (data[0].telefonoc));
                    $('#celcliente').html('Celular:  ' + (data[0].celc));
                    if ((data[0].fentrega) == null){
                        $('#fechaestado').html('Fecha de Entrega sin actualizar ');
                    }else{
                        $('#fechaestado').html('Fecha de Entrega: ' + (data[0].fentrega));

                    }
                    if ((data[0].obsentrega) == null){
                        $('#obs').html('Sin Observaciones de entrega ');
                    }else{
                        $('#obs').html('Observaciones de entrega: ' + (data[0].obsentrega));

                    }
                    if ((data[0].estado) == null){
                        $('#estado').html('Sin actualización de Status');
                    }else{
                        $('#estado').html('Estado: ' + (data[0].estado));

                    }

              }
        },
          error: function() {
                var txt = $('#guia').value;
               if (txt.length == 0 ){
                Alert('Ingrese el código de la Guía, Por Favor...')
                $('#saveBtn').html('Buscar');
                return false;
               }

          }
      });
    });
   // $('#guia').click(function (e) {

   // }
   $(document).ready(function()  {
    $('#datos').hide();
    $("#guia").focus(function(){
        $('#guia').val('');
        $('#guiab').html('');
        $('#fecha').html('');
        $('#cliente').html('');
        $('#dircliente').html('');
        $('#telcliente').html('');
        $('#celcliente').html('');
        $('#servicio').html('');
        $('#fechaestado').html('');
        $('#obs').html('');
        $('#estado').html('');

        // $('#datos').hide(3000);
        $('#datos').hide(750);

    });
});
</script>
@endsection
