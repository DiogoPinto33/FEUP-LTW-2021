<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session, User $user) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Restaurants</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../javascript/script.js" defer></script>
  </head>

  <body>
    <nav id="menu">
        <ul>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">Perfil</button>
                        <div id="myDropdown" class="dropdown-content">

                            <div id="edit" class="edit-content">
                                <form action="../actions/action_edit_profile.php" method="post" class="update_profile">

                                    <div class="field">
                                        <a>Primeiro Nome:</a>
                                        <input id="first_name" type="text" name="first_name" value="<?=$user->firstName?>">
                                    </div>

                                    <div class="field">
                                        <a>Último Nome:</a>
                                        <input id="last_name" type="text" name="last_name" value="<?=$user->lastName?>">  
                                    </div>

                                    <div class="field">
                                        <a>Morada:</a>
                                        <input id="last_name" type="text" name="address" value="<?=$user->address?>"> 
                                    </div> 

                                    <div class="field">
                                        <a>Telefone:</a>
                                        <input id="last_name" type="text" name="phone" value="<?=$user->phone?>">
                                    </div>

                                    <button id="saveEdit" type="submit">Guardar Alterações</button>
                                </form>
                            </div>


                            <div id="non-edit" class="non-edit-content">
                                <button onclick="editProf()" class="editbtn">Editar</button>
                                <a href="#">Primeiro Nome: <?=$session->getFname()?></a>
                                <a href="#">Último Nome: <?=$session->getLname()?></a>
                                <a href="#">Morada: <?=$session->getAddress()?></a>
                                <a href="#">Telefone: <?=$session->getPhone()?></a>
                                <?php if($session->getId() == 1) { ?>
                                    <button onclick="window.location.href='../pages/restaurantes_favoritos.php'" class="restaurantes_favoritos">Restaurantes Favoritos</button>
                                    <button class="menus_favoritos">Menus Favoritos</button>
                                <?php } ?>
                            </div>

                        </div>
                </div>  
            <div class="center">
                    <li class="active"><a href="../pages/restaurant.php">Restaurantes</a></li>
                    <li class="aboutus"><a href="../pages/aboutus.php">Sobre nós</a></li>
                    <li class="contacts"><a href="../pages/contact.php">Contactos</a></li>
            </div>
            <input class="logout" value="Terminar Sessão" type="submit" onclick="window.location='/../actions/logout.php';">
        </ul> 
    </nav>
<?php } ?>

<?php function drawLoginForm() { ?>
    <head>
        <title>LogIn</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
            <div class="box">
                <form action="../actions/login.php" method="post" class="login">
        
                    <div class="field">
                        <div class="control">
                            <input name="username" name="username" placeholder="Nome de utilizador" autofocus="">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input type="password" name="password" placeholder="Palavra-passe">
                        </div>
                    </div>

                    <button type="submit" class="entrar">Iniciar Sessão</button>
                    <hr class="separate">
                </form>
                <input type="submit" value="Criar Conta" class="registar" onclick="window.location='/../pages/signin.php';" />
            </div>
        
    </body>
<?php } ?>

<?php function drawSigninForm() { ?>
    <head>
        <title>SignUp</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    
                        <div class="box_r">
                            <form action="../actions/register.php" method="post" class="regist">

                                <div class="field">
                                    <div class="control">
                                        <input name="email" name="text" class="input is-large" placeholder="Email" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input name="username" name="text" class="input is-large" placeholder="Nome de Utilizador" autofocus="">
                                    </div>
                                </div>

                                <div class="fieldnames">
                                    <div class="first">
                                        <input name="firstname" name="text" class="input is-large" placeholder="Primeiro Nome" autofocus="">
                                    </div>
                                    <div class="last">
                                        <input name="lastname" name="text" class="input is-large" placeholder="Último Nome" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input name="address" name="text" class="input is-large" placeholder="Morada" autofocus="">
                                    </div>
                                </div>

                                <div class="fieldnames">
                                    <div class="control">
                                        <input name="city" name="text" class="input is-large" placeholder="Cidade" autofocus="">
                                    </div>
                                    <div class="control">
                                        <input name="country" name="text" class="input is-large" placeholder="País" autofocus="">
                                    </div>
                                </div>

                                <div class="fieldnames">
                                    <div class="control">
                                        <input name="postalcode" name="text" class="input is-large" placeholder="Código Postal" autofocus="">
                                    </div>
                                    <div class="control">
                                        <input name="phone" name="text" class="input is-large" placeholder="Nº de telemóvel" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input name="password" class="input is-large" type="password" placeholder="Palavra-passe">
                                    </div>
                                </div>

                                <div class="fieldroles">
                                    <input type="radio" id="html" name="role" value="customer" checked>
                                    <label for="html">Cliente</label><br>
                                    <input type="radio" id="html" name="role" value="owner">
                                    <label for="html">Dono de Restaurante</label><br>
                                    <input type="radio" id="html" name="role" value="driver">
                                    <label for="html">Estafeta</label><br>
                                </div>

                                <button type="submit" class="registar">Criar Conta</button>
                                <hr class="separate">
                            </form>
                            <input type="submit" value="Iniciar Sessão" class="entrar" onclick="window.location='/../pages/index.php';" />
                        </div>
    </body>
<?php } ?>