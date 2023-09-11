<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/restaurant.class.php');
?>

<?php function drawRestaurants(PDO $db, Session $session, array $restaurants) { ?>
  <header>
    <div id="pesquisa">
          <input input="search" class="search" type="text" placeholder="Pesquisa..">
          <?php if($session->getRole() == 2) { ?>
            <button id="createRestaurant" onclick="window.location='/../pages/add_restaurant.php';" >Adicionar Restaurante</button>
          <?php } ?>
    </div>
  </header>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { 
      $stmt = $db->prepare("SELECT * FROM FOOD_COMPANY_IMAGES WHERE FoodCompId = ?");
      $stmt->execute(array($restaurant->id));
      $images = $stmt->fetchAll();?>
        <div id="container">
            <?php foreach($images as $image) { ?>
              <img src="../actions/images/originals/<?=$image['ImageId']?>.jpg">
            <?php } ?>
            <div class="overlay" id="overlay">
                <a id="restaurant_name" href="../pages/menus.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
            </div>
        </div>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(PDO $db, Session $session, Restaurant $restaurant, array $menus) { ?>
  <header>
    <div id="pesquisa_r">
        <input class="search" type="text" placeholder="Pesquisa..">
        <h2 class="MenuRestaurantTitle" id="name_for_fav" ><?=$restaurant->name?></h2>
        <?php if($session->getRole() == 2) { ?>
            <div id="butto">
                <button id="createMenu" onclick="window.location='/../pages/add_menu.php';" >Adicionar Menu</button>
                <button id="editRest" onclick="window.location='/../pages/edit_rest.php';" >Editar Restaurante</button>
            </div>
        <?php } ?>
        <?php if($session->getRole() == 1) { ?>
          <?php 
            $ya = $db->prepare("SELECT FavRestId FROM FAVORITES_RESTAURANT WHERE CustomerId = ? AND RestaurantId = ?");
            $ya->execute(array($session->getId(), $restaurant->id));
            $disable = $ya->fetchAll(); 
            if(!$disable) {?>
              <button id="add_heart" onclick="addFavoriteRequest()">Adicionar aos favoritos</button>
            <?php } else {?>
              <button id="remove_heart" onclick="removeFavoriteRequest()">Remover dos favoritos</button>
          <?php }?>
        <?php } ?>
    </div>
  </header>
  <section id="menus">
    <?php foreach($menus as $menu) { 
        $stmt = $db->prepare("SELECT * FROM MENU_IMAGES WHERE MenuId = ?");
        $stmt->execute(array($menu->id));
        $images = $stmt->fetchAll();?>
          <div id="container">
              <?php foreach($images as $image) { ?>
                <img src="../actions/images/menus/<?=$image['ImageId']?>.jpg">
              <?php } ?>
              <div class="overlay" id="overlay">
                  <a id="menu_name" href="../pages/menu.php?id=<?=$menu->id?>"><?=$menu->name?><br>Preço: <?=$menu->cost?></a>
              </div>
          </div>
      <?php } ?>
  </section>
<?php } ?>

<?php function drawAddRestaurant(Session $session) { ?>
  <header>
    <div id="pesquisa">
          <input input="search" class="search" type="text" placeholder="Pesquisa..">
    </div>
  </header>
  <section id="restaurants">
        <div id="container">
            <img src="images/originals/<?=$image['id']?>.jpg">
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

