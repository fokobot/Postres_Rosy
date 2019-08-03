$(function () {

  var selectDpto = document.querySelector("#departamento");
  var selectMunicipio = document.querySelector("#municipio")

  selectDpto.addEventListener('change', function () {
    selectMunicipio.innerHTML = "";
    var id = selectDpto.value;
    loadMunicipiosDepartamento(id);
  });

  function loadMunicipiosDepartamento(id) {
    fetch('/api/departamentos/' + id)
    .then(function(response) {
      return response.json();
    })
    .then(function(municipios) {
      for (var i = 0; i < municipios.length; i++) {
        var o = new Option(municipios[i].nombre, municipios[i].id);
        selectMunicipio.add(o);
      }
    });
  }

  loadMunicipiosDepartamento(1);
  
  $("div#dz1").dropzone({ url: "/file/post" });

});
