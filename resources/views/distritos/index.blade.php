@extends('layouts.app')

@section('title', 'distritos')

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
      <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewdistrito" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
      <span class="float-left"><h1><i class="fas fa-map"></i>   Distritos</h1></span>
    </div>
  </div>
</div>
    <hr>
    <p></p>

    <div class="alert Alert-success">
      <span><label type="hidden" name="alert" id="alert"></label></span>
    </div>
   <table class="table table-bordered col-md-8 data-table table-responsive mx-auto nowrap" style="width:100%">
        <thead>
            <tr>
                {{-- <th width="5%">No</th> --}}
                <th width="5%">Cód. Postal</th>
                <th width="50%">distrito</th>
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
                <form id="distritoForm" name="distritoForm" class="form-horizontal">
                   <input type="hidden" name="distrito_id" id="distrito_id">
                    <div class="form-group">
                        <label for="nombre" class="col-md-8 control-label">Nombre</label>
                        <div class="col-mm-8">
                            <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Ingrese el nombre del distrito" value="" maxlength="50" required="required" onkeyup="mayusculas(this);">
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
        language: {
             "url": "js/Spanish.json"
           },
        ajax: "{{ route('distritos.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name:'distrito_id'},
            {data: 'distrito', name: 'distrito'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewdistrito').click(function () {
        $('#saveBtn').val("create-distrito");
        $('#distrito_id').val('');
        $('#distritoForm').trigger("reset");
        $('#modelHeading').html("Nuevo distrito");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
    });
    $('body').on('click', '.editdistrito', function () {
      var distrito_id = $(this).data('id');
      $.get("{{ route('distritos.index') }}" +'/' + distrito_id +'/edit', function (data) {
          $('#modelHeading').html("Editar distrito");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#distrito_id').val(data.id);
          $('#distrito').val(data.distrito);
          $('#saveBtn').html('Guardar');
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Guardando....');
        valdistrito();
        $.ajax({
          data: $('#distritoForm').serialize(),
          url: "{{ route('distritos.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
              $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Distrito guardado correctamente</h6>');
              setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);
              $('#distritoForm').trigger("reset");
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
    $('body').on('click', '.deletedistrito', function () {
        var distrito_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar este distrito?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('distritos.store') }}"+'/'+distrito_id,
            success: function (data) {
                $("#alert").show();
              $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Distrito eliminado correctamente</h6>');
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