<?php
include('conexao.php');

$message = "";

if (isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        $message = "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) {
        $message = "Preencha sua senha";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
        } else {
            $message = "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
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



  <body>
  <section class="register">
    <form action="" method="POST">
        <p>
            <label>
                <span class="text-pt">E-mail</span>
                <span class="text-en hidden">Email</span>
            </label>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>
                <span class="text-pt">Senha</span>
                <span class="text-en hidden">Password</span>
            </label>
            <input type="password" name="senha" required>
        </p>
        <p>
            <button type="submit">
                <span class="text-pt">logar</span>
                <span class="text-en hidden">login</span>
            </button>
        </p>
        <!-- Display error message below the button -->
        <?php 
            if(isset($_POST['email']) || isset($_POST['senha'])) {
                if(strlen($_POST['email']) == 0) {
                    echo "<p class='message'>Preencha seu e-mail</p>";
                } else if(strlen($_POST['senha']) == 0) {
                    echo "<p class='message'>Preencha sua senha</p>";
                } else if($quantidade == 0) {
                    echo "<p class='message'>Falha ao logar! E-mail ou senha incorretos</p>";
                }
            }
        ?>
    </form>
</section>
</body>



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