<div class="modal modal-blur fade" id="generateLeccionesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-info"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-info icon-lg" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                    <path d="M12 9h.01" />
                    <path d="M11 12h1v4h1" />
                </svg>
                <h3>Lecciones no generadas</h3>
                <div class="text-muted">Las lecciones aún no han sido generadas. ¿Te gustaría generarlas ahora?</div>
            </div>
            <form id="generateForm" action="{{ url('leccion/create') }}" method="get">
                <input type="hidden" name="op" value="generate">
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
                            <button class="btn btn-info w-100" form="generateForm" type="submit">
                                Generar lecciones
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
