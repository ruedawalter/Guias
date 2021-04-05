@extends('layouts.app')

@section('title', 'Remitentes')

@section('content')<div class="container">
  @if  (Auth::user()->id_rol == "3" or Auth::user()->id_rol == "2")
  <div class="container" style="width:100%">
  <div class="row">
    <div class="col clearfix">
      {{-- <span>{{($prueba[0]->distritos_pk->distrito)}}</span> --}}
      <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewremitente" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
      <span class="float-left"><h1><i class="fas fa-tag"></i>   Remitentes</h1></span>
    </div>
  </div>
    <hr>
    <p></p>
      <div class="alert Alert-success">
        <span><label type="hidden" name="alert" id="alert"></label></span>
      </div>
    <table class="table table-bordered data-table dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th width="5px">No</th>
                <th>remitente</th>
                <th width="160px">Distrito</th>
                <th width="60px">Código</th>
                <th width="60px">Móvil </th>
                <th width="40px">Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
                <form id="remitenteForm" name="remitenteForm" class="form-horizontal">
                   <input type="hidden" name="remitente_id" id="remitente_id">
                    <div class="form-group">
                          <div class="col clearfix ">
                            <span class="float-left"><label  for="nombre" >Nombres :</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="nombre" id="nombre" onkeyup="mayusculas(this);" value="" maxlength="60" placeholder="Nombre del remitente"></span>

                            <span class="float-right"><label  for="email" >Correo Electrónico :</label>
                            <input class="form-control bg-light shadow-sm "style="" type="email" name="email" id="email" onkeyup="minusculas(this);" value="" maxlength="100" placeholder="Email del remitente"></span>
                          </div>
                          <p></p>
                        <div class="">
                            <span class=""><label  for="direccion" >Direción:</label>
                            <input class="form-control input-lg bg-light shadow-sm"style="" type="text" name="direccion" id="direccion" onkeyup="mayusculas(this);" value="" maxlength="100" placeholder="Dirección del remitente"></span>
                        </div>
                            <p></p>

                        <div class="col clearfix">
                            <span class="float-left"><label  for="distrito_id" >Distrito :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="distrito_id" id="distrito_id"  class="form-control">
                              <option value="">--Seleccione Distrito--</option>
                                @foreach($distritos as $distrito)
                                    <option value="{{$distrito->id}}">{{$distrito->distrito}}</option>
                                @endforeach
                            </select></span>
                          </div>
                          <p></p>
                          <div class="col clearfix">
                            <span class="float-left"><label  for="cel" >Teléfono Fijo:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="telefono" id="telefono" value="" maxlength="10" placeholder="Telefono Fijo del remitente" onkeypress='return numeros(event)'/></span>
                            <span class="float-right"><label  for="cel" >Teléfono Celular:</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="cel" id="cel" value="" maxlength="9" placeholder="Telefono móvil 9## #### ###" onkeypress='return numeros(event)'/>
                            </span>
                          </div>
                          <p></p>
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
        ajax: "{{ route('remitentes.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nombre', name: 'nombre'},
            {data: 'distritos_pk.distrito', name: 'distritos_pk.distrito'},
            {data: 'distrito_id', name: 'distrito_id'},
            {data: 'cel', name: 'cel'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewremitente').click(function () {
        $('#saveBtn').val("create-remitente");
        $('#remitente_id').val('');
        $('#remitenteForm').trigger("reset");
        $('#modelHeading').html("Nuevo remitente");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
        $('#telefono').val('S/Tlf');
    });
    $('body').on('click', '.editremitente', function () {
      var remitente_id = $(this).data('id');
      $.get("{{ route('remitentes.index') }}" +'/' + remitente_id +'/edit', function (data) {
          $('#modelHeading').html("Editar remitente");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#remitente_id').val(data.id);
          $('#nombre').val(data.nombre);
          $('#email').val(data.email);
          $('#direccion').val(data.direccion);
          $('#distrito_id').val(data.distrito_id);
          // $('#distrito_id').html(data.distrito);
          $('#telefono').val(data.telefono);
          $('#cel').val(data.cel);
          $('#saveBtn').html('Guardar');
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();

        $(this).html('Guardando....');
        $.ajax({
          data: $('#remitenteForm').serialize(),
          url: "{{ route('remitentes.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">remitente guardado  correctamente</h6>');
                setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);

              $('#remitenteForm').trigger("reset");
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
    $('body').on('click', '.deleteremitente', function () {
        var remitente_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar este remitente?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('remitentes.store') }}"+'/'+remitente_id,
            success: function (data) {
                $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">remitente eliminado correctamente</h6>');
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
<p></p>
<p></p>
<hr>
<div class="container py-2 px-2">
<h1><i class="fas fa-user-times"></i>  No esta autorizado a ver este contenido</h1>
</div>
@endif
@endsection
