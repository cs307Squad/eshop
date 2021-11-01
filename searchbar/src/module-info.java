<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  font-size: 25px;
}

div {
    background-color: white;
    border: 10px blue;
    padding: 20px;
    width: 600px;
}

.default {
    background-color: #E0FFFF;
    color: black;
}

.dark-mode {
  padding: 100px;
  background-color: #070366FF;
  color: black;
}

.fade {
    animation: fadeIn linear 10s;
    -webkit-animation: fadeIn linear 10s;
    -moz-animation: fadeIn linear 10s;
    -o-animation: fadeIn linear 10s;
    -ms-animation: fadeIn linear 10s;
    padding-top: 100px;
    background-color: #FFFF00;
    color: darkgrey;
}

@keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-moz-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-webkit-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-o-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

@-ms-keyframes fadeIn {
  0% {opacity:0;}
  100% {opacity:1;}
}

</style>
</head>
<body>
{% block content %}
<div class="results">
<div1 class="results">
{% if products == [] %}
    <h1>Product(s) not found</h1>
{% else %}
    <div1>
      Choose your theme
      <select id="theme-selector">
        <option value="default">Default</option>
        <option value="dark-mode">Dark mode</option>
        <option value="fade">Fade Mode</option>
      </select>
    </div1>
    <br><br><br>
    <script>
    window.onload = function() {
      let thisTheme = localStorage.getItem("mytheme") || "default";
      setTheme("default", thisTheme);
      const themeSelector = document.getElementById("theme-selector");
      themeSelector.value = thisTheme;
      themeSelector.addEventListener("change", function(e) {
        const newTheme = e.currentTarget.value;
        setTheme(thisTheme, newTheme);
      });

      function setTheme(oldTheme, newTheme) {
        const body = document.getElementsByTagName("body")[0];
        body.classList.remove(oldTheme);
        body.classList.add(newTheme);
        thisTheme = newTheme;
        localStorage.setItem("mytheme", newTheme);
      }
    };
    </script>
    {% for product in products %}
        <div class="result-product">
            <a href="{{ url_for('review',user=usr, product_code=product.Product_Code) }}"><img class="main-image" src={{ product.Image_Url }}></a>
            <div class="result-details">
            <div1 class="result-details">
                <p class="main-name">Name: {{ product.Name }}</p>
                <p class="main-code">Code: {{ product.Product_Code }}</p>
                <p class="main-price">Price: ${{ product.Price }}</p>
                <p class="main-rating">Rating: {{ product.Rating }}</p>
                <p class="main-number">Number of ratings: {{ product.Number_Rating }}</p>
            </div>
            </div1>
        </div>
        <br>
    {% endfor %}
{% endif %}
</div>
</div1>
{% endblock %}
</body>