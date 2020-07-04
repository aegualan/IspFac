function imprimirOpciones(dominio) {
    var url = '/traer-opciones';
    var pintarOpciones = $("#opciones");
    $.get(url, function(res) {
        //funcion eleminarObjetosDuplicados elimina elentos repetidos en JDSON 
        var menu = eliminarObjetosDuplicados(res, 'codMenu');
        //ordena elementos de json .sor
        var MenuPadreOrdenado = menu.sort(function(a, b) {
            return a.ordMenu - b.ordMenu;
        });
        var html = "";
        for (x = 0; x < MenuPadreOrdenado.length; x++) {
            html = html + '<li class="treeview ' + activePadre(res, MenuPadreOrdenado[x].codMenu, dominio) + '">\n\
                           <a href="#"><i class="' + MenuPadreOrdenado[x].icoMenu + '"></i> <span>' + MenuPadreOrdenado[x].nomMenu + '</span>\n\
                           <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>\n\
                            <ul class="treeview-menu">' + traerOpcionesPorMenu(res, MenuPadreOrdenado[x].codMenu, dominio) + '</ul></li>';
        }
        pintarOpciones.append(html);
    });
}
var traerOpcionesPorMenu = function(jsonMenu, codMenu, dominio) { //hijos
    try {
        var opcionesHijos = '';
        var opcionesOrdenados = opcionPorID(jsonMenu, codMenu);
        for (i = 0; i < opcionesOrdenados.length; i++) {
            var urlBase = dominio + "/" + opcionesOrdenados[i].urlWeb;
            var urlActual = window.location.href;
            if (urlBase.toLowerCase() == urlActual.toLowerCase()) {
                opcionesHijos = opcionesHijos + '<li class="active">\n\
            <a href="/' + opcionesOrdenados[i].urlWeb + '"><i class="fa fa-circle-o"></i>' + opcionesOrdenados[i].nomOpcion + '</a></li>';
            } else {
                opcionesHijos = opcionesHijos + '<li>\n\
            <a href="/' + opcionesOrdenados[i].urlWeb + '"><i class="fa fa-circle-o"></i>' + opcionesOrdenados[i].nomOpcion + '</a></li>';
            }
        }
        return opcionesHijos;
    } catch (ex) {
        console.error("error al buscar menu hijo " + ex);
    }
}
var activePadre = function(jsonOpciones, codMenu, dominio) { //hijos
    try {
        var activo = '';
        var opcionesOrdenados = opcionPorID(jsonOpciones, codMenu);
        for (i = 0; i < opcionesOrdenados.length; i++) {
            var urlBase = dominio + "/" + opcionesOrdenados[i].urlWeb;
            var urlActual = window.location.href;
            if (urlBase.toLowerCase() == urlActual.toLowerCase()) {
                if (opcionesOrdenados[i].codMenu == codMenu) {
                    activo = 'active';
                }
            }
        }
        return activo;
    } catch (ex) {
        console.error("error al activar menu padre " + ex);
    }
}
var eliminarObjetosDuplicados = function(arr, prop) {
    var nuevoArray = [];
    var lookup = {};
    for (var i in arr) {
        lookup[arr[i][prop]] = arr[i];
    }
    for (i in lookup) {
        nuevoArray.push(lookup[i]);
    }
    return nuevoArray;
}
var opcionPorID = function(jsonOpciones, codMenu) {
    var opcionesFiltrados = jsonOpciones.filter(function(v) {
        return v.codMenu == codMenu
    });
    var opcionesOrdenados = opcionesFiltrados.sort(function(a, b) {
        return a.ordOpcion - b.ordOpcion;
    });
    return opcionesOrdenados;
}