// Função para alternar entre os idiomas
    document.addEventListener('DOMContentLoaded', function () {
        const toggleLang = () => {
          document.querySelectorAll('.text-pt').forEach(el => el.classList.toggle('hidden'));
          document.querySelectorAll('.text-en').forEach(el => el.classList.toggle('hidden'));
  
          // Alterna o texto do botão entre "Alternar Idioma" e "Change Language"
          const langToggleButton = document.getElementById('langToggle');
          if (langToggleButton.textContent.trim() === "Alternar Idioma") {
            langToggleButton.textContent = "Change Language";
          } else {
            langToggleButton.textContent = "Alternar Idioma";
          }
        };
  
        // Adicionar evento de clique ao botão de alternar idiomas
        document.getElementById('langToggle').addEventListener('click', toggleLang);
      });

    