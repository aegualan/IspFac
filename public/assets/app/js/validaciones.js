function identidad(campo) {
    var band = false;
    var valor = document.getElementById(campo).value;
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        errores(campo, "Campo obligatorio");
    } else {
        if (valor.length <= 10) {
            if (ValidarCedula(valor)) {
                correcto(campo);
                band = true;
            } else {
                errores(campo, "Cédula incorrecto");
            }
        } else if (valor.length > 10 && valor.length <= 13) {
            if (ValidarRuc(valor)) {
                correcto(campo);
                band = true;
            } else {
                errores(campo, "Ruc incorrecto");
            }
        } else {
            correcto(campo);
            band = true;
        }
    }
    return band;
}

function obligatorio(campo) {
    var band = false;
    var valor = document.getElementById(campo).value;
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        errores(campo, "Campo obligatorio");
    } else {
        correcto(campo);
        band = true;
    }
    return band;
}

function email(campo) {
    var band = false;
    var valor = $('#' + campo).val();
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        sinValores(campo);
        band = true;
    } else {
        if (!(/\S+@\S+\.\S+/.test(valor))) {
            errores(campo, "Email incorrecto");
        } else {
            correcto(campo);
            band = true;
        }
    }
    return band;
}

function soloNumeros(campo) {
    var band = false;
    var valor = document.getElementById(campo).value;
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        sinValores(campo);
        band = true;
    } else {
        if (isNaN(valor)) {
            errores(campo, "Ingrese solo números");
        } else {
            correcto(campo);
            band = true;
        }
    }
    return band;
}

function obligatorioSoloNumeros(campo) {
    var band = false;
    var valor = document.getElementById(campo).value;
    var valor = document.getElementById(campo).value;
    if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
        errores(campo, "Campo obligatorio");
    } else if (isNaN(valor)) {
        errores(campo, "Ingrese solo números");
    } else {
        correcto(campo);
        band = true;
    }
    return band;
}

function ConvertirMayusculas(idTexto) {
    var textoM = document.getElementById(idTexto).value
    return document.getElementById(idTexto).value = textoM.toUpperCase()
}
var correcto = function (campo) {
    $("#glypcn" + campo).remove();
    $('#' + campo).parent().parent().attr("class", "form-group has-success");
    $('#' + campo).parent().children('span').hide();
    //  $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-check form-control-feedback'></i>");
}
var errores = function (campo, mensaje) {
    $("#glypcn" + campo).remove();
    $('#' + campo).parent().parent().attr("class", "form-group has-error");
    $('#' + campo).parent().children('span').text(mensaje).show();
    //  $('#' + campo).parent().append("<i id='glypcn" + campo + "' class='fa fa-remove form-control-feedback'></i>");
}
var sinValores = function (campo) {
    $('#' + campo).parent().parent().attr("class", "form-group");
    $('#' + campo).parent().children('span').hide();
}
var ValidarCedula = function (cedula) {
    var validador = false;
    if (cedula.length != 10) {
        return validador;
    }
    //Obtenemos el digito de la region que sonlos dos primeros digitos
    var digito_region = cedula.substring(0, 2);
    //Pregunto si la region existe ecuador se divide en 24 regiones
    if (digito_region >= 1 && digito_region <= 24) {
        // Extraigo el ultimo digito
        var ultimo_digito = cedula.substring(9, 10);
        //Agrupo todos los pares y los sumo
        var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));
        //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
        var numero1 = cedula.substring(0, 1);
        var numero1 = (numero1 * 2);
        if (numero1 > 9) {
            var numero1 = (numero1 - 9);
        }
        var numero3 = cedula.substring(2, 3);
        var numero3 = (numero3 * 2);
        if (numero3 > 9) {
            var numero3 = (numero3 - 9);
        }
        var numero5 = cedula.substring(4, 5);
        var numero5 = (numero5 * 2);
        if (numero5 > 9) {
            var numero5 = (numero5 - 9);
        }
        var numero7 = cedula.substring(6, 7);
        var numero7 = (numero7 * 2);
        if (numero7 > 9) {
            var numero7 = (numero7 - 9);
        }
        var numero9 = cedula.substring(8, 9);
        var numero9 = (numero9 * 2);
        if (numero9 > 9) {
            var numero9 = (numero9 - 9);
        }
        var impares = numero1 + numero3 + numero5 + numero7 + numero9;
        //Suma total
        var suma_total = (pares + impares);
        //extraemos el primero digito
        var primer_digito_suma = String(suma_total).substring(0, 1);
        //Obtenemos la decena inmediata
        var decena = (parseInt(primer_digito_suma) + 1) * 10;
        //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
        var digito_validador = decena - suma_total;
        //Si el digito validador es = a 10 toma el valor de 0
        if (digito_validador == 10)
            var digito_validador = 0;
        //Validamos que el digito validador sea igual al de la cedula
        if (digito_validador == ultimo_digito) {
            //document.write('cedula correcto!!!!');
            validador = true;
            //alert("cedula correcto");
            //console.log('la cedula:' + cedula + ' es correcta');
        } else {
            //console.log('la cedula:' + cedula + ' es incorrecta');
            //document.write('cedula incorrecto');
            return validador;
            // alert("cedula no valida");
        }
    } else {
        // imprimimos en consola si la region no pertenece
        // document.write('Esta cedula no pertenece a ninguna region');
        // console.log('Esta cedula no pertenece a ninguna region');
        return validador;
    }
    return validador;
}
var ValidarRuc = function (ruc) {
    var validador = false;
    var digito3;
    var i;
    //var ruc; //asignar elemento id de formulario
    var cadenar;
    var digito;
    var suma = 0;
    var d;
    var c;
    var ver;
    //ruc = document.getElementById("ruc").value;
    if (ruc.length != 13) {
        return validador;
    }
    digito3 = ruc.substring(2, 3);
    if (digito3 < 6) {
        for (i = 1; i < 10; i++) {
            if (i % 2 == 0) {
                cadenar = ruc.substring(i - 1, i);
                suma += parseInt(cadenar);
            } else {
                cadenar = ruc.substring(i - 1, i);
                cadenar = parseInt(cadenar) * 2;
                if (cadenar > 9) {
                    cadenar -= 9;
                    suma += parseInt(cadenar);
                } else {
                    suma += parseInt(cadenar);
                }
            }
        }
        c = suma.toString();
        d = c.substring(0, 1);
        d = d + 0;
        c = parseInt(d);
        d = c + 10;
        digito = d - parseInt(suma);
        ver = ruc.substring(9, 10);
        if (digito != ver) {
            //alert("el ruc es incorrecto");
            return validador;
        } else {
            //alert("ESte ruc pertenece a personas naturales");
            validador = true;
        }
    } else {
        if (digito3 == 6) {
            var psuma = 0;
            var pcadena = 0;
            var p;
            var presiduo;
            var pveri;
            for (p = 1; p < 9; p++) {
                if (p == 1) {
                    pcadena = ruc.substring(p - 1, p);
                    pcadena = parseInt(pcadena) * 3;
                    psuma += parseInt(pcadena);
                } else {
                    if (p == 2) {
                        pcadena = ruc.substring(p - 1, p);
                        pcadena = parseInt(pcadena) * 2;
                        psuma += parseInt(pcadena);
                    } else {
                        if (p == 3) {
                            pcadena = ruc.substring(p - 1, p);
                            pcadena = parseInt(pcadena) * 7;
                            psuma += parseInt(pcadena);
                        } else {
                            if (p == 4) {
                                pcadena = ruc.substring(p - 1, p);
                                pcadena = parseInt(pcadena) * 6;
                                psuma += parseInt(pcadena);
                            } else {
                                if (p == 5) {
                                    pcadena = ruc.substring(p - 1, p);
                                    pcadena = parseInt(pcadena) * 5;
                                    psuma += parseInt(pcadena);
                                } else {
                                    if (p == 6) {
                                        pcadena = ruc.substring(p - 1, p);
                                        pcadena = parseInt(pcadena) * 4;
                                        psuma += parseInt(pcadena);
                                    } else {
                                        if (p == 7) {
                                            pcadena = ruc.substring(p - 1, p);
                                            pcadena = parseInt(pcadena) * 3;
                                            psuma += parseInt(pcadena);
                                        } else {
                                            if (p == 8) {
                                                pcadena = ruc.substring(p - 1, p);
                                                pcadena = parseInt(pcadena) * 2;
                                                psuma += parseInt(pcadena);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } //llave de for endfor
            presiduo = (psuma % 11);
            presiduo = 11 - presiduo;
            pveri = ruc.substring(8, 9);
            if (presiduo != pveri) {
                //alert("el ruc es incorrecto");
                return validador;
            } else {
                // alert("ESTE RUC pertenece a personas publicas");
                validador = true;
            }
        } else {
            if (digito3 == 9) {
                var jsuma = 0;
                var jcadena = 0;
                var j;
                var jresiduo;
                var jveri;
                for (j = 1; j < 10; j++) {
                    if (j == 1) {
                        jcadena = ruc.substring(j - 1, j)
                        jcadena = parseInt(jcadena) * 4;
                        jsuma += parseInt(jcadena);
                    } else {
                        if (j == 2) {
                            jcadena = ruc.substring(j - 1, j)
                            jcadena = parseInt(jcadena) * 3;
                            jsuma += parseInt(jcadena);
                        } else {
                            if (j == 3) {
                                jcadena = ruc.substring(j - 1, j)
                                jcadena = parseInt(jcadena) * 2;
                                jsuma += parseInt(jcadena);
                            } else {
                                if (j == 4) {
                                    jcadena = ruc.substring(j - 1, j)
                                    jcadena = parseInt(jcadena) * 7;
                                    jsuma += parseInt(jcadena);
                                } else {
                                    if (j == 5) {
                                        jcadena = ruc.substring(j - 1, j)
                                        jcadena = parseInt(jcadena) * 6;
                                        jsuma += parseInt(jcadena);
                                    } else {
                                        if (j == 6) {
                                            jcadena = ruc.substring(j - 1, j)
                                            jcadena = parseInt(jcadena) * 5;
                                            jsuma += parseInt(jcadena);
                                        } else {
                                            if (j == 7) {
                                                jcadena = ruc.substring(j - 1, j)
                                                jcadena = parseInt(jcadena) * 4;
                                                jsuma += parseInt(jcadena);
                                            } else {
                                                if (j == 8) {
                                                    jcadena = ruc.substring(j - 1, j)
                                                    jcadena = parseInt(jcadena) * 3;
                                                    jsuma += parseInt(jcadena);
                                                } else {
                                                    if (j == 9) {
                                                        jcadena = ruc.substring(j - 1, j)
                                                        jcadena = parseInt(jcadena) * 2;
                                                        jsuma += parseInt(jcadena);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } //end for
                jresiduo = (jsuma % 11);
                jresiduo = 11 - jresiduo;
                jveri = ruc.substring(9, 10);
                if (jresiduo != jveri) {
                    //alert("el ruc es incorrecto");
                    return validador;
                } else {
                    // alert("ESTE RUC pertenece a personas JURIDICAS");
                    validador = true;
                }
            } //end if 
        }
    }
    return validador;
}