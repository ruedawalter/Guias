@extends('layouts.app')

@section('title', 'Guias')

@section('content')
  @if  (Auth::user()->id_rol == "3")
  <div class="container" style="width:100%">
    <div class="row justify-content-center">
    {{-- <div class="card"> --}}
      <div class="card-body">
        <div class="card-header">
          <div class="row">
            <div class="col clearfix">
              {{-- <div><span>{{$remitentes}}</span></div> --}}

              <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewguia" alt="Nuevo"> <i class="fas fa-plus"></i>  Nueva </a></span>
              <span class="float-left"><h1><i class="fas fa-truck"></i>   Guias</h1></span>
            </div>
          </div>
        </div>
        <hr>
        <p></p>
      <div class="alert Alert-success">
        <span><label type="hidden" name="alert" id="alert"></label></span>
      </div>
    <table class="table table-bordered data-table dt-responsive wrap" style="width:100%">
        <thead>
            <tr>
                <th width="1%">No</th>
                <th width="10%">Guia</th>
                <th width="30%">Cliente</th>
                <th width="30%">Remitente</th>
                <th width="10%">Estatus</th>
                <th width="9%">Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal">
                      <span>×cerrar</span>
                  </button>
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="guiaForm" name="guiaForm" class="form-horizontal">
                   <input type="hidden" name="guia_id" id="guia_id">
                   <input type="hidden" name="guia" id="guia">

                        {{-- <div class="form-group">
                          <div class="col clearfix ">
                            <span class="col-sm-8"><h3><label  id="guian" for="guian">Guía No. </label></h3></span>
                        </div> --}}

                        <div class="form-group">
                          <div class="col clearfix ">
                            <span class="col-sm-8"><label  for="fecha" >Fecha :</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="fecha" id="fecha"  value="" maxlength="10" placeholder="Fecha del envío"></span>
                        </div>

                        <div class="col clearfix">
                            <span class="float-left"><label  for="id_servicio" >Servicio :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_servicio" id="id_servicio"  class="form-control">
                              <option value="">--Seleccione Servicio--</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>

                        <div class="col clearfix">
                            <span class="float-left"><label  for="id_cliente" >Cliente :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_cliente" id="id_cliente"  class="form-control">
                              <option value="">--Seleccione Cliente--</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>

                          <div class="col clearfix">
                            <span class="float-left"><label  for="id_remitente" >Remitente :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_remitente" id="id_remitente"  class="form-control">
                              <option value="">--Seleccione Remitente--</option>
                                @foreach($remitentes as $remitente)
                                    <option value="{{$remitente->id}}">{{$remitente->name}}</option>
                                @endforeach
                            </select></span>
                          </div>

                          <div class="col clearfix">
                            <span class="float-left"><label  for="id_fpago" >Forma de Pago :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_fpago" id="id_fpago"  class="form-control">
                              <option value="">--Seleccione Método de Pago--</option>
                                @foreach($fpagos as $fpago)
                                    <option value="{{$fpago->id}}">{{$fpago->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>

                          <div class="col clearfix">
                            <span class="float-left"><label  for="monto" >Monto:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="number" name="monto" id="monto" value="" maxlength="10" placeholder="Monto" onkeypress="" onchange="total(this.value)"></span>
                            <span class="float-right"><label  for="smonto" >Monto Servicio:</label>
                            <input class="form-control bg-light shadow-sm " type="number" name="smonto" id="smonto" value="" maxlength="9" placeholder="Monto Servicio" onkeypress="" onchange="total(this.value)">
                            </span>
                          </div>
                          <div class="form-group">
                          <div class="col clearfix ">
                            <span class="col-sm-8"><h3><label  for="total" id="total">Total-->0.00</label></h3></span>
                        </div>
                      <p></p>
                          <div class="col clearfix">
                            <span class="float-left"><label  for="hdesde" >Hora inicio:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="hdesde" id="hdesde" value="" maxlength="10" placeholder="Desde hora" onkeypress=''/></span>
                            <span class="float-right"><label  for="hhasta" >Hora Fin:</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="hhasta" id="hhasta" value="" maxlength="9" placeholder="Hasta hora" onkeypress=''/>
                            </span>
                          </div>

                          <div class="col clearfix">
                            <span class="float-left"><label  for="obsguia" >Observaciones:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="obsguia" id="obsguia" value="" maxlength="10" placeholder="Observaciones de la Guía" onkeypress=''/></span>
                          </div>

                          <div class="col clearfix">
                            <span class="float-left"><label  for="id_estado" >Status :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_estado" id="id_estado"  class="form-control">
                              <option value="">--Seleccione Status--</option>
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach
                            </select></span>
                          </div>

                          <div class="col clearfix">
                            <span class="float-left"><label  for="id_agente" >Agente :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="id_agente" id="id_agente"  class="form-control">
                              <option value="">--Seleccione Agente--</option>
                                @foreach($agentes as $agente)
                                    <option value="{{$agente->id}}">{{$agente->name}}</option>
                                @endforeach
                            </select></span>
                          </div>
                        </div>
                    </div>
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

</body>
<script type="text/javascript">
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        language: {
             "url": "js/Spanish.json"
           },
        ajax: "{{ route('admguias.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'guia', name: 'guia'},
            {data: 'clientes_pk.nombre', name: 'clientes_pk.nombre'},
           {data: 'remitentes_pk.name', name: 'remitentes_pk.name'},
            {data: 'estados_pk.nombre', name: 'estados_pk.nombre'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewguia').click(function () {
        $('#saveBtn').val("create-guia");
        $('#guia_id').val('');
        $('#guiaForm').trigger("reset");
        $('#modelHeading').html("Nueva guia");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
        // $('#telefono').val('S/Tlf');
    });
    $('body').on('click', '.editguia', function () {
      var guia_id = $(this).data('id');
      $.get("{{ route('admguias.index') }}" +'/' + guia_id +'/edit', function (data) {
          var suma=(data.monto)+(data.smonto);

          $('#modelHeading').html('GuíaNo.'+(data.guia));
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#guia_id').val(data.id);
          $('#guia').val(data.guia);
          $('#fecha').val(data.fecha);
          $('#id_servicio').val(data.id_servicio);
          $('#id_cliente').val(data.id_cliente);
          $('#id_remitente').val(data.id_remitente);
          $('#id_fpago').val(data.id_fpago);
          $('#monto').val(data.monto);
          $('#smonto').val(data.smonto);
          $('#total').html('Total a cobrar ---> '+suma);
          $('#hdesde').val(data.hdesde);
          $('#hhasta').val(data.hhasta);
          $('#obsguia').val(data.obsguia);
          $('#id_agente').val(data.id_agente);
          $('#id_estado').val(data.id_estado);
          $('#fentrega').val(data.fentrega);
          $('#obsentrega').val(data.obsentrega);
          $('#saveBtn').html('Guardar');
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Guardando....');
        valguia();
        $.ajax({
          data: $('#guiaForm').serialize(),
          url: "{{ route('admguias.store') }}",
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
              $('#modelHeading').html("Error al guardar");
              console.log('Error:', data);
              $('#saveBtn').html('Guardar');
          }
      });
    });
    $('body').on('click', '.deleteguia', function () {
        var guia_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar esta guia?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('admguias.store') }}"+'/'+guia_id,
            success: function (data) {
                $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">guia eliminado correctamente</h6>');
                setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }

        });
        }
    });
  });
</script>
@else

  @include('layouts._denegado')

@endif
@endsection
