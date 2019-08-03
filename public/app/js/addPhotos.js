Dropzone.autoDiscover = false;

$(function () {

  
    myDropzone.on("success", function(file) {
      $.notify("Foto añadida con éxito.", "success");
    });
});
