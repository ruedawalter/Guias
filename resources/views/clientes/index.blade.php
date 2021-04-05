@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
  @if  (Auth::user()->id_rol == "3")
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-8 col-sm-4 mx-auto">
    {{-- <div class="card"> --}}
      <div class="card-body">
        <div class="card-header">
          <div class="row">
            <div class="col clearfix">
              {{-- <span>{{($prueba[0]->distritos_pk->distrito)}}</span> --}}
              <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewcliente" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span>
              <span class="float-left"><h1><i class="fas fa-male"></i>   Clientes</h1></span>
            </div>
          </div>
        </div>
        <hr>
        <p></p>
      <div class="alert Alert-success">
        <span><label type="hidden" name="alert" id="alert"></label></span>
      </div>
    <table class="table table-bordered data-table table-responsive  mx-auto wrap" style="width:100%">
        <thead>
            <tr>

                <th width="47%">Cliente</th>
                <th width="30%">Distrito</th>
                <th width="15%">Móvil </th>
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
                <form id="clienteForm" name="clienteForm" class="form-horizontal">
                   <input type="hidden" name="cliente_id" id="cliente_id">
                    <div class="form-group">
                          <div class="col clearfix ">
                            <span class="col-md-8"><label  for="nombre" >Nombres :</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="nombre" id="nombre" onkeyup="mayusculas(this);" value="" maxlength="60" placeholder="Nombre del Cliente"></span>

                            {{-- <span class="float-right"><label  for="email" >Correo Electrónico :</label>
                            <input class="form-control bg-light shadow-sm "style="" type="email" name="email" id="email" onkeyup="minusculas(this);" value="" maxlength="100" placeholder="Email del Cliente"></span> --}}
                          </div>

                        <div class="col clearfix">
                            <span class="col-md-8"><label  for="direccion" >Direción:</label>
                            <input class="form-control input-lg bg-light shadow-sm"style="" type="text" name="direccion" id="direccion" onkeyup="mayusculas(this);" value="" maxlength="100" placeholder="Dirección del Cliente"></span>
                        </div>


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
                            <span class="float-left" style="width:48%"><label  for="cel" >Teléfono Fijo:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="telefono" id="telefono" value="" maxlength="10" placeholder="Telefono Fijo del Cliente" onkeypress='return numeros(event)'/></span>
                            <span class="float-right" style="width:48%"><label  for="cel" >Teléfono Celular:</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="cel" id="cel" value="" maxlength="9" placeholder="Telefono móvil 9## #### ###" onkeypress='return numeros(event)'/>
                            </span>
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
        responsive: true,
        language: {
             "url": "js/Spanish.json"
           },
        ajax: "{{ route('clientes.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nombre', name: 'nombre'},
            {data: 'distritos_pk.distrito', name: 'distritos_pk.distrito'},
            // {data: 'distrito_id', name: 'distrito_id'},
            {data: 'cel', name: 'cel'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewcliente').click(function () {
        $('#saveBtn').val("create-cliente");
        $('#cliente_id').val('');
        $('#nombre').prop("readonly",false);
        $('#clienteForm').trigger("reset");
        $('#modelHeading').html("Nuevo cliente");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
        // $('#telefono').val('S/Tlf');
    });
    $('body').on('click', '.editcliente', function () {
      var cliente_id = $(this).data('id');
      $.get("{{ route('clientes.index') }}" +'/' + cliente_id +'/edit', function (data) {
          $('#modelHeading').html("Editar cliente");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#cliente_id').val(data.id);
          $('#nombre').val(data.nombre);
          $('#nombre').prop("readonly",true);
          // $('#email').val(data.email);
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
        valcliente();
        $.ajax({
          data: $('#clienteForm').serialize(),
          url: "{{ route('clientes.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Cliente guardado  correctamente</h6>');
                setTimeout(function() {
                $('#alert').fadeOut('slow');
                }, 2500);

              $('#clienteForm').trigger("reset");
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
    $('body').on('click', '.deletecliente', function () {
        var cliente_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar este cliente?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('clientes.store') }}"+'/'+cliente_id,
            success: function (data) {
                $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">cliente eliminado correctamente</h6>');
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
