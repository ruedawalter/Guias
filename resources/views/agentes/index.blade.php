
@extends('layouts.app')

@section('title', 'agentes')
@section('content')
@if  (Auth::user()->id_rol == "3")
<div class="container" style="width:100%">
  <div class="container" style="width:100%">
  <div class="row">
    <div class="col clearfix">
      <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewagente" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
      <span class="float-left"><h1><i class="fas fa-motorcycle"></i>   Agentes</h1></span>
    </div>
  </div>
    <hr>
    <p></p>
    <div class="alert Alert-success">
      <span><label type="hidden" name="alert" id="alert"></label></span>
    </div>
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}

    <table class="table table-bordered data-table dt-responsive nowrap" style="width:90%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Agente</th>
                <th width="35%">Móvil</th>
                {{-- <th>Email</th> --}}
                <th width="10%">Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
                <form id="agenteForm" name="agenteForm" class="form-horizontal">
                   <input type="hidden" name="agente_id" id="agente_id">
                    <div class="form-group">
                        <label for="nombres" class="col-sm-2 control-label">Nombres</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese Nombres y Apellidos del agente" value="" maxlength="50" required onkeyup="mayusculas(this);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cel" class="col-sm-2 control-label">Móvil: </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="cel" name="cel" placeholder="Ingrese el móvil del agente" value="" maxlength="9" required="required" onkeypress='return numeros(event)'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese el Email del agente" value="" maxlength="60" required="required" onkeyup="minusculas(this);">
                        </div>
                    </div>


                    <div align="center">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
                     </button>
                    </div>
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
        ajax: "{{ route('agentes.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nombres', name: 'nombres'},
            {data: 'cel', name: 'cel'},
            // {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewagente').click(function () {
        $('#saveBtn').val("create-agente");
        $('#agente_id').val('');
        $('#agenteForm').trigger("reset");
        $('#modelHeading').html("Nuevo agente");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
    });
    $('body').on('click', '.editagente', function () {
      var agente_id = $(this).data('id');
      $.get("{{ route('agentes.index') }}" +'/' + agente_id +'/edit', function (data) {
          $('#modelHeading').html("Editar agente");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#agente_id').val(data.id);
          $('#nombres').val(data.nombres);
          $('#cel').val(data.cel);
          $('#email').val(data.email);
          $('#saveBtn').html('Guardar');
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Guardando....');
        $.ajax({
          data: $('#agenteForm').serialize(),
          url: "{{ route('agentes.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
              $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Agente guardado correctamente</h6>');
              setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);
              $('#agenteForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Guardar');
              $('#modelHeading').html("Error al guardar");
          }
      });
    });


    $('body').on('click', '.deleteagente', function () {
        var agente_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar al agente?  " )
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('agentes.store') }}"+'/'+agente_id,
            success: function (data) {
              $("#alert").show();
              $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Agente eliminado correctamente</h6>');
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