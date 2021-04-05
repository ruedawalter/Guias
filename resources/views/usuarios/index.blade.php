@extends('layouts.app')

@section('title', 'Usuarios - Edicion')

@section('content')
  @if  (Auth::user()->id_rol == "3")
  <div class="container" style="width:100%">
    <div class="row justify-content-center">
    <div class="col-lg-12 col-md-8 col-sm-4 mx-auto">
      <div class="card-header">
      <div class="row">
      <div class="col clearfix">
      {{-- <span>{{($roles[0]->roles_pk->rols)}}</span> --}}
      {{-- <span class="float-right"><a class="btn btn-success my-auto" href="javascript:void(0)" id="createNewusuario" alt="Nuevo"> <i class="fas fa-plus"></i>  Nuevo </a></span> --}}
      <span class="float-right"><a class="btn btn-success" href="{{('register')}}" alt="Nuevo Usuario"><i class="fas fa-plus"></i> Nuevo</a></span>
      <span class="float-left"><h1><i class="fas fa-edit"></i><i class="fas fa-user"></i>   Usuarios</h1></span>
    </div>
  </div>
</div>
    <hr>
    <p></p>
      <div class="alert Alert-success">
        <span><label type="hidden" name="alert" id="alert"></label></span>
      </div>
    <table class="table table-bordered data-table table-responsive mx-auto nowrap" style="width:100%">
        <thead>
            <tr>
                {{-- <th width="5%">No</th> --}}
                <th width="60%">Nombres</th>
                <th width="30%">Email</th>
                {{-- <th width="60px">Código</th>
                <th width="60px">Móvil </th> --}}
                <th width="5%">Acción</th>
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
                <form id="usuarioForm" name="usuarioForm" class="form-horizontal" >
                   <input type="hidden" name="usuario_id" id="usuario_id">
                    <div class="form-group">
                          <div class="col clearfix ">
                            <span class="float-left" style="width:100%"><label  for="name" >Nombres: </label>
                            <input class="form-control bg-light shadow-sm " type="text" name="name" id="name" onkeyup="mayusculas(this);" value="" maxlength="60" placeholder="Nombre del usuario" disabled="disabled"></span>

                            <span class="float-right" style="width:100%"><label  for="email" >Correo Electrónico :  {{('email')}}</label>
                            <input class="form-control bg-light shadow-sm "style="" type="email" name="email" id="email" onkeyup="minusculas(this);" value="" maxlength="100" placeholder="Email del usuario" readonly="readonly"></span>
                          </div>
                          <p></p>
                        <div class="">
                            <span class=""><label  for="direccion" >Direción:</label>
                            <input class="form-control input-lg bg-light shadow-sm"style="" type="text" name="direccion" id="direccion" onkeyup="mayusculas(this);" value="" maxlength="100" placeholder="Dirección del usuario"></span>
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
                            <span class="float-left" style="width:48%"><label  for="cel" >Teléfono Fijo:</label>
                            <input class="form-control bg-light shadow-sm "style="" type="text" name="telefono" id="telefono" value="" maxlength="9" pattern="01[0-9]{7}" title="El numero de telefono debe comenzar por 01 y tener 9 digitos" placeholder="Telefono Fijo del usuario" onkeypress='return numeros(event)'/></span>
                            <span class="float-right" style="width:48%"><label  for="cel" >Teléfono Celular:</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="cel" id="cel" value="" maxlength="9" pattern="9[0-9]{8}" title="El numero de telefono debe comenzar por 9 y tener 9 digitos" placeholder="Telefono móvil 9## #### ###" onkeypress='return numeros(event)'/>
                            </span>
                          </div>
                          <p></p>
                          <div class="col clearfix">
                            <span class="float-left" style="width:70%"><label  for="rols" >Tipo de Usuario :</label>
                            <select class="form-control bg-light shadow-sm col-12" name ="rols" id="rols"  class="form-control" disabled="disabled" >
                              <option value=""></option>
                                @foreach($roles as $roles)
                                    <option value="{{$roles->id}}">{{$roles->rols}}</option>
                                @endforeach
                            </select></span>
                            {{-- <span class="float-right"><label  for="cel" >Teléfono Celular:</label>
                            <input class="form-control bg-light shadow-sm " type="text" name="cel" id="cel" value="" maxlength="9" placeholder="Telefono móvil 9## #### ###" onkeypress='return numeros(event)'/>
                            </span> --}}
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
        ajax: "{{ route('usuarios.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            // {data: 'distritos_pk.distrito', name: 'distritos_pk.distrito'},
            // {data: 'distrito_id', name: 'distrito_id'},
            // {data: 'cel', name: 'cel'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewusuario').click(function () {
        $('#saveBtn').val("create-usuario");
        $('#usuario_id').val('');
        $('#usuarioForm').trigger("reset");
        $('#modelHeading').html("Nuevo usuario");
        $('#ajaxModel').modal('show');
        $('#saveBtn').html('Guardar');
        // $('#telefono').val('S/Tlf');
    });
    $('body').on('click', '.editusuario', function () {
      var usuario_id = $(this).data('id');
      $.get("{{ route('usuarios.index') }}" +'/' + usuario_id +'/edit', function (data) {
          $('#modelHeading').html("Editar usuario");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#usuario_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $('#direccion').val(data.direccion);
          $('#distrito_id').val(data.distrito_id);
          // $('#distrito_id').html(data.distrito);
          $('#telefono').val(data.telefono);
          $('#cel').val(data.cel);
          $('#rols').val(data.id_rol);
          $('#saveBtn').html('Guardar');
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Guardando....');
        var reg = /^[9]{1}[0-9]{8}$/i;
        var fijo = /^[0]{1}[1]{1}[0-9]{7}$/i;
        var direccion = $('#direccion').val();
        var distrito_id = $('#distrito_id').val();
        var telefono = $('#telefono').val();
        var cel = $('#cel').val();
                if(telefono.trim() == '' ){
                    $('#telefono').val('010000000');
                    // return false;
                }else if(!fijo.test(telefono)){
                    alert('Ingrese un numero de telefono válido, debe contener 9 digitos y comenzar con el no. 01');
                    $('#telefono').focus();
                    $(this).html('Guardar');
                    return false;
                }

                if(direccion.trim() == '' ){
                    alert('Ingrese el direccion por favor.');
                    $('#direccion').focus();
                    $(this).html('Guardar');
                    return false;
                }
                if(distrito_id.trim() == '' ){
                    alert('Seleccione un distrito de la lista por favor.');
                    $('#distrito_id').focus();
                    $(this).html('Guardar');
                    return false;
                }
                if(cel.length !=9 ){
                    alert('Ingrese el numero de teléfono celular incompleto');
                    $('#cel').focus();
                    $(this).html('Guardar');
                    return false;
                }
                if(!reg.test(cel)){
                    alert('Ingrese un numero de celular válido, debe contener 9 digitos y comenzar con el no. 9');
                    $('#cel').focus();
                    $(this).html('Guardar');
                    return false;
                }

                  $.ajax({
                    data: $('#usuarioForm').serialize(),
                    url: "{{ route('usuarios.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $("#alert").show();
                          $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">usuario guardado  correctamente</h6>');
                          setTimeout(function() {
                          $('#alert').fadeOut('slow');
                          }, 2500);

                        $('#usuarioForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                  },
                    error: function (data) {
                        $("#alert").show();
                          $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Ha ocurrido un error al guarda la información verifique los campos</h6>', data);
                          setTimeout(function() {
                          $('#alert').fadeOut('slow');
                          }, 2500);

                        $('#modelHeading').html("Error al guardar");
                        console.log('Error:', data);
                        $('#saveBtn').html('Guardar');
                    }
                });

            });


    $('body').on('click', '.deleteusuario', function () {
        var usuario_id = $(this).data("id");
        var opcion = confirm("Esta usted seguro que quiere eliminar este usuario?")
        if (opcion == true){
        $.ajax({
            type: "DELETE",
            url: "{{ route('usuarios.store') }}"+'/'+usuario_id,
            success: function (data) {
                $("#alert").show();
                $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">usuario eliminado correctamente</h6>');
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