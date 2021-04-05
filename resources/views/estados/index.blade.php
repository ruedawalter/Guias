@extends('layouts.app')

@section('title', 'estados')

@section('content')
<div class="container" style="width:100%">
  <div class="row justify-content-center">
    <div class="col-lg-12 col-md-8 col-sm-4 mx-auto">
    <div class="card">
      <div class="card-body">
        @if  (Auth::user()->id_rol == "3")
          <div class="card-header">
             <div class="row">
                <div class="col clearfix">
                  <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewestado" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
                  <span class="float-left"><h1><i class="fas fa-calendar-check-o"></i>   Estados</h1></span>
                </div>
              </div>
            </div>
            <hr>
            <p></p>
            <div class="alert Alert-success">
              <span><label type="hidden" name="alert" id="alert"></label></span>
            </div>
            <table class="table table-bordered data-table table-responsive mx-auto nowrap" style="overflow-x: auto">
              <thead>
                <tr>
                  {{-- <th width="10%">No</th> --}}
                  <th width="60%">Estado</th>
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
                <form id="estadoForm" name="estadoForm" class="form-horizontal">
                   <input type="hidden" name="estado_id" id="estado_id">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del estado" value="" maxlength="50" required="required" onkeyup="mayusculas(this);">
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
        rowReorder: {selector: 'td:nth-child(2)'},
        responsive: true,
        language: {
             "url": "js/Spanish.json"
           },
        ajax: "{{ route('estados.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nombre', name: 'nombre'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewestado').click(function () {
        $('#saveBtn').val("create-estado");
        $('#estado_id').val('');
        $('#estadoForm').trigger("reset");
        $('#modelHeading').html("Nuevo estado");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
    });
    $('body').on('click', '.editestado', function () {
      var estado_id = $(this).data('id');
      $.get("{{ route('estados.index') }}" +'/' + estado_id +'/edit', function (data) {
          $('#modelHeading').html("Estaus");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#estado_id').val(data.id);
          $('#nombre').val(data.nombre);
          $('#saveBtn').html('Guardar');
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Guardando....');

        valnombre();

        $.ajax({
          data: $('#estadoForm').serialize(),
          url: "{{ route('estados.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
              $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Estado de la Guia guardado correctamente</h6>');
              setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);
              $('#estadoForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Guardar');
          }
      });
    });
    $('body').on('click', '.deleteestado', function () {
        var estado_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar este estado?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('estados.store') }}"+'/'+estado_id,
            success: function (data) {
                $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Estado de la guia eliminado correctamente</h6>');
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
