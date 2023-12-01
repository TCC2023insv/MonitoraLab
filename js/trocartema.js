const body = document.getElementById('body')

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

const mode = document.getElementById('mode-icon');

mode.addEventListener('click', () => {
    // const form = document.getElementsByClassName('Forms');
    if(mode.classList.contains('ph-moon')){
        mode.classList.remove('ph-moon');
        mode.classList.add('ph-sun');
        return;
    }
        
    mode.classList.add('ph-moon');
    mode.classList.remove('ph-sun');
});

