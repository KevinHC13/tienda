import Dropzone from "dropzone";

// Evita que Dropzone se autoinicialice en todos los elementos de la página
Dropzone.autoDiscover = false;

// Crea una nueva instancia de Dropzone en el elemento con el ID "dropzone"
const dropzoneCSV = new Dropzone('#dropzoneCsv', {
    dictDefaultMessage: 'Sube aquí el CSV',
    acceptedFiles: ".csv",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    // Configuración adicional y personalizada
    init: function() {
        // Verifica si ya hay una imagen cargada y la muestra como vista previa
        if (document.querySelector('[name="picture"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="picture"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});
