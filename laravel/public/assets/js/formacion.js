(() => {
    'use strict'
    const url = document.querySelector('meta[name="url-base"]')['content'];
    const csrf  = document.querySelector('meta[name="csrf-token"]')['content'];
   

    document.addEventListener('DOMContentLoaded', function(){
        peticionFormaciones();
    });

    
    /**
     * Metodo para la peticion al metodo indexAjax
     */
    function peticionFormaciones(){
        fetch(url + '/index')
       .then(response => response.json())
       .then(data => {
           console.log(data);
           tablaFormacion(data.formaciones);
       })
       .catch(error => console.error("Error:", error));
   };



   function tablaFormacion(formaciones){
    let tbody = document.getElementById('tbody');
    formaciones.forEach((formacion)=>{
        let tr = document.createElement('tr');

        let tdID = document.createElement('td');
        tdID.textContent  = formacion.id;

        let tdDenominacion = document.createElement('td');
        tdDenominacion.textContent  = formacion.denominacion;

        let tdSiglas = document.createElement('td');
        tdSiglas.textContent  = formacion.siglas;

        let botones = document.createElement('td');
        botones.className = 'text-end';

        tr.appendChild(tdID);
        tr.appendChild(tdDenominacion);
        tr.appendChild(tdSiglas);
        tr.appendChild(botones);

        let spanDrop = document.createElement('span');
        spanDrop.className = 'dropdown';

        botones.appendChild(spanDrop);

        let buttonDrop = document.createElement('button');
        buttonDrop.className = 'btn dropdown-toggle align-text-top';
        buttonDrop.setAttribute('data-bs-boundary', 'viewport');
        buttonDrop.setAttribute('data-bs-toggle', 'dropdown');
        buttonDrop.textContent  = 'Acciones';

        let divDrop = document.createElement('div');
        divDrop.className = 'dropdown-menu dropdown-menu-end';

        spanDrop.appendChild(buttonDrop);
        spanDrop.appendChild(divDrop);

        let mostrar = document.createElement('a');
        mostrar.className = 'dropdown-item';
        mostrar.setAttribute('href', '');
        mostrar.setAttribute('style', 'transform: translate3d(0px, auto, 0px)');
        mostrar.textContent  = 'Mostrar';
        
        let Editar = document.createElement('a');
        Editar.className = 'dropdown-item';
        Editar.setAttribute('href', '');
        Editar.textContent  = 'Editar';

        let Eliminar = document.createElement('button');
        Eliminar.setAttribute('type', 'button');
        Eliminar.setAttribute('form', 'deleteFormacionForm');
        Eliminar.className = 'dropdown-item';
        Eliminar.setAttribute('data-url', '');
        Eliminar.setAttribute('data-denominacion', formacion.denominacion);
        Eliminar.setAttribute('data-bs-toggle', 'modal');
        Eliminar.setAttribute('data-bs-target', '#deleteFormacionModal');
        Eliminar.textContent  = 'Eliminar';
        
        divDrop.appendChild(mostrar);
        divDrop.appendChild(Editar);
        divDrop.appendChild(Eliminar);


        tr.appendChild(botones);

        tbody.appendChild(tr);
        
    });
   }
})()