<div class="modal modal-blur fade" id="showFormacionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-primary"></div>
            <div class="modal-body text-start py-4">
                <div class="text-muted">ID: <span class="font-weight-bold"
                        id="id"></span></div>
                <div class="text-muted">Denominacion: <span class="font-weight-bold"
                        id="denominacion"></span></div>
                <div class="text-muted">Siglas: <span class="font-weight-bold"
                        id="siglas"></span></div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cerrar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Funcionalidad mostrar formacion
    const showModal = document.getElementById('showFormacionModal');
    const showdenominacion = document.getElementById('denominacion');
    const showsiglas = document.getElementById('siglas');
    const showid = document.getElementById('id');

    showModal.addEventListener('show.bs.modal', (event) => {
        let denominacion = event.relatedTarget.dataset.denominacion;
        let siglas = event.relatedTarget.dataset.siglas;
        let id = event.relatedTarget.dataset.id;

        showdenominacion.innerText = denominacion;
        showsiglas.innerText = siglas;
        showid.innerText = id;
    });
</script>
