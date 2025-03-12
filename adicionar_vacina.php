
<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$usuario_id = $_SESSION['id'];

// Buscar vacinas do usuário
$sql_vacinas = "SELECT * FROM carteira_vacinacao WHERE usuario_id = $usuario_id";
$result_vacinas = $mysqli->query($sql_vacinas);

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

  <!-- Menu de Navegação (Fixo no topo) -->
  <nav class="navbar navbar-expand-lg bg-dark-custom">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">Petto</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html"><i class="fas fa-home"></i> 
              <span class="text-pt">Início</span>
              <span class="text-en hidden">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="painel.php"><i class="fas fa-syringe"></i> 
              <span class="text-pt">Vacinação</span>
              <span class="text-en hidden">Vaccination</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adicionar_vacina.php"><i class="fas fa-bell"></i> 
              <span class="text-pt">Lembrete</span>
              <span class="text-en hidden">Reminder</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Pagina5.html"><i class="fas fa-phone"></i> 
              <span class="text-pt">Contato</span>
              <span class="text-en hidden">Contact</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-sign-in-alt"></i> 
              <span class="text-pt">Entrar</span>
              <span class="text-en hidden">Login</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> 
              <span class="text-pt">Cadastrar-se</span>
              <span class="text-en hidden">Sign Up</span>
            </a>
          </li>
        </ul>
        <button class="btn btn-outline-light ms-3" id="langToggle">Alternar Idioma</button>
      </div>
    </div>
  </nav>
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>



    <div class="container p-4">
<h1>
    <span class="text-pt">Lembrete Carteira Digital de Vacinação</span>
    <span class="text-en hidden">Reminder Digital Vaccination Wallet</span>
</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>
                <span class="text-pt">Vacina</span>
                <span class="text-en hidden">Vaccine</span>
            </th>
            <th>
                <span class="text-pt">Data de Aplicação</span>
                <span class="text-en hidden">Application Date</span>
            </th>
            <th>
                <span class="text-pt">Próxima Dose</span>
                <span class="text-en hidden">Next Dose</span>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php while ($vacina = $result_vacinas->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($vacina['vacina_nome']) ?></td>
                        <td><?= date('d/m/Y', strtotime($vacina['data_aplicacao'])) ?></td>
                        <td><?= $vacina['proxima_dose'] ? date('d/m/Y', strtotime($vacina['proxima_dose'])) : 'N/A' ?></td>
                    </tr>
                <?php endwhile; ?>
    </tbody>
</table>
    </div>



    <section class="bg-light section-padding">
        <div class="container p-2">
            <h2>
                <span class="text-pt">Perguntas Frequentes</span>
                <span class="text-en hidden">Frequently Asked Questions</span>
            </h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                            <span class="text-pt">O que é o Lembrete de Vacinação?</span>
                            <span class="text-en hidden">What is the Vaccination Reminder?</span>
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <span class="text-pt">Lembrete é um serviço especializado em notificar os tutores sobre as datas essenciais de vacinação dos seus animais de estimação.</span>
                            <span class="text-en hidden">Reminder is a specialized service to notify guardians about essential vaccination dates for their pets.</span>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeadingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                            <span class="text-pt">Como funciona o Lembrete de Vacinação?</span>
                            <span class="text-en hidden">How does the Vaccination Reminder work?</span>
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <span class="text-pt">O Lembrete mantém um registro organizado das vacinas em uma lista, que pode ser facilmente acessada por meio desta página.</span>
                            <span class="text-en hidden">Reminder keeps an organized record of vaccinations in a list, which can be easily accessed through this page.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



     <!-- Seção do Rodapé -->
  <footer class="bg-dark text-white pt-5">
    <div class="container">
      <div class="row">
        <!-- Seção de Serviços -->
        <div class="col-md-4 mb-4">
          <h5 class="text-uppercase">
            <span class="text-pt">Nossos Serviços</span>
            <span class="text-en hidden">Our Services</span>
          </h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none">
              <span class="text-pt">Carteira Digital de Vacinação</span>
              <span class="text-en hidden">Digital Vaccination Card</span>
            </a></li>
            <li><a href="#" class="text-white text-decoration-none">
              <span class="text-pt">Serviço de Dogwalk</span>
              <span class="text-en hidden">Dog Walking Service</span>
            </a></li>
            <li><a href="#" class="text-white text-decoration-none">
              <span class="text-pt">Consultoria de Saúde Pet</span>
              <span class="text-en hidden">Pet Health Consultancy</span>
            </a></li>
          </ul>
        </div>

        <!-- Seção de Contato -->
        <div class="col-md-4 mb-4">
          <h5 class="text-uppercase">
            <span class="text-pt">Contato</span>
            <span class="text-en hidden">Contact</span>
          </h5>
          <ul class="list-unstyled">
            <li><i class="fas fa-envelope me-2"></i>
              <a href="mailto:contato@petto.com.br" class="text-white text-decoration-none">contato@petto.com.br</a>
            </li>
            <li><i class="fas fa-phone me-2"></i>
              <a href="tel:+551199144-4959" class="text-white text-decoration-none">+55 11 99144-4959</a>
            </li>
            <li><i class="fas fa-map-marker-alt me-2"></i>
              <span class="text-pt">Rua Eleodora Cintra, 45 - São Paulo</span>
              <span class="text-en hidden">Rua Eleodora Cintra, 45 - São Paulo</span>
            </li>
          </ul>
        </div>

        <!-- Seção de Redes Sociais -->
        <div class="col-md-4 mb-4">
          <h5 class="text-uppercase">
            <span class="text-pt">Siga-nos</span>
            <span class="text-en hidden">Follow Us</span>
          </h5>
          <div class="d-flex">
            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in fa-lg"></i></a>
          </div>
        </div>
      </div>

      <!-- Divisor -->
      <hr class="border border-light opacity-25">
      
      <!-- Seção Inferior -->
      <div class="row">
        <div class="col text-center">
          <p class="mb-0">
            <span class="text-pt">&copy; 2024 Petto - Todos os direitos reservados.</span>
            <span class="text-en hidden">&copy; 2024 Petto - All rights reserved.</span>
          </p>
        </div>
      </div>
    </div>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>

</body>
</html>
