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
            <a class="nav-link" href="adicionar_vacina.php"><i class="fas fa-user-plus"></i> 
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

    <div class="container mt-5">
        <h1>Adicionar Vacina</h1>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form action="adicionar_vacina.php" method="POST">
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
</body>
</html>
