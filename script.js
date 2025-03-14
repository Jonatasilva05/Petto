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
