@extends('layouts.app')

@section('title', 'fpagos')

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
              <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewfpago" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
              <span class="float-left"><h1><i class="fas fa-credit-card"></i>   Medio de Pago</h1></span>
            </div>
          </div>
        </div>
        <hr>
        <p></p>
        <div class="alert Alert-success">
          <span><label type="hidden" name="alert" id="alert"></label></span>
        </div>
        {{-- <div class="card-body" style="width:60%"> --}}
            <table class="table table-bordered data-table table-responsive mx-auto overflow-x-auto nowrap" style="overflow-x: auto">
              <thead >
                  <tr>
                      {{-- <th width="10%">No</th> --}}
                      <th width="60%">Tipo</th>
                      <th width="5%">Acción</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          {{-- </div> --}}
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
                <form id="fpagoForm" name="fpagoForm" class="form-horizontal">
                   <input type="hidden" name="fpago_id" id="fpago_id">
                    <div class="form-group">
                        <label for="nombre" class="col-md-8 control-label">Nombre</label>
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
        reponsive: true,
        serverSide: true,
        language: {
             "url": "js/Spanish.json"
           },
        ajax: "{{ route('fpagos.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nombre', name: 'nombre'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewfpago').click(function () {
        $('#saveBtn').val("create-fpago");
        $('#nombre').prop("readonly",false);
        $('#saveBtn').show();
        $('#fpago_id').val('');
        $('#fpagoForm').trigger("reset");
        $('#modelHeading').html("Nuevo fpago");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
    });
    $('body').on('click', '.editfpago', function () {
      var fpago_id = $(this).data('id');
      $.get("{{ route('fpagos.index') }}" +'/' + fpago_id +'/edit', function (data) {
          $('#modelHeading').html("Medio de Pago");
          $('#saveBtn').val("edit-user");
          $('#saveBtn').hide();
          $('#ajaxModel').modal('show');
          $('#fpago_id').val(data.id);
          $('#nombre').val(data.nombre);
          $('#nombre').prop("readonly",true);
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
@include('layouts._denegado')
@endif
@endsection
