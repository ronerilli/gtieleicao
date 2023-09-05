// Capturando elementos do DOM
var dataInicioInput = document.getElementById("data_inicio");
var dataFimInput = document.getElementById("data_fim");

// Adicionando um ouvinte de evento para verificar quando a data de término é alterada
dataFimInput.addEventListener("change", function () {
    var dataInicio = new Date(dataInicioInput.value);
    var dataFim = new Date(dataFimInput.value);

    // Verificando se a data de término é menor que a data de início
    if (dataFim < dataInicio) {
        openErrorModal("A data de término não pode ser menor que a data de início.");
        dataFimInput.value = ""; // Limpa o campo de data de término
    }
});