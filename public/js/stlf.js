function stlf() {
         //obteniendo el valor que se puso en el campo text del formulario
         var miCampoTexto = document.getElementById("telefono").value;
         var cel = document.getElementById("cel").value;
         var fijo = /^[0]{1}[1]{1}[0-9]{7}$/i;
         var celular = /^[9]{1}[0-9]{8}$/i;
         //la condición
         if (cel.length == 0 ) {
            alert('Numero de Celular necesario por favor complete los datos')
            document.getElementById("cel").setfocus();
           return false;
         }else if(!celular.test(cel)){
                    alert('Ingrese un numero de telefono válido, debe contener 9 digitos y comenzar con el no. 9');
                    document.getElementById("cel").focus();

          return false;
         }

         if (miCampoTexto.length == 0 ) {
            document.getElementById("telefono").value = "010000000";

             // return false;
         }else if(!fijo.test(miCampoTexto)){
                    alert('Ingrese un numero de telefono válido, debe contener 9 digitos y comenzar con el no. 01');
                    document.getElementById("telefono").focus();

          return false;
         }
        return true;
    }
        // Funcion JavaScript para la conversion a mayusculas
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        function minusculas(e) {
            e.value = e.value.toLowerCase();
        }

        function numeros(event) {
            if(event.charCode >= 48 && event.charCode <= 57){
                return true;
            }
                return false;
            }
        function valida(f) {
          var ok = true;
          var msg = "Rellene los siguientes campos:\n";
          if(f.elements["name"].value == "")
          {
            msg += "- Nombres\n";
            ok = false;
          }

          if(f.elements["email"].value == "")
          {
            msg += "- Email\n";
            ok = false;
          }

          if(f.password.value == "")
          {
            msg += "- Clave\n";
            ok = false;
          }
          if(f.password.value == "")
          {
            msg += "- Clave\n";
            ok = false;
          }

          if(ok == false)
            alert(msg);
          return ok;
        }
        function modal(){
        var correo = /^[A-Z0-9._%+-]+@([A-Z0-9-]+.)+[A-Z]{2,4}$/i;
        var letras =/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
        var reg = /^[9]{1}[0-9]{8}$/i;
        var fijo = /^[0]{1}[1]{1}[0-9]{7}$/i;
        var nombre = $('#nombre').val();
        var email = $('#email').val();
        var direccion = $('#direccion').val();
        var distrito_id = $('#distrito_id').val();
        var telefono = $('#telefono').val();
        var cel = $('#cel').val();

        if(nombre.length ==0 ){
          alert('Ingrese nombre');
          $('#nombre').focus();
          $('#saveBtn').html('Guardar');
          e.preventdefault();

        }else if(!letras.test(nombre)){
          alert('El nombre, solo debe contener letras');
            $('#nombre').focus();
            $('#saveBtn').html('Guardar');
            e.preventdefault();
        }

        if(email.length ==0 ){
          alert('Ingrese Email');
          $('#email').focus();
          $('#saveBtn').html('Guardar');
          e.preventdefault();

        }else if(!correo.test(email)){
          alert('ingrese un formato de correo válido');
            $('#email').focus();
            $('#saveBtn').html('Guardar');
            e.preventdefault();
        }


          if(telefono.trim() == '' ){
              $('#telefono').val('010000000');
              // return false;
          }else if(!fijo.test(telefono)){
              alert('Ingrese un numero de telefono válido, debe contener 9 digitos y comenzar con el no. 01');
              $('#telefono').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(direccion.trim() == '' ){
              alert('Ingrese el direccion por favor.');
              $('#direccion').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(distrito_id.trim() == '' ){
              alert('Seleccione un distrito de la lista por favor.');
              $('#distrito_id').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(cel.length !=9 ){
              alert('Ingrese el numero de teléfono celular incompleto');
              $('#cel').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(!reg.test(cel)){
              alert('Ingrese un numero de celular válido, debe contener 9 digitos y comenzar con el no. 9');
              $('#cel').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
                }

        }

function valnombre(){
  var letras =/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
  var banco = $('#nombre').val();


  if(banco.trim =='' ){
    alert('Ingrese nombre');
    $('#nombre').focus();
    $('#saveBtn').html('Guardar');
    e.preventdefault();

  }else if(!letras.test(banco)){
    alert('El nombre, solo debe contener letras');
      $('#nombre').focus();
      $('#saveBtn').html('Guardar');
      e.preventdefault();
  }

}

function valdistrito(){
  var letras =/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
  var distrito = $('#distrito').val();


  if(distrito.trim =='' ){
    alert('Ingrese nombre');
    $('#distrito').focus();
    $('#saveBtn').html('Guardar');
    e.preventdefault();

  }else if(!letras.test(distrito)){
    alert('El nombre, solo debe contener letras');
      $('#distrito').focus();
      $('#saveBtn').html('Guardar');
      e.preventdefault();
  }

}function valcliente(){
        var correo = /^[A-Z0-9._%+-]+@([A-Z0-9-]+.)+[A-Z]{2,4}$/i;
        var letras =/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
        var reg = /^[9]{1}[0-9]{8}$/i;
        var fijo = /^[0]{1}[1]{1}[0-9]{7}$/i;
        var nombre = $('#nombre').val();
        // var email = $('#email').val();
        var direccion = $('#direccion').val();
        var distrito_id = $('#distrito_id').val();
        var telefono = $('#telefono').val();
        var cel = $('#cel').val();

        if(nombre.length ==0 ){
          alert('Ingrese nombre');
          $('#nombre').focus();
          $('#saveBtn').html('Guardar');
          e.preventdefault();

        }else if(!letras.test(nombre)){
          alert('El nombre, solo debe contener letras');
            $('#nombre').focus();
            $('#saveBtn').html('Guardar');
            e.preventdefault();
        }

        // if(email.length ==0 ){
        //   alert('Ingrese Email');
        //   $('#email').focus();
        //   $('#saveBtn').html('Guardar');
        //   e.preventdefault();

        // }else if(!correo.test(email)){
        //   alert('ingrese un formato de correo válido');
        //     $('#email').focus();
        //     $('#saveBtn').html('Guardar');
        //     e.preventdefault();
        // }


          if(telefono.trim() == '' ){
              $('#telefono').val('010000000');
              // return false;
          }else if(!fijo.test(telefono)){
              alert('Ingrese un numero de telefono válido, debe contener 9 digitos y comenzar con el no. 01');
              $('#telefono').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(direccion.trim() == '' ){
              alert('Ingrese el direccion por favor.');
              $('#direccion').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(distrito_id.trim() == '' ){
              alert('Seleccione un distrito de la lista por favor.');
              $('#distrito_id').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(cel.length !=9 ){
              alert('Ingrese el numero de teléfono celular incompleto');
              $('#cel').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
          }
          if(!reg.test(cel)){
              alert('Ingrese un numero de celular válido, debe contener 9 digitos y comenzar con el no. 9');
              $('#cel').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
                }

        }


    function valguia(){
      var c = $('#id_cliente').val();
      var r = $('#id_remitente').val();
      var s =$('#id_estado').val();
      var gui = $('#guia').val();
      var gi =$('#guid').val();
      var id =$('#guia_id').val();
      var is =$('#id_servicio').val();
      var fecha =$('#fecha').val();
      var fp =$('#id_fpago').val();
      var m =$('#monto').val();

      gi=parseInt(gi)+1;

      if (gui.trim()==''){
        var g = is+'-'+r+c+'-'+gi;
        $('#guia').val(g);
      }
      if (gui.trim()!==''){
        var g = is+'-'+r+c+'-'+id;
        $('#guia').val(g);
      }
      if (s.trim()==''){
        $('#id_estado').val(6);
      }
      if(is.trim() == '' ){
              alert('Seleccione un servicio de la lista por favor.');
              $('#id_servicio').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
      }
      if(fecha.trim() == '' ){
              alert('Seleccione una fecha de servicio de la lista por favor.');
              $('#fecha').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
      }
      if(c.trim() == '' ){
              alert('Seleccione un cliente de la lista por favor.');
              $('#id_cliente').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
      }
      if(r.trim() == '' ){
              alert('Seleccione un remitente de la lista por favor.');
              $('#id_remitente').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
      }
      if(fp.trim() == '' ){
              alert('Seleccione forma de pago por favor.');
              $('#id_fpago').focus();
              $('#saveBtn').html('Guardar');
              e.preventdefault();
      }

      if (m.trim() == '' ){$('#monto').val(0); }

    }
    function actinputadm(){
      $('#id_servicio').prop('disabled',false);
      $('#id_cliente').prop('disabled',false);
      $('#id_remitente').prop('disabled',false);
    }
    function actinputrem(){
      $('#id_servicio').prop('disabled',false);
      $('#id_cliente').prop('disabled',false);

    }

function suma(){
      var monto = $('#monto').val();
      var smonto=$('#smonto').val();
      var total=0;
      monto = (monto == null || monto == undefined || monto == "") ? 0 : parseFloat(monto);
      smonto = (smonto == null || smonto == undefined || smonto == "") ? 0 : parseFloat(smonto);

      total = parseFloat(monto) + parseFloat(smonto);
      $('#total').val(total);
    }
