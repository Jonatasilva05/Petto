document.addEventListener('DOMContentLoaded', function () {
    // FAZ A VERIFICAÇÃO SE JA HOUVE UM ACESSO ANTERIOR COM ISSO RESTAURA O IDIOMA ESCOLHIDO, CASO CONTRÁRIO SE FOR O PRIMEIRO ACESSO ELE COMEÇARÁ COM O PORTUGUÊS-BR
    let currentLang = localStorage.getItem('selectedLang') || 'pt';

    function toggleLanguage(newLang) {
        // SALVA O IDIOMA ESCOLHIDO EM localStorage "MEIO QUE USO DE COOKIES"
        localStorage.setItem('selectedLang', newLang);

        // FAZ A ATUALIZAÇÃO DAS BANDEIRAS CONFORME A ESCOLHA DO USUARIO
        document.getElementById('toggleEn').style.display = newLang === 'en' ? 'none' : 'inline-block';
        document.getElementById('toggleEs').style.display = newLang === 'es' ? 'none' : 'inline-block';
        document.getElementById('togglePt').style.display = newLang === 'pt' ? 'none' : 'inline-block';

        // ALTERNA O IDIOMA DOS TEXTOS CONFORME A ESCOLHA DO USUARIO PELO IDIOMA
        document.querySelectorAll('.text-pt').forEach(el => el.classList.toggle('hidden', newLang !== 'pt'));
        document.querySelectorAll('.text-en').forEach(el => el.classList.toggle('hidden', newLang !== 'en'));
        document.querySelectorAll('.text-es').forEach(el => el.classList.toggle('hidden', newLang !== 'es'));

        // FAZ A ATUALIZAÇÃO DA VARIÁVEL DE CONTROLE
        currentLang = newLang; 
        console.log("Idioma alterado para:", currentLang);
    }

    // APLICA O IDIOMA QUE FOI ESCOLHIDO PELO USUARIO
    toggleLanguage(currentLang);

    // APLICA EVENTOS DE CLICK NOS BOTÕES
    document.getElementById('toggleEn').addEventListener('click', () => toggleLanguage('en'));
    document.getElementById('togglePt').addEventListener('click', () => toggleLanguage('pt'));
    document.getElementById('toggleEs').addEventListener('click', () => toggleLanguage('es'));
});

function alterarTamanhoTexto(fator) {
    // APLICA O NOVO TAMANHO DA FONTE NO TEXTO
    const textPt = document.querySelectorAll('.text-pt');
    const textEn = document.querySelectorAll('.text-en');
    const textEs = document.querySelectorAll('.text-es');
    
    textPt.forEach(function(el) {
        el.style.fontSize = (parseFloat(getComputedStyle(el).fontSize) * fator) + "px";
    });

    textEn.forEach(function(el) {
        el.style.fontSize = (parseFloat(getComputedStyle(el).fontSize) * fator) + "px";
    });

    textEs.forEach(function(el) {
        el.style.fontSize = (parseFloat(getComputedStyle(el).fontSize) * fator) + "px";
    });
}





// toggle-dark-mode modoEscuro
// FUNÇÃO PARA ATIVAR O MODO ESCURO
// PEGA OS ELEMENTOS DE BOTÃO E CORPO DO DOCUMENTO(HTML)
const modoEscuro = document.getElementById('modoEscuro');
const modoDark = document.getElementById('modoDark');
const modoOscuro = document.getElementById('modoOscuro');
const body = document.body;

// FUNÇÃO PARA AUTALIZAR O BOTÃO
function updateButtonText() {
    if (body.classList.contains('dark-mode')) {
        modoEscuro.textContent = 'Modo Claro';  // TROCA O TEXTO DO BOTÃO PARA (Modo Claro)
    } else {
        modoEscuro.textContent = 'Modo Escuro'; // TROCA O TEXTO DO BOTÃO PARA (Modo Escuro)
    }
}

// VERIFICA SE O MODO ESCURO DA PAGINA ESTÁ ATIVADO
if (localStorage.getItem('dark-mode') === 'true') {
    body.classList.add('dark-mode');
}

// ATUALIZA O TEXTO DO BOTÃO REFERENTE A ESCOLHA DE MODO ESCURO OU CLARO
updateButtonText();

// ADICIONA EVENTO PARA ALTERNAR ENTRE O MODO ESCURO E O MODO CLARO
toggleButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    
    // SALVA A ESCOLHA DO USUARIO EM LocalStorage, OU SEJA, "ARMAZENA" EM localStorage PARA MANTER A PREFERÊNCIA DO USUARIO
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('dark-mode', 'true');
    } else {
        localStorage.setItem('dark-mode', 'false');
    }

    // ATUALIZA O TEXTO DO BOTÃO NOVAMENTE, PARA NÃO TER CONFLITOS ENTRE O NOME E O QUE ESTÁ DECRITO NO BOTÃO
    updateButtonText();
});

