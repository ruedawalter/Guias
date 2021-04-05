@extends('layouts.app')

@section('title', 'guias')

@section('content')
  @if  (Auth::user()->id_rol == "2")
  <div class="container" style="width:100%">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-8 col-sm-4 mx-auto">
    {{-- <div class="card"> --}}
      <div class="card-body">
        <div class="card-header">
          <div class="row">
            <div class="col clearfix">

              <!-- <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewguia" alt="Nuevo"> <i class="fas fa-plus"></i>  Nueva Guía </a></span> -->
              <span class="float-left"><h1><i class="fas fa-truck"></i>   Guias</h1></span>
            </div>
          </div>
        </div>
        <hr>

        <hr>
        <div class="col clearfix">
          <span class="float-left"><h3><i class="fas fa-tag"></i>   Remitente: {{Auth::user()->name}}</h3></span>
        </div>
        <hr>
          <div class="card-body">
          <div class="card-header">
            <div class="col clearfix" >

                  <span class="float-left" style=" margin: 3px;"><a href="javascript:void(0)" id="reporterem" class ="btn btn-sm btn-success" alt="Reporte Guias Remitente"><i class="fas fa-print"></i>  <i class="fas fa-tag"></i>  Reporte Guias Remitente</a> </span>
                  <span style="color: red">{{ session('message') }}</span>

                </div>
              </div>
            </div>
        <hr>
      <div class="alert Alert-success">
        <span><label type="hidden" name="alert" id="alert"></label></span>
      </div>
    <table class="table table-bordered data-table table-responsive  mx-auto nowrap" style="width:100%">
        <thead>
            <tr>
                {{-- <th width="1%">No</th> --}}
                <th width="5%">Fecha</th>
                <th width="5%">Guia</th>
                <th width="25%">Cliente</th>
                <th width="25%">Celular</th>
                <th width="15%">Estatus </th>
                <th width="10%">Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
</div>
</div>

<div class="modal fade " id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content col-lg-12 col-md-8  col-sm-4 mx-auto">
                  <button type="button" class="close" data-dismiss="modal">
                      <span>×cerrar</span>
                  </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body  mx-auto">
                <form id="guiaForm" name="guiaForm" class="form-horizontal">
                   <input type="hidden" name="guia_id" id="guia_id">
                   <input type="hidden" name="guia" id="guia">
                   <input type="hidden" name="estado" id="estado">
                   <input type="hidden" name="id_remitente" value="{{Auth::user()->id}}" id="id_remitente">
                   @if(!empty($ultid))
                      <input type="hidden" name="guid" id="guid" value={{$ultid->id}}>
                   @else
                      <input type="hidden" name="guid" id="guid" value=0>
                   @endif
                    <div class="form-group">
                          <div class="col clearfix">
                            <span class="float-left" style="width:45%"><label  for="fecha" >Fecha :</label>
                            <input class="form-control datepicker bg-light shadow-sm  " type="text" name="fecha" id="fecha"  value="" maxlength="10" placeholder="Fecha del envío"></span>
                        {{-- </div> --}}
                        {{-- <div class="col clearfix"> --}}
                            <span class="float-right" style="width:50%"><label  for="id_servicio" >Servicio :</label>
                            <select class="form-control bg-light shadow-sm" name ="id_servicio" id="id_servicio"  class="form-control">
                              <option value="">--Seleccione Servicio--</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>
                          <p></p>
                          <hr>

                        <div class="col clearfix">
                            <span style="width:100%"><label  for="id_cliente" >Cliente :</label>
                            <select class="form-control bg-light shadow-sm" name ="id_cliente" id="id_cliente"  onchange="">
                              <option value="" >--Seleccione Cliente--</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>

                                @endforeach
                            </select> </span>
                          </div>
                          <p></p>
                          <div class="col clearfix">
                          <span class="float-left" style="width:100%"><label name="dircli" id="dircli"></label></span>
                          </div>
                          <div class="col clearfix">
                          <span class="float-left" style="width:100%"><label name="telcli" id="telcli"></label></span>
                          <span class="float-rigth" style="width:100%"><label name="celcli" id="celcli"></label></span>
                          </div>
                          <p></p>
                          <hr>
                          <div class="col clearfix">
                            <span class="float-left" style="width:33%"><label  for="monto" >Monto:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="number" name="monto" id="monto" value="" maxlength="10" placeholder="Monto" onkeypress="suma(this.value);" onchange="suma(this.value)"></span>
                            <span class="float-left" style="width:33%"><label  for="smonto" >Servicio:</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="smonto" id="smonto" value="" maxlength="9" placeholder="Monto Servicio"  readonly="true">
                            </span>
                            <span class="float-right" style="width:33%"><label  for="total" >Total:</label>
                              <input class="form-control bg-light shadow-sm " type="text" name="total" id="total" value="" maxlength="" readonly="true"></span>
                          </div>
                          <p></p>
                          <div class="col clearfix">
                            <span ><label  for="id_fpago" >Forma de Pago :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_fpago" id="id_fpago"  class="form-control">
                              <option value="">--Seleccione Método de Pago--</option>
                                @foreach($fpagos as $fpago)
                                    <option value="{{$fpago->id}}">{{$fpago->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>
                          <p></p>
                          <hr>

                          <div class="col clearfix">
                            <span class="float-left" style="width:45%"><label  for="hdesde" >Hora inicio:</label>
                            <input class="form-control datetimepicker bg-light shadow-sm "style="" type="time" name="hdesde" id="hdesde" value="" maxlength="10" placeholder="Desde hora" onkeypress='' min="8:00" max="18:00" step="3600" onkeypress='return numeros(event)'/></span>
                            <span class="float-right" style="width:45%"><label  for="hhasta" >Hora Fin:</label>
                            <input class="form-control timepicker bg-light shadow-sm " type="time" name="hhasta" id="hhasta" value="" maxlength="9" placeholder="Hasta hora" onkeypress='' min="8:00" max="18:00" step="3600" onkeypress='return numeros(event)'/>
                            </span>
                          </div>
                            <p></p>
                          <div class="col clearfix">
                            <span class="float-left" style="width:50%"><label  for="obsguia" >Observaciones:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="obsguia" id="obsguia" value="" maxlength="100" placeholder="Observaciones de la Guía" onkeyup="mayusculas(this);"></span>
                          </div>
                          <p></p>
                          <hr>
                          <div class="col clearfix">
                            <span class="float-left" style="width:100%"><label  for="id_estado" >Status :</label>
                            <select class="form-control bg-light shadow-sm col-12" disabled="true" name ="id_estado" id="id_estado"  class="form-control">
                              <option value="">--Seleccione Status--</option>
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>

                          <p></p>
                          <div class="col clearfix">
                            <span class="float-left" style="width:40%"><label  for="fentrega" >Entregado:</label>
                            <input class="form-control datepicker bg-light shadow-sm "style="" type="text" name="fentrega" id="fentrega" value="" maxlength="10" placeholder="" onkeypress=''/ readonly="true"></span>

                            <span class="float-right"style="width:50%"><label  for="obsentrega" >Observaciones:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="obsentrega" id="obsentrega" value="" maxlength="100" placeholder="" readonly="true" onkeyup="mayusculas(this);"/></span>
                          </div>
                        </div>
                    </div>
                    <p></p>
                    <p class="text-black-50"><label id="act" name="act" ></label></p>
                    <div align="center">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
                     </button>
                    </div>
                    <p></p>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
{{-- </div> --}}
<div class="modal fade " id="viewModel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content col-lg-12 col-md-8  col-sm-4 mx-auto">
                  <button type="button" class="close" data-dismiss="modal">
                      <span>×cerrar</span>
                  </button>
            <div class="modal-header">
                <h4 class="modal-title" id="viewModelHeading"></h4>
            </div>
            <div class="modal-body  mx-auto">
                <form id="viewForm" name="guiaForm" class="form-horizontal">
                   <input type="hidden" name="vguia_id" id="guia_id">
                   <input type="hidden" name="vguia" id="guia">
                   <input type="hidden" name="estado" id="estado">
                   <input type="hidden" name="id_remitente" value="{{Auth::user()->id}}" id="id_remitente">
                   @if(!empty($ultid))
                      <input type="hidden" name="guid" id="guid" value={{$ultid->id}}>
                   @else
                      <input type="hidden" name="guid" id="guid" value=0>
                   @endif
                    <div class="form-group">
                          <div class="col clearfix">
                            <span class="float-left col-4"><label  id="fecha1" ></label></span>
                            <span class="float-right"><label  id="id_servicio1" >:</label></span>
                          </div>
                          <hr>

                        <div class="col clearfix">
                            <span><label  id="id_cliente1" ></label></span>
                          </div>
                          <p></p>
                          <div class="col clearfix">
                          <span class="float-rigth"><label name="dircli" id="dircli1"></label></span>
                          </div>
                          <div class="col clearfix">
                          <span class="float-rigth"><label name="telcli" id="telcli1"></label></span>
                          <span class="float-rigth"><label name="celcli" id="celcli1"></label></span>
                          </div>
                          <p></p>
                          <hr>
                          <div class="col clearfix">
                            <span class="float-left col-4"><label  id="monto1" ></label></span>
                            <span class="float-left col-4"><label  id="smonto1" ></label></span>
                            <span class="float-right col-4"><label  id="total1" ></label></span>
                          </div>
                           <div class="col clearfix">
                          <span ><label  id="id_fpago1" ></label></span>
                          </div>
                          <p></p>
                          <hr>

                          <div class="col clearfix">
                            <span class="float-left "><label id="hdesde1" ></label></span>
                            <span class="float-rigth "><label  id="hhasta1" ></label></span>
                          </div>
                          <div class="col clearfix">
                            <span class="float-left"><label  id="obsguia1" ></label></span>
                          </div>
                          <p></p>
                          <hr>
                          <div class="col clearfix">
                            <span><label  id="id_estado1" ></label></span>
                          </div>
                          <div class="col clearfix">
                            <span class="float-left"><label  id="fentrega1" ></label></span>
                            <span class="float-left"><label  id="obsentrega1" ></label>
                            </span>
                          </div>
                        </div>
                    </div>
                    <p></p>
                    <p class="text-black-50"><label id="act" name="act" ></label></p>
                    <p></p>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>


{{-- </modal de vista --}}
{{-- Inicio reporte remitente --}}
<div class="modal fade " id="PdfGuiasRem" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content col-lg-12 col-md-8  col-sm-4 mx-auto">
                  <button type="button" class="close" data-dismiss="modal">
                      <span>×cerrar</span>
                  </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body  mx-auto">
                <form id="PdfFormRem" name="PdfFormRem" class="form-horizontal" method="POST" action="{{ route('PdfguiaRem') }}">
                  <input type="hidden" name="_method" value="PUT">
                  @csrf
                     <div class="form-group">
                          <div class="col clearfix">
                            <span class="float-center" style="width:45%"><label  for="fecha" >Fecha :</label>
                            <input class="form-control datepicker bg-light shadow-sm  " type="text" name="fechain" id="fechain"  value="" maxlength="10" placeholder="Fecha Inicio"></span>
                           {{--  <span class="float-right" style="width:45%"><label  for="fechafin" >Fecha fin :</label> --}}
                            {{-- <input class="form-control datepicker bg-light shadow-sm  " type="text" name="fechafin" id="fechafin"  value="" maxlength="10" placeholder="Fecha Fin"></span> --}}
                          </div>
                          {{-- <div class="form-group">
                          <div class="col clearfix">
                            <span class="float-center" style="width:45%"><label  for="id_remitenter" >Remitente :</label>
                           <select class="form-control bg-light shadow-sm col-12" name ="id_remitenter" id="id_remitenter"  class="form-control">
                              <option value="">--Seleccione Remitente--</option>
                                @foreach($remitentes as $remitentes)
                                    <option value="{{$remitentes->id}}">{{$remitentes->name}}</option>
                                @endforeach
                            </select>
                          </div> --}}

                    <hr>
                    <hr>
                    <div align="center">
                     <button type="submit" class="btn btn-primary" id="printremBtn" value="create">Generar Reporte
                     </button>
                    </div>
                   <hr>
                    <hr>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

{{-- Fin modal impresion por remitente --}}

</body>

<script type="text/javascript">

  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        order: [0, 'desc'],
        processing: true,
        serverSide: true,
        language: {
             "url": "js/Spanish.json"
           },
        ajax: "{{ route('remguias.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'fecha', name: 'fecha'},
            {data: 'guia', name: 'guia'},
            {data: 'clientes_pk.nombre', name: 'clientes_pk.nombre'},
            {data: 'clientes_pk.cel', name: 'clientes_pk.cel'},
            {data: 'estados_pk.nombre', name: 'estados_pk.nombre'},
            {data: 'action', name: 'action', orderable: true, searchable: false},
        ]
    });
    $('#createNewguia').click(function () {
        $('#saveBtn').val("create-guia");

        $('#guia_id').val('');
        $('#estado').val(6);
        $('#guiaForm').trigger("reset");
        $('#id_servicio').prop('disabled',false);
        $('#id_cliente').prop('disabled',false);
        $('#dircli').html('');
        $('#telcli').html('');
        $('#celcli').html('');
        $('#dirrem').html('');
        $('#telrem').html('');
        $('#celrem').html('');
        $('#fentrega').prop("disabled",true);
        $('#modelHeading').html("Nueva guia");
        $('#ajaxModel').modal('show');
        $('#total').val('0.00');
        $('#act').html('');
        $('#saveBtn').html('Guardar');
    });

    $('body').on('click', '.editguia', function () {
      var guia_id = $(this).data('id');
      $.get("{{ route('remguias.index') }}" +'/' + guia_id +'/edit', function (data) {
          var suma=(data[0].monto)+(data[0].smonto);
          $('#modelHeading').html('Guia No. '+(data[0].guia));
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#guia_id').val(data[0].id);
          $('#guia').val(data[0].guia);
          $('#fecha').val(data[0].fecha);
          $('#id_servicio').val(data[0].id_servicio);
          $('#id_servicio').prop('disabled',true);
          $('#id_cliente').val(data[0].id_cliente);
          $('#id_cliente').prop('disabled',true);
          $('#id_remitente').val(data[0].id_remitente);
          $('#id_fpago').val(data[0].id_fpago);
          $('#monto').val(data[0].monto);
          $('#smonto').val(data[0].smonto);
          $('#total').val(suma);
          $('#hdesde').val(data[0].hdesde);
          $('#hhasta').val(data[0].hhasta);
          $('#id_agente').val(data[0].id_agente);
          $('#obsguia').val(data[0].obsguia);
          $('#estado').val(data[0].id_estado);
          $('#id_estado').val(data[0].id_estado);
          $('#fentrega').val(data[0].fentrega);
          $('#fentrega').prop("disabled",true);
          $('#obsentrega').val(data[0].obsentrega);
          $('#dircli').html('Dirección: '+(data[0].direccionc)+",  "+(data[0].distrito));
          $('#telcli').html('Teléfono: '+(data[0].telefonoc));
          $('#celcli').html('Teléfono: '+(data[0].celc));
          $('#act').html('Actualizado: '+(data[0].updated_at));
          $('#saveBtn').html('Guardar');
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Guardando....');
        actinputrem();
        valguia();
        $.ajax({
          data: $('#guiaForm').serialize(),
          url: "{{ route('remguias.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">guia guardada  correctamente</h6>');
                setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);

              $('#guiaForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
        },
          error: function (data) {
            alert('Error: Revise la informacion ingresada');
              $('#modelHeading').html("Error al guardar, revise la informacion ingresada");
              console.log('Error:', data);
              $('#saveBtn').html('Guardar');
          }
      });
    });
// inicio View
$('body').on('click', '.deleteguia', function () {
      var guia_id = $(this).data('id');
      $.get("{{ route('remguias.index') }}" +'/' + guia_id +'/edit', function (data) {
          if ((data[0].smonto) == null){
            (data[0].smonto) = 0;
          }
          var suma=(data[0].monto)+(data[0].smonto);
          $('#viewModelHeading').html('Guia No. '+(data[0].guia));
          $('#saveBtn').val("edit-user");
          $('#viewModel').modal('show');
          $('#guia_id').val(data[0].id);
          $('#guia').val(data[0].guia);
          $('#fecha1').html('Fecha: '+(data[0].fecha));
          $('#id_servicio1').html('Servicio:  ' + (data[0].snombre));
          $('#id_cliente1').html('Cliente:  ' + (data[0].cliente));
          $('#id_remitente').val(data[0].id_remitente);
          $('#id_fpago1').html('Forma de Pago:  ' + (data[0].fpago));
          $('#monto1').html('Monto: '+ (data[0].monto));
          $('#smonto1').html('Servicio: '+(data[0].smonto));
          $('#total1').html('Total: ' + suma);
          if ((data[0].hdesde) == null){
            $('#hdesde1').html('Desde: 00:00');
          }else {
            $('#hdesde1').html('Desde: '+ (data[0].hdesde));
          }
          if((data[0].hhasta) == null){
          $('#hhasta1').html('A: 00:00');
          }else {
            $('#hhasta1').html('A: '+ (data[0].hhasta));
          }
          if (((data[0].obsguia))==null){
            $('#obsguia1').html('Observaciones: Sin Observaciones ') ;
          } else{
            $('#obsguia1').html('Observaciones: ' +(data[0].obsguia));
          }

          $('#id_estado1').html('Status:  '+ (data[0].estado));
          if ((data[0].fentrega)==null){
            $('#fentrega1').html('Fecha de la entrega: Pendiente');
          }else{
            $('#fentrega1').html('Fecha de la entrega: '+ (data[0].fentrega));
          }
          if ((data[0].obsentrega)==null){
            $('#obsentrega1').html('Observaciones de la entrega: Sin Observaciones');
          }else{
            $('#obsentrega1').html('Fecha de la entrega: '+ (data[0].obsentrega));
          }
          $('#dircli1').html('Dirección: '+(data[0].direccionc)+",  "+(data[0].distrito));
          $('#telcli1').html('Teléfono: '+(data[0].telefonoc));
          $('#celcli1').html('Celular: '+(data[0].celc));
          $('#act1').html('Actualizado: '+(data[0].updated_at));

      })
   });

// fin View



  });

    $('#id_cliente').change(function(){
        var cod = document.getElementById("id_cliente").value;
        var id = document.getElementById("id_cliente").value;

        $.ajax({
            url : "{{ route('remguias.show') }}"+"/"+id,
            // data : {id:id},
            type : 'GET',
            dataType : 'json',
            success : function(data) {
                // alert((data['0'].distrito));
                $('#dircli').html('Direccion:  '+(data['0'].direccion) +",   "+(data['0'].distrito));
                $('#telcli').html('Teléfono:  '+(data['0'].telefono));
                $('#celcli').html('Celular:  '+(data['0'].cel));

                // alert('pasado');
            },
             error: function(jqXHR,error, errorThrown) {
               if(jqXHR.status&&jqXHR.status==500){
                    alert(jqXHR.responseText);
               }else{
                   alert(jqXHR.responseText);
               }
          }
        })
    });

    // Reporte remitentes
  $('#reporterem').click(function () {
        $('#printremBtn').val("create-guia");
        $('#PdfFormRem').trigger("reset");
        $('#fechain').val('');
        $('#fechafin').val('');
        $('#modelHeading').html("Reporte PDF");
        $('#PdfGuiasRem').modal('show');
        $('#printremBtn').html('Generar');
    });

        $('#printremBtn').click(function (e){
          if (($('#fechain').value) == ''){
            alert('Por Favor Seleccione una fecha válida');

          }
        });
// Fin Reporte remitentes


</script>
@else

  @include('layouts._denegado')

@endif
@endsection
