const body = document.getElementById('body');
const mode = document.getElementById('mode-icon');


function trocarTema(){
    if(body.classList == 'tema-escuro')
    {
        body.classList = 'tema-claro';
        mode.classList.remove('ph-sun');
        mode.classList.add('ph-moon');


        localStorage.setItem('temaSelecionado', 'claro');
    }
    else
    {
        body.classList = 'tema-escuro';
        mode.classList.remove('ph-moon');
        mode.classList.add('ph-sun');

        localStorage.setItem('temaSelecionado', 'escuro');
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

// const mode = document.getElementById('mode-icon');

// mode.addEventListener('click', () => {
//     // const form = document.getElementsByClassName('Forms');
//     if(body.classList == 'tema-claro'){
//         mode.classList.remove('ph-moon');
//         mode.classList.add('ph-sun');
//         return;
//     }
        
//     mode.classList.remove('ph-sun');
//     mode.classList.add('ph-moon');
// });

