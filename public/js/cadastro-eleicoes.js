var dataHoje = new Date();
var dataInicioInput = document.getElementById("data_inicio");
var dataFimInput = document.getElementById("data_fim");

dataInicioInput.addEventListener("change", function () {
    var dataInicio = new Date(dataInicioInput.value);

    if (dataInicio < dataHoje) {
        openErrorModal("A data de início não pode ser anterior ao dia de hoje.");
        dataFimInput.value = "";    
    }
});

dataFimInput.addEventListener("change", function () {
    var dataInicio = new Date(dataInicioInput.value);
    var dataFim = new Date(dataFimInput.value);

    if (dataFim < dataInicio) {
        openErrorModal("A data de término não pode ser anterior à data de início.");
        dataFimInput.value = "";
    }
});