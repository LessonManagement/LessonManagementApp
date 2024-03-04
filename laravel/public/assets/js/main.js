// Coger el ul de navigation para añadirle las clases necesarias
$(document).ready(() => {
    if (document.title != 'Admin - LessonManagement') {
        $('.pagination').closest('nav').addClass('m-0');
        $('.pagination').closest('nav').addClass('ms-auto');
    } else {
        console.log('PRUEBA')
        $('.pagination').closest('nav').addClass('m-0');
        $('.pagination').closest('nav').removeClass('ms-auto');
    }
});