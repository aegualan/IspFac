
function requerido(valor) {
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        return false;
    }
}
function validar() {
    var cedula_ruc = document.getElementById("cedula_ruc").value;
    var apellidos = document.getElementById("apellidos").value;
    var nombres = document.getElementById("nombres").value;
    var telefono = document.getElementById("telefono").value;
    var celular = document.getElementById("celular").value;
    var email = document.getElementById("email").value;
    var v1, v2, v3, v4, v5, v6;
    v1 = validacion('cedula_ruc');
    v2 = validacion('apellidos');
    v3 = validacion('nombres');
    v4 = validacion('telefono');
    v5 = validacion('celular');
    v6 = validacion('email');
    if (requerido(cedula_ruc) == false || v1 === false || requerido(apellidos) == false || v2 === false || requerido(nombres) == false || v3 === false || v4 === false || v5 === false || v6 === false) {
        $("#exito").hide();
        $("#error").show();
        return false;
    }
}
function validacion(campo) {
    //var a = 0;
    if (campo == 'cedula_ruc') {
        cedula_ruc = document.getElementById(campo).value;
        if (cedula_ruc == null || cedula_ruc.length == 0 || /^\s+$/.test(cedula_ruc)) {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#' + campo).parent().children('span').text("campo obligatorio").show();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
            return false;
        } else {
            if (cedula_ruc.length <= 10) {
                if (ValidarCedula(cedula_ruc) == false) {
//alert("cedula incorrecto")
                    $("#glypcn" + campo).remove();
                    $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                    $('#' + campo).parent().children('span').text("cédula incorrecto").show();
                    $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                    return false;
                } else {

                    var url = '{base_url()}clientes/validador';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: 'texto=' + cedula_ruc,
                        dataType: "html",
                        error: function () {
                            //alert("error petición ajax");
                        },
                        success: function (data) {
                            if (data == "2") {
                                $("#glypcn" + campo).remove();
                                $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
                                $('#' + campo).parent().children('span').hide();
                                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
                                return true;
                            } else {
                                if (data == "1") {
                                    $("#glypcn" + campo).remove();
                                    $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                                    $('#' + campo).parent().children('span').text("esta cédula ya esta registrado en el sistema").show();
                                    $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                                    return false;
                                }
                            }
                        }
                    });
                }
            } else {
                if (cedula_ruc.length <= 13) {
                    if (ValidarRuc(cedula_ruc) == false) {
                        //alert("ruc incorrecto");
                        $("#glypcn" + campo).remove();
                        $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                        $('#' + campo).parent().children('span').text("ruc incorrecto").show();
                        $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                        return false;
                    } else {


                        var url = '{base_url()}clientes/validador';
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: 'texto=' + cedula_ruc,
                            dataType: "html",
                            error: function () {
                                //alert("error petición ajax");
                            },
                            success: function (data) {
                                if (data == "2") {
                                    $("#glypcn" + campo).remove();
                                    $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
                                    $('#' + campo).parent().children('span').hide();
                                    $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
                                    return true;
                                } else {
                                    if (data == "1") {
                                        $("#glypcn" + campo).remove();
                                        $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                                        $('#' + campo).parent().children('span').text("este ruc ya esta registrado en el sistema").show();
                                        $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                                        return false;
                                    }
                                }
                            }
                        });
                    }
                }
            }
        }

    }
    if (campo == 'apellidos') {
        apellidos = document.getElementById(campo).value;
        if (apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos)) {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#' + campo).parent().children('span').text("campo obligatorio").show();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
            return false;
        } else {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
            $('#' + campo).parent().children('span').hide();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
            return true;
        }
    }
    if (campo == 'nombres') {
        nombres = document.getElementById(campo).value;
        if (nombres == null || nombres.length == 0 || /^\s+$/.test(nombres)) {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#' + campo).parent().children('span').text("campo obligatorio").show();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
            return false;
        } else {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
            $('#' + campo).parent().children('span').hide();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
            return true;
        }
    }
    if (campo == 'telefono') {
        telefono = document.getElementById(campo).value;
        if (telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)) {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#' + campo).parent().children('span').text("campo obligatorio").show();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
            return false;
        } else {
            if (telefono.length != 9) {
                $("#glypcn" + campo).remove();
                $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                $('#' + campo).parent().children('span').text("ingrese un telefono válido").show();
                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                return false;
            } else {
                $("#glypcn" + campo).remove();
                $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
                $('#' + campo).parent().children('span').hide();
                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
                return true;
            }
        }
    }
    if (campo == 'celular') {
        celular = document.getElementById(campo).value;
        if (celular == null || celular.length == 0 || /^\s+$/.test(celular)) {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#' + campo).parent().children('span').text("campo obligatorio").show();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
            return false;
        } else {
            if (celular.length != 10) {
                $("#glypcn" + campo).remove();
                $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                $('#' + campo).parent().children('span').text("ingrese un celular válido").show();
                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                return false;
            } else {
                $("#glypcn" + campo).remove();
                $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
                $('#' + campo).parent().children('span').hide();
                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
                return true;
            }
        }
    }
    if (campo == 'email') {
        email = document.getElementById(campo).value;
        if (email == null || email.length == 0 || /^\s+$/.test(email)) {
            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#' + campo).parent().children('span').text("campo obligatorio").show();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
            return false;
        } else {
            if (!(/\S+@\S+\.\S+/.test(email))) {
                $("#glypcn" + campo).remove();
                $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
                $('#' + campo).parent().children('span').text("ingrese un email válido").show();
                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
                return false;
            } else {
                $("#glypcn" + campo).remove();
                $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
                $('#' + campo).parent().children('span').hide();
                $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
                return true;
            }
        }
    }
}


