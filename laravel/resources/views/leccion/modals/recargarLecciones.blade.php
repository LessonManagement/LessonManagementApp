<div class="modal modal-blur fade" id="recargarLeccionesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-info"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                <h3>¿Estás seguro?</h3>
                <div class="text-muted">
                    Esta acción recargará la lista de lecciones creando las lecciones faltantes sin modificar las
                    lecciones ya generadas.

                </div>
            </div>
            <form id="recargarForm" action="{{ url('leccion/create') }}" method="get">
                <input type="hidden" name="op" value="recarga">
            </form>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Cerrar
                            </a>
                        </div>
                        <div class="col">
                            <button class="btn btn-info w-100" form="recargarForm" type="submit">
                                Recargar lecciones
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
