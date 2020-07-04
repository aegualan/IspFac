function SoloNumerosDecimales(e, valInicial, nEntero, nDecimal) {
    var obj = e.srcElement || e.target;
    var tecla_codigo = (document.all) ? e.keyCode : e.which;
    var tecla_valor = String.fromCharCode(tecla_codigo);
    var patron2 = /[\d.]/;
    var control = (tecla_codigo === 46 && (/[.]/).test(obj.value)) ? false : true;
    var existePto = (/[.]/).test(obj.value);

    //el tab
    if (tecla_codigo === 8)
        return true;

    if (valInicial !== obj.value) {
        var TControl = obj.value.length;
        if (existePto === false && tecla_codigo !== 46) {
            if (TControl === nEntero) {
                obj.value = obj.value + ".";
            }
        }

        if (existePto === true) {
            var subVal = obj.value.substring(obj.value.indexOf(".") + 1, obj.value.length);

            if (subVal.length > 1) {
                return false;
            }
        }

        return patron2.test(tecla_valor) && control;
    } else {
        if (valInicial === obj.value) {
            obj.value = '';
        }
        return patron2.test(tecla_valor) && control;
    }
}

function Solo_numeros(e) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = "8-37-38-46-164";
    teclado_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_especial = true;
            break;

        }
    }
    if (letras.indexOf(teclado) == -1 && !teclado_especial) {
        return false;

    }

}

function Solo_letras(e) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase();
    letras = " abcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-38-46-164";
    teclado_especial = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_especial = true;
            break;

        }
    }
    if (letras.indexOf(teclado) == -1 && !teclado_especial) {
        return false;

    }
    function ConvertirMayusculas(idTexto) {
        var textoM = document.getElementById(idTexto).value
        document.getElementById(idTexto).value = textoM.toUpperCase()
    }



}
function validarIP(campo) {
    // var validador = false;

    object = document.getElementById(campo);

    IP = object.value;

    var patronIp = new RegExp("^([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})$");

    //window.alert(valueForm.search(patronIp));

    // Si la ip consta de 4 pares de números de máximo 3 dígitos

    if (IP.search(patronIp) == 0)

    {

        // Validamos si los números no son superiores al valor 255

        valores = IP.split(".");

        if (valores[0] <= 255 && valores[1] <= 255 && valores[2] <= 255 && valores[3] <= 255)

        {

            $("#glypcn" + campo).remove();
            $('#' + campo).parent().parent().attr("class", "form-group has-success has-feedback");
            $('#' + campo).parent().children('span').hide();
            $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
            return true;
        }

    }

    $("#glypcn" + campo).remove();
    $('#' + campo).parent().parent().attr("class", "form-group has-error has-feedback");
    $('#' + campo).parent().children('span').text("ingrese una direccion ip valida").show();
    $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
    return false;
}
