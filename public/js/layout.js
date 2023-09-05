function openErrorModal(message){
    classes = $("#modalOk").attr("class")
    if (classes.includes("primary")){
        $("#modalOk").removeClass("btn-primary")
        $("#modalOk").addClass("btn-danger")
    }
    else {
        $("#modalOk").addClass("btn-danger")
    }
    $(".modal-title").text("Erro")
    $(".modal-body").text(message)
    $("#modalButton").trigger( "click" )
}
function openSuccessModal(message){
    classes = $("#modalOk").attr("class")
    if (classes.includes("danger")){
        $("#modalOk").removeClass("btn-danger")
        $("#modalOk").addClass("btn-primary")
    }
    else {
        $("#modalOk").addClass("btn-primary")
    }
    $(".modal-title").text("Sucesso")
    $(".modal-body").text(message)
    $("#modalButton").trigger( "click" )
}