@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return stlf()">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><i class="fas fa-user"></i>  {{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombres / Razón Social" pattern="[a-zA-Z ]{3,60}" title="Ingrese solo caracateres permitidos (letras y espacios)" onkeyup="mayusculas(this);">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><i class="fas fa-envelope"></i>  {{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" onkeyup="minusculas(this);">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><i class="fas fa-key"></i>  {{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese Clave min 8 caracateres" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><i class="fas fa-key"></i>  {{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme su clave" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  for="direccion" class="col-md-4 col-form-label text-md-right"><i class="fas fa-address-book"></i>  Direción:</label>
                        <div class="col-md-6">
                            <input class="form-control @error('direccion') is-invalid @enderror" style="" type="text" name="direccion" id="direccion" onkeyup="mayusculas(this);" value="" maxlength="100" placeholder="Dirección" required>
                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                       </div>

                       <div class="form-group row">
                            <label  for="distrito_id" class="col-md-4 col-form-label text-md-right"><i class="fas fa-address-book"></i>  Distrito :</label>
                        <div class="col-md-6">
                            <select class="form-control @error('distrito_id') is-invalid @enderror" name ="distrito_id" id="distrito_id"  class="form-control" required>
                              <option value="">--Seleccione Distrito--</option>
                                @foreach($distritos as $distrito)
                                    <option value="{{$distrito->id}}">{{$distrito->distrito}}</option>
                                @endforeach
                            </select>
                            @error('distrito_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>

                          <div class="form-group row">
                            <label  for="telefono" class="col-md-4 col-form-label text-md-right"><i class="fas fa-phone"></i>  Teléfono Fijo:</label>
                            <div class="col-md-6">
                            <input class="form-control"style="" type="text" name="telefono" id="telefono" value="" maxlength="9"  placeholder="Telefono Fijo 01 ### ####" onkeypress='return numeros(event)'/>

                           </div>
                        </div>
                        <div class="form-group row">
                            <label  for="cel" class="col-md-4 col-form-label text-md-right"><i class="fas fa-phone"></i>  Celular:</label>
                        <div class="col-md-6">
                            <input class="form-control @error('cel') is-invalid @enderror" type="tel" name="cel" id="cel" value=""  required maxlength="9" pattern="9[0-9]{8}" title="El numero de celular debe comenzar por 9 y tener 9 digitos" placeholder="Telefono móvil 9## #### ###" onkeypress='return numeros(event)'/>
                            @error('cel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                        </div>


                        <div class="form-group row">
                            <label for="id_rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                                <select name ="id_rol" id="rol"  class="form-control" required >
                                   {{-- @isset($items) --}}
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->rols}}</option>
                                    @endforeach
                                    {{-- @endisset --}}
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus">  </i>{{ __('Register') }}
                                </button>
                                <span class="float-right"><a class="btn btn-info" href="{{('usuarios')}}" alt="Nuevo Usuario"><i class="fas fa-reply-all"></i> Cancelar</a></span>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>

//     var input = document.getElementById('cel')
//     input.oninvalid = function(event) {
//     event.target.setCustomValidity('El numero celular debe comenzar por 9 y tener solo 9 digitos');
// }
</script>

@endsection
