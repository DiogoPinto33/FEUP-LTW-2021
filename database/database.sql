
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- ---------------------------------   DATABASE   -----------------------------------
DROP TABLE IF EXISTS USERS; 
DROP TABLE IF EXISTS ROLE;
DROP TABLE IF EXISTS FOOD_COMPANY;
DROP TABLE IF EXISTS MENU;
DROP TABLE IF EXISTS PRODUCT;

--DROP DATABASE IF EXISTS `RESTAURANT`;
--CREATE DATABASE `RESTAURANT`;
--USE `RESTAURANT`; 

-- ----------------------------------     ROLE    -----------------------------------

CREATE TABLE ROLE (
    id INTEGER PRIMARY KEY,
	description VARCHAR(30)
);

INSERT INTO
    ROLE
VALUES
    (1, 'customer'),
    (2, 'owner'),
    (3, 'driver')
;

-- ----------------------------------     USERS    -----------------------------------
-- Edit their profile (at least username, password, address, and phone number)

/*DROP TABLE IF EXISTS USERS;
CREATE TABLE USERS (
  username VARCHAR(30) PRIMARY KEY,
  role INTEGER DEFAULT 1,
  password VARCHAR(100),
  address VARCHAR(30),
  phone INTEGER,

  FOREIGN KEY (role) REFERENCES ROLE(id)
);*/

CREATE TABLE USERS
(
    UserId INTEGER NOT NULL,
    FirstName VARCHAR(40)  NOT NULL,
    LastName VARCHAR(20)  NOT NULL,
    username VARCHAR(30),
    role INTEGER DEFAULT 1,
    Address VARCHAR(70),
    City VARCHAR(40),
    Country VARCHAR(40),
    PostalCode VARCHAR(10),
    Phone VARCHAR(9),
    Email VARCHAR(60) NOT NULL,
    password TEXT NOT NULL,

    FOREIGN KEY (role) REFERENCES ROLE(id),
    PRIMARY KEY  (UserId)
);


-- ----------------------------------     FOOD_COMPANY    -----------------------------------

CREATE TABLE FOOD_COMPANY (
    RestaurantId INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    address VARCHAR(70),
    phone INTEGER,
    information VARCHAR(30),
    owner INTEGER NOT NULL,

    FOREIGN KEY (owner) REFERENCES USERS(UserId),
    PRIMARY KEY (RestaurantId)
);

INSERT INTO
    FOOD_COMPANY
VALUES
    (1, 'McDonalds', 'Largo do Moinho de Vento', 966666661, 'Hamburguers', 2),
    (2, 'Pizza Hut', 'Praça das Flores', 966666662, 'Pizza', 2),
    (3, 'H3', 'Praça da Galiza', 966666663, 'hamburguers', 2),
    (4, 'Vitaminas', 'Largo do Anjo', 966666664, 'Saudável', 3),
    (5, 'Zé dos Leitões', 'Parque de São Bartolomeu', 966666665, 'Leitão', 3),
    (6, 'Italian Republic', 'Praça de Almeida Garrett', 966666666, 'massas/pizzas', 3),
    (7, 'Amorino', 'Praceta de João Augusto Ribeiro', 966666667, 'Gelados', 3),
    (8, 'Starbucks', 'Rotunda do Ribeirinho', 966666668, 'Bebidas', 4),
    (9, '100 montaditos', 'Rua Adolfo Casais Monteiro', 966666669, 'Snacks', 4),
    (10, 'Tokio yan', 'Rua Albertina de Sousa Paraíso', 966666610, 'chinês', 4)
;


-- ----------------------------------     MENU    -----------------------------------
-- Add a list of dishes, their names, prices, photos and categories.
CREATE TABLE MENU (
    MenuId INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    store INTEGER,
    cost FLOAT,
    information VARCHAR(200),

  FOREIGN KEY (store) REFERENCES FOOD_COMPANY(RestaurantId),
  PRIMARY KEY (MenuId)
);

INSERT INTO
    MENU
VALUES
    ('McRoyal Deluxe', 1, 6.25, 'Coroado com sementes de sésamo, o McRoyal Deluxe tem todos os ingredientes para uma dentada luxuosa: carne 100% de vaca, rodelas de tomate, queijo Cheddar fundido e maionese aveludada'),
    (2, 'Big Mac', 1, 6.25, 'A sanduíche dupla mais cobiçada no mundo inteiro. Feita com dois suculentos hambúrgueres 100% carne de vaca, queijo fundido, pepino, cebola, alface e um molho irresistível. Uma combinação única'),
    (3, 'Big Tasty', 1, 6.25, 'Descubra o novo Big Tasty® Single e o seu novo pão com queijo e bacon'),
    (4, 'McChicken', 1, 6.25, 'Filete de frango com uma camada de alface e maionese, emoldurado por dois pedaços de pão. Uma sanduíche multi-sensações que nunca passa de moda'),
    (5, 'CBO', 1, 6.25, 'Era uma vez um tenro panado de frango que encontrou uma cebola estaladiça. E um pão macio que conheceu um bacon crocante. No CBO os melhores ingredientes combinam-se numa dança ora tenra, ora estaladiça. Ora macia, ora crocante. Deliciosamente juntos para proporcionar momentos de prazer.'),
    (6, 'McVeggie', 1, 6.25, 'Um hambúrguer à base de vegetais e quinoa combinado com tomate, alface e um delicioso molho de alho e coentros. Contém leite e ovo.'),
    (7, 'Filet-o-Fish', 1, 6.25, 'Delicioso filete de peixe envolto por uma textura crocante, combinado com queijo e uma dose generosa de molho tártaro. Um tesouro do fundo do mar, que é uma forma muito saborosa de comer peixe.'),
    (8, 'McRoyal Bacon', 1, 6.25, 'A sanduíche que desafia os gostos mais ousados com um hambúrguer Royal 100% carne de vaca grelhada, tiras de bacon crocante, e o especialíssimo molho McBacon™. Uma referência para os amantes do bacon.'),
    (9, 'Double Cheeseburger', 1, 6.25, 'Melhor que um hambúrguer 100% carne de vaca, só dois hambúrgueres 100% carne de vaca. E melhor que uma fatia de queijo derretido, só duas fatias de queijo derretido em cima de dois hambúrgueres 100% carne de vaca. Genuinamente: é do melhor.'),
    
    (10, 'Margarita', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella e Orégãos.'),
    (11, 'cheeseham', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella, Orégãos, Fiambre e Mozzarella Extra'),
    (12, 'PMargarita Vegan', 2, 12.75, 'Molho de Tomate, Queijo Vegan e Orégãos.'),
    (13, 'Serrano', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella, Orégãos, Chouriço, Cogumelos Frescos e Azeitonas.'),
    (14, 'Veggie Lovers', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella, Orégãos, Mistura de Vegetais, Milho, Tomate e Azeitonas.'),
    (15, 'Summer', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella, Orégãos, Chouriço, Ananás e Cebola Crocante.'),
    (16, 'Camponesa', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella, Orégãos, Fiambre, Cogumelos Frescos e Tomate.'),
    (17, 'Havainana', 2, 12.75, 'Molho de Tomate, Queijo 100% Mozzarella, Orégãos, Atum, Camarão e Ananás.'),
    (18, 'Barbecue', 2, 12.75, 'Molho Barbecue, Queijo 100% Mozzarella, Orégãos, Bacon, Carne de Vaca e Cebola.'),
    
    (19, 'H3 grelhado', 3, 8.50,'Um hambúrguer de 200 gramas de pura carne, grelhado no ponto escolhido e servido num prato aquecido.'),
    (20, 'H3 com molho', 3, 8.50, 'O primeiro é que usamos produtos frescos para o fazer e o segundo não revelamos porque faz parte, neste tipo de molhos, haver um segredo.'),
    (21, 'H3 champignon', 3, 8.50, 'Não gostamos de cogumelos em lata. E isto basta para que este molho seja feito apenas com cogumelos frescos.'),
    (22, 'H3 tuga', 3, 8.50, 'O molho leva cerveja, alho e louro e o ovo é a cavalo. Nas tabernas era servido num prato de barro. Aqui é servido num prato de porcelana aquecido. Só isso mudou.'),
    (23, 'H3 mediterrâneo', 3, 8.50, 'Rúcula, tomate seco, lascas de parmesão e molho de azeite virgem extra e limão. E é isto.'),
    (24, 'H3 carbonara', 3, 8.50, 'A receita original junta três sabores marcantes: ovo, bacon ou pancetta e parmesão. Nós mantivemos a alma do prato e tornámos o ovo mais evidente. E claro, por baixo está um hambúrguer grelhado com todo o cuidado.'),
    (25, 'H3 cheese', 3, 8.50, 'O hambúrguer é coberto com fondue de queijo cheddar e servido com cebola salteada, ketchup e maionese de mostarda antiga, que lhe dá um toque de Velho Mundo.'),
    (26, 'H3 benedict', 3, 8.50, 'Da receita do benedict mantivémos o ovo escalfado e o molho holandês. Acrescentámos um hambúrguer de 200 gramas de pura carne. Os puristas dizem que deveria ser chamado à Fiorentina, pois leva espinafres.'),
    (27, 'H3 french', 3, 8.50, 'Com foie gras fresco, cebola confitada e redução de vinho do Porto. Apesar de demorar um bocadinho mais do que os outros a ser servido não deixa de ser fast food.'),
    
    (28, 'Salada de frango e ananás', 4, 7.50,  'Frango, Ananás, Queijo, Milho e Tomate'),
    (29, 'Slada de frango e frutas', 4, 7.50, 'frango, morango, manga, banana e azeitonas'),
    (30, 'Salada de salmão e camarão', 4, 7.50, 'Salmão, camarão , azeitonas, pepino e Tomate'),
    (31, 'Salada de atum', 4, 'FALTA22', 7.50, 'Atum, Ovo, Tomate, Cenoura e Azeitonas'),
    (32, 'Sandes de mozzarella e pesto', 4, 7.50, 'Rúcula, Tomate, Queijo mozzarella e molho pesto'),
    (33, 'Sandes de requeijão', 4, 7.50, 'Alface, Tomate e Requeijão'),
    (34, 'Sandes de frango', 4, 7.50, 'Alface, Tomate, Frango fatiado ou Pasta de frango'),
    (35, 'Sandes de salmão e queijo fresco', 4, 7.50, 'Alface, Tomate, salmão e Queijo Fresco'),
    (36, 'Sandes de delicias do mar', 4, 7.50, 'Alface , Tomate, Ovo, Delicias ou Pasta de delicias'),
    
    (37, 'Leitão inteiro', 5, 99, 'Leitão à bairrada'),
    (38, 'Sandes de leitão', 5, 7, 'Pão de rio maior com leitão assado'),
    (39, 'Sandes de leitão com queijo', 5, 8, 'Pão de rio maior com leitão assado e queijo da serra'),
    (40, 'Francesinha de leitão', 5, 12, 'Francesinha tradicional feito à base de leitão'),
    (41, 'Frango com molho de leitão', 5, 7, 'Frango do campo com molho de leitão'),
    (42, 'Cabrito no forno', 5, 15, 'Cabrito no forno com batata assada e salada'),
    (43, 'Posta à Zé', 5, 14, 'Bife da vazia, acompanhado com arroz branco e batata frita'),
    (44, 'Bacalhau com broa', 5, 20, 'Bacalhau com broa, batata a murro e grelos'),
    (45, 'Bacalhau à Porto', 5, 20, 'Bacalhau grelhado, batata frita e azeitonas'),

    (46, 'Lasanha', 6, 9, 'Camadas de massa com carne, tomate e mozzarella gratinada no forno.'),
    (47, 'Cannellones', 6,  9, 'Rolos massa recheada com carne, cogumelos, espinafres e mozzarella gratinados no forno.'),
    (48, 'Linguine Pescatore', 6,  9, 'Massa linguine em molho tomate picante com mexilhão, amêijoa, lulas e camarão salteados em azeite e alho e tomate cereja.'),
    (49, 'Spaghetti alla bolognese', 6,  9, 'Spaghetti com carne picada e molho tomate.'),
    (50, 'Penne al salmone', 6,  9, 'Massa penne envolta em delicioso molho, com tirinhas de salmão fumado, alho francês e alcaparras.'),
    (51, 'Mediterrânea', 6,  9, 'Molho tomate, queijo mozzarella, pimentos, salame picante, cebola roxa, queijo feta e orégãos.'),
    (52, 'Neptuno', 6,  9, 'Tomate, basílico, queijo mozzarella, atum e rodelas de cebola.'),
    (53, 'Calzone', 6,  9, 'Pizza enrolada com tomate, basílico, queijo mozzarella, fiambre, salame italiano, chouriço picante e azeitonas.'),
    (54, 'Italian republic', 6,  9, 'Tomate, basílico, queijo mozzarella de búfala e chouriço picante.'),

    (55, 'Mascarpone e figos', 7, 5, 'O gelado de mascarpone e figos convida a Primavera a chegar, bem como os belos dias cheios de sol! Criámos um gelado único que fará as delícias de todos, especialmente de quem aprecia uma verdadeira sobremesa italiana.'),
    (56, 'Citrinos e verbena', 7, 5, 'Há imensas razões para que possa vir e desfrutar do nosso novo sorvete de citrinos. Podemos começar pelo regresso dos longos dias de sol, que nos faz pedir por uma boa dose de frescura e leveza!'),
    (57, 'Pisctachio mawardi', 7, 5, 'Proveniente do Médio Oriente, onde o cultivo de pistáchio é conhecido há milhares de anos, o seu sabor é ligeiramente intenso'),
    (58, 'Baunilha (Bourbon de Madagáscar)', 7, 5, 'Cada colher de gelado desperta-nos um extraordinário aroma floral e ligeiramente amadeirado! Através de uma confeção minuciosa, cortamos longitudinalmente as vagens negras de baunilha, para podermos recolher as suas pequenas e preciosas sementes!'),
    (59, 'Inimitável', 7, 5, 'O autêntico creme de barrar de chocolate e avelãs! Para os apreciadores desta delícia, nada como a inigualável combinação entre cacau e avelã.'),
    (60, 'Manga (Afonso da Índia)', 7, 5, 'Este fruto muito apreciado na Índia há milénios, chega a ser mencionado nas antigas escrituras hindus e nas crónicas budistas chinesas. Uma das mais apreciadas é a Manga Afonso de Goa. '),
    (61, 'Macaron de framboesa', 7, 5, 'Os nossos macarrons recheados com gelado têm a particularidade de serem produzidos no nosso laboratório perto de Paris. Preparados e recheados à mão com os melhores gelados e sorvetes feitos pelos nossos criadores!'),
    (62, 'Macaron de chocolate amorino', 7, 5, 'Os nossos macarrons recheados com gelado têm a particularidade de serem produzidos no nosso laboratório perto de Paris. Preparados e recheados à mão com os melhores gelados e sorvetes feitos pelos nossos criadores!'),
    (63, 'Macaron de café', 7, 5, 'Os nossos macarrons recheados com gelado têm a particularidade de serem produzidos no nosso laboratório, perto de Paris. Preparados e recheados à mão com os melhores gelados e sorvetes feitos pelos nossos criadores!'),

    (64, 'Latte', 8, 4, 'O nosso espresso 100% arábica com leite e uma fantástica camada de espuma cremosa.'),
    (65, 'Cappuccino Freddo', 8, 4, 'Intenso espresso gelado ligeramente doce e finalizado com um suave e cremoso creme de leite elaborado com leite magro.'),
    (66, 'Cold Brew', 8, 4, 'Café gelado elaborado manualmente de forma artesanal. * Poderá não estar sempre disponível.'),
    (67, 'Caramel Machiatto', 8, 4, 'Combinação de leite cremoso, baunilha e o nosso espresso 100% arábica, decorado com uma grelha de caramelo.'),
    (68, 'Mocha', 8, 4, 'Intenso espresso com chocolate e leite cremoso.'),
    (69, 'Vitality ', 8, 4, 'Sumo natural com fruta e vegetais. Melão, uva, morango, mirtilo e arando.'),
    (70, 'Tropical', 8, 4, 'Sumo natural com fruta e vegetais. Manga, abacaxi e kiwi.'),
    (71, 'Chai Tea Latte', 8, 4, 'Doce combinação de chá preto com especiarias e leite cremoso.'),
    (72, 'Teavana® Hibiscus Tea Lemonade', 8, 4, 'Infusão de hibiscus frio com  limonada. Agitado no shaker e servido com gelo.'),
    
    (73, 'Presunto gran reserva e azeite virgem extra.', 9, 2.50, '-'),
    (74, 'Queijo ibérico e azeite virgem extra', 9, 2.50, '-'),
    (75, 'Queijo de cabra e pesto', 9, 2.50, '-'),
    (76, 'Creme de queijo, tomate e guacamole', 9, 2.50, '-'),
    (77, 'Lombo ao alho e maionese', 9, 2.50, '-'),
    (78, 'Frango e molho alioli', 9, 2.50, '-'),
    (79, 'Frango kebab e molho BBQ', 9, 2.50, '-'),
    (80, 'Bacon fumado e queijo ibérico', 9,2.50, '-'),
    (81, 'Panadinhos de frango e molho de mostarda e mel', 9, 2.50, '-'),

    (82, 'Chop-Suey de porco', 10, 9, '-'),
    (83, 'Chop-Suey de vaca', 10, 9,'-'),
    (84, 'Carne de galinha com amêndoas', 10, 9, '-'),
    (85, 'Lulas com bambu', 10, 9, '-'),
    (86, 'Peixe agridoce', 10, 9, '-'),
    (87, 'Omeleta com San-Shein', 10, 9, '-'),
    (88, 'Pato com ananás', 10, 9, '-'),
    (89, 'Chop-Suey de camarão', 10, 9, '-'),
    (90, 'Camarão no cesto', 10, 9, '-')
;

-- ----------------------------------     ORDERS    -----------------------------------
CREATE TABLE ORDERS (
    OrderId INTEGER NOT NULL,
    CustomerId INTEGER,
    MenuId INTEGER,
    State VARCHAR(30),

    FOREIGN KEY (MenuId) REFERENCES MENU(MenuId),
    FOREIGN KEY (CustomerId) REFERENCES USERS(UserId),
    PRIMARY KEY (OrderId)
);

-- ----------------------------------     REVIEWS    -----------------------------------
CREATE TABLE REVIEWS (
    ReviewId INTEGER NOT NULL,
    CustomerId INTEGER,
    Score INTEGER,
    Information VARCHAR(30),

    FOREIGN KEY (CustomerId) REFERENCES USERS(UserId),
    FOREIGN KEY (RestaurantId) REFERENCES FODD_COMPANY(RestaurantId),
    PRIMARY KEY (OrderId)
);

-- ----------------------------------     FAVORITES MENUS    -----------------------------------
CREATE TABLE FAVORITES_MENUS (
    FavMenuId INTEGER NOT NULL,
    CustomerId INTEGER,

    FOREIGN KEY (CustomerId) REFERENCES USERS(UserId),
    FOREIGN KEY (MenuId) REFERENCES MENU(MenuId),
    PRIMARY KEY (FavMenuId)
);

-- ----------------------------------     FAVORITES  RESTAURANTS  -----------------------------------
CREATE TABLE FAVORITES_RESTAURANT (
    FavRestId INTEGER NOT NULL,
    CustomerId INTEGER,
    RestaurantId INTEGER,

    FOREIGN KEY (CustomerId) REFERENCES USERS(UserId),
    FOREIGN KEY (RestaurantId) REFERENCES FODD_COMPANY(RestaurantId),
    PRIMARY KEY (FavRestId)
);

-- ----------------------------------     FOOD_COMPANY_IMAGES    -----------------------------------
CREATE TABLE FOOD_COMPANY_IMAGES (
    ImageId INTEGER NOT NULL,
    Title VARCHAR NOT NULL,
    FoodCompId INTEGER,

    FOREIGN KEY (FoodCompId) REFERENCES FOOD_COMPANY(FoodCompId),
    PRIMARY KEY (ImageId)
);

-- ----------------------------------     MENU_IMAGES    -----------------------------------
CREATE TABLE MENU_IMAGES (
    ImageId INTEGER NOT NULL,
    Title VARCHAR NOT NULL,
    MenuId INTEGER,

    FOREIGN KEY (MenuId) REFERENCES MENU(MenuId),
    PRIMARY KEY (ImageId)
);

