<div class="modal modal-blur fade" id="deleteModuloModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
                <h3>Estás seguro?</h3>
                <div class="text-muted">¿Deseas borrar el modulo <span class="font-weight-bold"
                        id="nombre-modulo"></span>?</div>
            </div>
            <form id="deleteForm" action="{{ url('') }}" method="post">
                @csrf
                @method('delete')
            </form>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cancelar
                            </a>
                        </div>
                        <div class="col">
                            <button class="btn w-100" form="deleteForm" type="submit">
                                Eliminar módulo
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
    const deleteModal = document.getElementById('deleteModuloModal');
    const siglasModulo = document.getElementById('nombre-modulo');
    const formDelete = document.getElementById('deleteForm');

    deleteModal.addEventListener('show.bs.modal', event => {
        let siglas = event.relatedTarget.dataset.siglas;
        let url = event.relatedTarget.dataset.url;

        siglasModulo.innerText = siglas;
        formDelete.action = url;
    });
</script>
