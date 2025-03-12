<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['id'];
    $vacina_nome = $mysqli->real_escape_string($_POST['vacina_nome']);
    $data_aplicacao = $mysqli->real_escape_string($_POST['data_aplicacao']);
    $proxima_dose = !empty($_POST['proxima_dose']) ? $mysqli->real_escape_string($_POST['proxima_dose']) : null;

    // Inserir a vacina na tabela
    $sql_insert = "INSERT INTO carteira_vacinacao (usuario_id, vacina_nome, data_aplicacao, proxima_dose)
                   VALUES ($usuario_id, '$vacina_nome', '$data_aplicacao', " . ($proxima_dose ? "'$proxima_dose'" : "NULL") . ")";

    if ($mysqli->query($sql_insert)) {
        $message = "Vacina adicionada com sucesso!";
    } else {
        $message = "Erro ao adicionar vacina: " . $mysqli->error;
    }
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteira Digital de Vacinação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Menu de Navegação -->
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



<div class="col-md-4 mb-4">
    <div class="container mt-6">
        <h1>Adicionar Vacina</h1>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="vacina_nome" class="form-label">Nome da Vacina</label>
                <input type="text" class="form-control" id="vacina_nome" name="vacina_nome" required>
            </div>
            <div class="mb-3">
                <label for="data_aplicacao" class="form-label">Data de Aplicação</label>
                <input type="date" class="form-control" id="data_aplicacao" name="data_aplicacao" required>
            </div>
            <div class="mb-3">
                <label for="proxima_dose" class="form-label">Próxima Dose</label>
                <input type="date" class="form-control" id="proxima_dose" name="proxima_dose">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
</div>



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
