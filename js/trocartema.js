const mode = document.getElementById('mode-icon');

function trocarTema(){
    if(body.classList == 'tema-escuro')
    {
        body.classList = 'tema-claro'
    }
    else
    {
        body.classList = 'tema-escuro'
    }
}

window.onload = function () {
        var temaAtual = localStorage.getItem('temaSelecionado');

        if (temaAtual === 'escuro') 
        {
            body.classList.add('tema-escuro');
            mode.classList.remove('ph-moon');
            mode.classList.add('ph-sun');
        } 
        else
        {
            body.classList.add('tema-claro');
            mode.classList.remove('ph-sun');
            mode.classList.add('ph-moon');
        }
    };

// mode.addEventListener('click', () => {
//     // const form = document.getElementsByClassName('Forms');
//     if(mode.classList.contains('ph-moon')){
//         mode.classList.remove('ph-moon');
//         mode.classList.add('ph-sun');
//         return;
//     }
        
//     mode.classList.add('ph-moon');
//     mode.classList.remove('ph-sun');
// });

