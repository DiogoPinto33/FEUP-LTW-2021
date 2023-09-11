<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/restaurant.class.php');
?>

<?php function drawAddMenus(Session $session) { ?>
  <header>
    <div id="pesquisa">
          <input input="search" class="search" type="text" placeholder="Pesquisa..">
    </div>
  </header>
  <section id="restaurants">
        <div id="container">
            <img src="images/originals/<?=$image['id']?>.jpg">
            <div class="overlay">
                <a>Novo Menu</a>
            </div>
        </div>
        <div class="box">
                  <form action="../actions/action_add_menu.php" method="post" class="add_menu" enctype="multipart/form-data">

                    <div class="field">
                          <div class="control">
                              <input name="store_menu" name="store_menu" placeholder="Loja do Menu" autofocus="">
                          </div>
                      </div>
          
                      <div class="field">
                          <div class="control">
                              <input name="name_menu" name="name_menu" placeholder="Nome do Menu" autofocus="">
                          </div>
                      </div>

                      <div class="field">
                          <div class="control">
                              <input name="price" name="price" placeholder="Preço €" autofocus="">
                          </div>
                      </div>

                      <div class="field">
                          <div class="control">
                              <input name="info_menu" name="info_menu" placeholder="Sobre o Menu..." autofocus="">
                          </div>
                      </div>
                      
                      <label>Title:
                        <input type="text" name="title">
                      </label>
                      <input type="file" name="image">
                      

                      <button type="submit" class="novo_menu">Criar Menu</button>
                  
                  </form>
                  
          </div>
  </section>
<?php } ?>

<?php function drawAddOrder(Session $session) { ?>
  <header>
    <div id="pesquisa">
          <input input="search" class="search" type="text" placeholder="Pesquisa..">
          <?php if($session->getRole() == 2) { ?>
            <button id="createRestaurant" onclick="createRestaurantPage()" >Adicionar Restaurante</button>
          <?php } ?>
    </div>
  </header>
  <section id="restaurants">
        <div id="container">
            <img src="images/thumbs_small/<?=$image['id']?>.jpg" width="200" height="200">
            <div class="overlay">
                <a>Novo Restaurante</a>
            </div>
        </div>
        <div class="box">
                  <form action="../actions/action_add_restaurant.php" method="post" class="add_rest" enctype="multipart/form-data">
          
                      <div class="field">
                          <div class="control">
                              <input name="name_res" name="name_res" placeholder="Nome do Restaurante" autofocus="">
                          </div>
                      </div>

                      <div class="field">
                          <div class="control">
                              <input name="address_res" name="address_res" placeholder="Morada" autofocus="">
                          </div>
                      </div>

                      <div class="field">
                          <div class="control">
                              <input name="phone_res" name="phone_res" placeholder="Telefone" autofocus="">
                          </div>
                      </div>

                      <div class="field">
                          <div class="control">
                              <input name="type_res" name="type_res" placeholder="Tipo de Restaurante" autofocus="">
                          </div>
                      </div>

                      
                      <label>Title:
                        <input type="text" name="title">
                      </label>
                      <input type="file" name="image">
                      

                      <button type="submit" class="novo_res">Criar Restaurante</button>
                  
                  </form>
                  
          </div>
  </section>
<?php } ?>