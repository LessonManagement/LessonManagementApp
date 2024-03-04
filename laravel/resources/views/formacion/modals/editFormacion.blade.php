<div class="modal modal-blur fade" id="editFormacionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-info"></div>
            <div class="modal-body text-center py-4">
                <h3>Editar<span class="font-weight-bold"
                        id="denominacion"></span></h3>
                <input type="text" id="inputDenominacionEdit" name="denominacion" class="form-control" placeholder="Escribe la denominacion">
                <input type="text" id="inputSiglasEdit" name="siglas" class="form-control mt-2" placeholder="Escribe sus siglas">
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancelar
                            </a>
                        </div>
                        <div class="col">
                            <button id="btncreate" class="btn btn-info w-100" >
                                Editar Formacion
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Funcionalidad para borrar módulos
    const editModal = document.getElementById('editFormacionModal');
    const editDenominacion = document.getElementById('denominacion');
    const editinputD = document.getElementById('inputDenominacionEdit');
    const editinputS = document.getElementById('inputSiglasEdit');

    editModal.addEventListener('show.bs.modal', event => {
        let denominacion = event.relatedTarget.dataset.denominacion;
        let siglas = event.relatedTarget.dataset.siglas;
        editDenominacion.innerText = denominacion;
        editinputD.value = denominacion;
        editinputS.value = siglas;
    });
</script>
