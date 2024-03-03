<div class="modal modal-blur fade" id="createFormacionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-success"></div>
            <div class="modal-body text-center py-4">
                <h3>Crear nueva Formacion</h3>
                <input type="text" id="inputDenominacionCreate" name="denominacion" class="form-control" placeholder="Escribe la denominacion">
                <input type="text" id="inputSiglasCreate" name="siglas" class="form-control mt-2" placeholder="Escribe sus siglas">
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
                            <button id="btncreate" class="btn btn-success w-100" >
                                Crear Formacion
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
    const createModal = document.getElementById('deleteFormacionModal');
    const createDenominacion = document.getElementById('denominacion-Formacion');
    const createForm = document.getElementById('deleteForm');

    deleteModal.addEventListener('show.bs.modal', event => {
        let denominacion = event.relatedTarget.dataset.denominacion;
        let url = event.relatedTarget.dataset.url;

        denominacionGrupo.innerText = denominacion;
        formDelete.action = url;
    });
</script>
