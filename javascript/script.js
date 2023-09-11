function addFavoriteRequest() {
  var restaurante = document.getElementById("name_for_fav").innerHTML;
  var but1 = document.getElementById("add_heart");
  var but2 = document.getElementById("remove_heart");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      but1.style.display = "none";
      but2.style.display = "block";
    }
  };
  xmlhttp.open("GET", "/../api/api_add_favorites_res.php?restaurant=" + restaurante, true);
  xmlhttp.send();
}

function removeFavoriteRequest() {
  var restaurante = document.getElementById("name_for_fav").innerHTML;
  var but1 = document.getElementById("remove_heart");
  var but2 = document.getElementById("add_heart");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      but1.style.display = "none";
      but2.style.display = "block";
    }
  };
  xmlhttp.open("GET", "/../api/api_remove_favorites_res.php?restaurant=" + restaurante, true);
  xmlhttp.send();
}

/*function sendSearchRequest(event) {
  sendAjaxRequest('get', '../api/api_restaurants.php?search=' + this.value, {search: this.value}, searchHandler);
  const restaurants = await response.json();
  const section = document.querySelector('#restaurants');
  event.preventDefault();
}

function searchHandler() {
  if (this.status != 200) window.location = '/../pages/restaurant.php';
  let res = JSON.parse(this.responseText);
  window.location = '/../pages/restaurant.php';
}*/


/* --------------------------------------------------------------------------------------------------------------------------------------- */


const searchRestaurant = document.querySelector('.search')
if (searchRestaurant) {
  searchRestaurant.addEventListener('input', async function() {
    const response = await fetch('../api/api_restaurants.php?search=' + this.value)
    const restaurants = await response.json()

    const section = document.querySelector('#restaurants')

    for (const restaurant of restaurants) {
      const divContainer = document.createElement('div')
      const divOverlay = document.createElement('div')
      const img = document.createElement('img')
      img.src = 'https://picsum.photos/200?' + restaurant.id
      const link = document.createElement('a')
      link.href = '../pages/restaurant.php?id=' + restaurant.id
      link.textContent = restaurant.name
      divContainer.appendChild(img)
      divContainer.appendChild(divOverlay)
      divOverlay.appendChild(link)
      section.appendChild(article)
    }
  })
}

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function editProf() {
  var edit_p = document.getElementById("edit");
  var non_edit_p = document.getElementById("non-edit");
  edit_p.style.display = "block";
  non_edit_p.style.display = "none";
}

/*function BackToNonEdit() {
  var edit_p = document.getElementById("edit");
  var non_edit_p = document.getElementById("non-edit");
  edit_p.style.display = "non";
  non_edit_p.style.display = "block";
}*/

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.editbtn')) {
    var dropdowns = document.getElementsByClassName("edit-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

addEventListeners();