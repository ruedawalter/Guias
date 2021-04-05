@extends('layouts.app')

@section('title', 'fpagos')

@section('content')
  @if  (Auth::user()->id_rol == "3")
  <div class="container" style="width:40%">
    <div class="row justify-content-center">
    <div class="card">
      <div class="card-body">
        <div class="card-header">
  <div class="row">
    <div class="col clearfix">
      <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewfpago" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
      <span class="float-left"><h1><i class="fas fa-credit-card"></i>   Forma de Pago</h1></span>
    </div>
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
                <th width="5%">No</th>
                <th width="85%">Forma de Pago</th>
                <th width="10%">Acción</th>
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
                <form id="fpagoForm" name="fpagoForm" class="form-horizontal">
                   <input type="hidden" name="fpago_id" id="fpago_id">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del fpago" value="" maxlength="50" required="required" onkeyup="mayusculas(this);">
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
        ajax: "{{ route('fpagos.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nombre', name: 'nombre'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewfpago').click(function () {
        $('#saveBtn').val("create-fpago");
        $('#fpago_id').val('');
        $('#fpagoForm').trigger("reset");
        $('#modelHeading').html("Nuevo fpago");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
    });
    $('body').on('click', '.editfpago', function () {
      var fpago_id = $(this).data('id');
      $.get("{{ route('fpagos.index') }}" +'/' + fpago_id +'/edit', function (data) {
          $('#modelHeading').html("Editar fpago");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#fpago_id').val(data.id);
          $('#nombre').val(data.nombre);
          $('#saveBtn').html('Guardar');
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        valnombre();
        $(this).html('Guardando....');
        $.ajax({
          data: $('#fpagoForm').serialize(),
          url: "{{ route('fpagos.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Forma de pago agregada  correctamente</h6>');
                setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);
              $('#fpagoForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Guardar');
          }
      });
    });
    $('body').on('click', '.deletefpago', function () {
        var fpago_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar este fpago?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('fpagos.store') }}"+'/'+fpago_id,
            success: function (data) {
                $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Forma de pago eliminado correctamente</h6>');
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
