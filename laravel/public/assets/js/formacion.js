(() => {
    'use strict'
    const url = document.querySelector('meta[name="url-base"]')['content'];
    const csrf  = document.querySelector('meta[name="csrf-token"]')['content'];
    var btnDelete = document.getElementById('btnDelete');
   

    document.addEventListener('DOMContentLoaded', function(){
        peticionFormaciones();
    });

    btnDelete.addEventListener('click', function(){
        llamadaDelete();
        console.log('funciona');
        let id = document.getElementById('deletebtn')
        console.log(id.getAttribute("data-id"));
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
   
   /**
    * Metodo para la peticion al metodo delete
    *     
    */
   function llamadaDelete(){
    let id = document.getElementById('deletebtn');
    fetch(url + '/formacion/'+ id.getAttribute("data-id"), {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf
        }
      })
      .then(response => response.json())
      .then(data => {
          console.log(data);
          var modalElem = document.getElementById('deleteFormacionModal');
          var modalInstance = bootstrap.Modal.getInstance(modalElem);
          modalInstance.hide();
          tablaFormacion(data.formaciones);
      })
      .catch(error => console.error("Error:", error));
  };

   /** 
    * Construccion de la tabla formacion 
    */
   function tablaFormacion(formaciones){
    let tbody = document.getElementById('tbody');
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }
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

        let mostrar = document.createElement('button');
        mostrar.className = 'dropdown-item';
        mostrar.setAttribute('style', 'transform: translate3d(0px, auto, 0px)');
        mostrar.setAttribute('data-bs-toggle', 'modal');
        mostrar.setAttribute('data-bs-target', '#showFormacionModal');
        mostrar.setAttribute('data-denominacion', formacion.denominacion);
        mostrar.setAttribute('data-id', formacion.id);
        mostrar.setAttribute('data-siglas', formacion.siglas);
        mostrar.textContent  = 'Mostrar';
        
        let editar = document.createElement('button');
        editar.className = 'dropdown-item';
        editar.setAttribute('href', '');
        editar.textContent  = 'Editar';

        let eliminar = document.createElement('button');
        eliminar.setAttribute('type', 'button');
        eliminar.setAttribute('form', 'deleteFormacionForm');
        eliminar.setAttribute('id', 'deletebtn');
        eliminar.className = 'dropdown-item';
        eliminar.setAttribute('data-url', url + `formacion/${formacion.id}`);
        eliminar.setAttribute('data-denominacion', formacion.denominacion);
        eliminar.setAttribute('data-id', formacion.id);
        eliminar.setAttribute('data-bs-toggle', 'modal');
        eliminar.setAttribute('data-bs-target', '#deleteFormacionModal');
        eliminar.textContent  = 'Eliminar';
        
        divDrop.appendChild(mostrar);
        divDrop.appendChild(editar);
        divDrop.appendChild(eliminar);


        tr.appendChild(botones);

        tbody.appendChild(tr);
        
    });
   }
})()