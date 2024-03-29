(() => {
    'use strict'
    const url = document.querySelector('meta[name="url-base"]')['content'];
    const csrf  = document.querySelector('meta[name="csrf-token"]')['content'];
    var btnDelete = document.getElementById('btnDelete');
    var btncreate = document.getElementById('btncreate');
    var createModal = document.getElementById('createFormacionModal');
   

    document.addEventListener('DOMContentLoaded', function(){
        peticionFormaciones();
    });

    /**
     * evento para crear formacion
     */
    btncreate.addEventListener('click', function(){
        console.log('hola estoy aquí');
        llamadaCreate();
    });

    createModal.addEventListener('hidden.bs.modal', event => {
        document.getElementById('inputDenominacionCreate').value = '';
        document.getElementById('inputSiglasCreate').value = '';
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
   function llamadaCreate(){
    let data = {
        denominacion: document.getElementById('inputDenominacionCreate').value,
        siglas: document.getElementById('inputSiglasCreate').value
    };
    fetch(url + '/formacion' , {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
          console.log(data);
        if(data.result){
            let modalElem = document.getElementById('createFormacionModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElem);
            modalInstance.hide();

            let arletok = document.getElementById('arlet');
            arletok.className = 'alert alert-success mt-3';

            tablaFormacion(data.formaciones);
        }else{
            let modalElem = document.getElementById('createFormacionModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElem);
            modalInstance.hide();
            
            let arletok = document.getElementById('arlet');
            arletok.className = 'alert alert-danger mt-3';
            arletok.textContent = 'La formacion no se a podido crear';
        }
      })
      .catch(error => console.error("Error:", error));
  };
  
   /**
    * Metodo para la peticion al metodo delete   
    */
   function llamadaDelete(id){
    fetch(url + '/formacion/'+ id, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf
        }
      })
      .then(response => response.json())
      .then(data => {
        if(data.result){
            let modalElem = document.getElementById('deleteFormacionModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElem);
            modalInstance.hide();

            let arletok = document.getElementById('arlet');
            arletok.className = 'alert alert-success mt-3';
            arletok.textContent = 'Formacion borrada correctamente';

            tablaFormacion(data.formaciones);
        }else{
            let modalElem = document.getElementById('deleteFormacionModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElem);
            modalInstance.hide();
            
            let arletok = document.getElementById('arlet');
            arletok.className = 'alert alert-danger mt-3';
            arletok.textContent = 'No se a podido borrar la Formacion';
        }
      })
      .catch(error => console.error("Error:", error));
  };

  /**
   * Metodo para la peticion al metodo update
   */
  function llamadaEdit(id){
    let data = {
        denominacion: document.getElementById('inputDenominacionEdit').value,
        siglas: document.getElementById('inputSiglasEdit').value
    };
    fetch(url + '/formacion/'+ id, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        if(data.result){
            let modalElem = document.getElementById('editFormacionModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElem);
            modalInstance.hide();

            let arletok = document.getElementById('arlet');
            arletok.className = 'alert alert-success mt-3';
            arletok.textContent = 'Formacion editada correctamente';

            tablaFormacion(data.formaciones);
        }else{
            let modalElem = document.getElementById('editFormacionModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElem);
            modalInstance.hide();
            
            let arletok = document.getElementById('arlet');
            arletok.className = 'alert alert-danger mt-3';
            arletok.textContent = 'No se a podido editar';
        }
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
        editar.textContent  = 'Editar';
        editar.setAttribute('data-bs-toggle', 'modal');
        editar.setAttribute('data-bs-target', '#editFormacionModal');
        editar.setAttribute('data-denominacion', formacion.denominacion);
        editar.setAttribute('data-id', formacion.id);
        editar.setAttribute('data-siglas', formacion.siglas);
        /**
        * evento para editar formacion
        */
        editar.onclick = function(){
            llamadaEdit(formacion.id);
        };

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

        /**
        * evento para borrar formacion
        */
        eliminar.onclick = function(){
            llamadaDelete(formacion);
        };
        
        divDrop.appendChild(mostrar);
        divDrop.appendChild(editar);
        divDrop.appendChild(eliminar);


        tr.appendChild(botones);

        tbody.appendChild(tr);
        
    });
   }
})()