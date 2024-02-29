<div class="modal modal-blur fade" id="regenerateLeccionesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-warning"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-warning icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v4" />
                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                    <path d="M12 16h.01" />
                </svg>
                <h3>¿Estás seguro?</h3>
                <div class="text-muted">Esta acción sobreescribirá toda la base de datos de lecciones generando nuevas lecciones</div>
            </div>
            <form id="regenerateForm" action="{{ url('leccion/create') }}" method="get">
                <input type="hidden" name="op" value="regen">
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
                            <button class="btn btn-warning w-100" form="regenerateForm" type="submit">
                                Regenerar lecciones
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
