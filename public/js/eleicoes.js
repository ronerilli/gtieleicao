document.addEventListener('DOMContentLoaded', () => {
    const toggleButtons = document.querySelectorAll('.toggle-bio');
    const showMore = document.querySelectorAll('.more');
    const voteBtn = document.querySelectorAll('.vote-button');

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (button.innerText == 'Mostrar Biografia') {
                button.innerText = 'Ocultar Biografia';
            } else {
                button.innerText = 'Mostrar Biografia';
            }
        });
    });
    showMore.forEach(button => {
        button.addEventListener('click', () => {
            bio = button.previousSibling.previousSibling
            if (button.innerText == 'Mostrar tudo') {
                bio.style.height = 'auto' 
                button.innerText = 'Mostrar menos';
            } else {
                bio.style.height = '100px'
                button.innerText = 'Mostrar tudo';
            }
        });
    });
    voteBtn.forEach(button => {
        button.addEventListener('click', () => {
            let campos = document.getElementById(`form-${button.id}`).elements
            let postdata = {}
            for (let i = 0; i < campos.length; i++){
                postdata[campos[i].name] = campos[i].value
            }
            console.log("bateu aqui")
            $.post("", postdata)
                .done(function(data){
                    if (data.status == 201){
                        openSuccessModal(data.message)
                        $(".vote-button").prop('disabled', true)
                        $(".vote-button").text('Você já votou')
                    }
                    else {
                        openErrorModal(data.message)
                    }
                })
                
        });
    });
})