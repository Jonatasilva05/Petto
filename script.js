document.addEventListener('DOMContentLoaded', function () {
    let currentLang = localStorage.getItem('selectedLang') || 'pt'; // Verifica se há um idioma salvo, senão usa 'pt'

    function toggleLanguage(newLang) {
        // Salva o idioma escolhido no localStorage
        localStorage.setItem('selectedLang', newLang);

        // Atualiza a exibição das bandeiras
        document.getElementById('toggleEn').style.display = newLang === 'en' ? 'none' : 'inline-block';
        document.getElementById('toggleEs').style.display = newLang === 'es' ? 'none' : 'inline-block';
        document.getElementById('togglePt').style.display = newLang === 'pt' ? 'none' : 'inline-block';

        // Alterna a visibilidade dos textos de acordo com o idioma
        document.querySelectorAll('.text-pt').forEach(el => el.classList.toggle('hidden', newLang !== 'pt'));
        document.querySelectorAll('.text-en').forEach(el => el.classList.toggle('hidden', newLang !== 'en'));
        document.querySelectorAll('.text-es').forEach(el => el.classList.toggle('hidden', newLang !== 'es'));

        currentLang = newLang; // Atualiza a variável de controle
        console.log("Idioma alterado para:", currentLang);
    }

    // Aplica o idioma salvo ao carregar a página
    toggleLanguage(currentLang);

    // Adiciona eventos de clique aos botões
    document.getElementById('toggleEn').addEventListener('click', () => toggleLanguage('en'));
    document.getElementById('togglePt').addEventListener('click', () => toggleLanguage('pt'));
    document.getElementById('toggleEs').addEventListener('click', () => toggleLanguage('es'));
});