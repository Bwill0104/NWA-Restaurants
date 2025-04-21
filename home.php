<?php
session_start();
$type = $_GET['type'] ?? '';

if (!isset($_SESSION['reviews'])) {
  $_SESSION['reviews'] = []; // initialize as empty array
}
$reviews = $_SESSION['reviews'];




$servername = "localhost";
$username = "bryanw";
$password = "Chooc8ai";
$database = "bryanw";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<html>

<head>
<link rel="stylesheet" href="styles.css">
<style>

h1{
  color: white
}
.top{
  color: white;
  text-align: center
}
.content {
      margin: auto;
      max-width: 200px;
      scroll-behavior: smooth;

}
.tables {
  max-width: 500px;
  margin: auto;
  padding-bottom: 50px;
  padding-top: 10px;

}
.menu {
  background-color: white;
  color: black;
  border: 2px solid #555555;
}
.menu:hover {
  -webkit-transform: translateY(-6px);
  transform: translateY(-6px);
  background-color: #555555;
  color:   #ffb766;
  ;
}

.form {
  background-color: #555555;
  display: "none";
}
.image-container {
  display: flex;
  gap: 10px; /* optional spacing between images */
  margin-left: 50px;
}

.image-wrapper:hover .overlay{
  opacity: 1;
}

.image-wrapper {
  position: relative;
  width: 256px;
  height: 144px;
}

.image-wrapper img {
  width: 100%;
  height: 100%;
}
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #ffb766;
}

.overlay-text {
  color: #333;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

</style>
</head>
<body>
    <div class="nav-bar">
        <div class="links">
            <a href="home.php?type=tableRest">Restaurant Table</a>
            <a href="home.php?type=tableHours">Hours Table</a>
            <a href="home.php?type=tableMenu">Menu Table</a>
        </div>
        <h1><a href="home.php">NWA Restaraunts</a></h1>

        <div class="search-bar">
            <form action="home.php" method="post">
                <input type="text" name="searchRestaurant" placeholder="Restaurant name...">
                <input name="search" type="submit" value="Search">
            </form>
        </div>
    </div>
    


    <div class="tables" >
      <?php
        // PRINT RESTAURANT TABLE
        if ($type === 'tableRest')
        {
            $sql = "SELECT * FROM Restaurants";
            $result = $conn->query($sql);

            echo "<table border='1'>";
            echo "<tr><th>Restaurant ID</th><th>Name</th><th>City</th><th>Adress</th><th>Rating</th></tr>";  // Customize columns

            if ($result->num_rows > 0) {
                // Output each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["restaurantID"] . "</td>";  // Adjust column names
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";  // Adjust column names
                    echo "<td>" . $row["rating"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No results</td></tr>";
            }
            echo "</table>";

            $conn->close();
        }

        // PRINT HOURS TABLE
        else if ($type === 'tableHours')
        {
            $sql = "SELECT * FROM Hours";
            $result = $conn->query($sql);

            echo "<table border='1'>";
            echo "<tr><th>Restaurant ID</th><th>Day</th><th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>";  // Customize columns

            if ($result->num_rows > 0) {
                // Output each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["restaurantID"] . "</td>";  
                    echo "<td>" . $row["day"] . "</td>";
                    echo "<td>" . $row["openBreak"] . "</td>";
                    echo "<td>" . $row["openLunch"] . "</td>";  
                    echo "<td>" . $row["openDinner"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No results</td></tr>";
            }
            echo "</table>";

            $conn->close();
        }

        // PRINT HOURS TABLE
        else if ($type === 'tableMenu')
        {
          $sql = "SELECT * FROM Menu";
          $result = $conn->query($sql);

          echo "<table border='1'>";
          echo "<tr><th>Restaurant ID</th><th>Cuisine Type</th><th>Price Range</th><th>Vegetarian</th><th>Gluten Free</th><th>Vegan</th></tr>";  

          if ($result->num_rows > 0) {
              // Output each row
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["restaurantID"] . "</td>";  
                  echo "<td>" . $row["cuisineType"] . "</td>";
                  echo "<td>" . $row["priceRange"] . "</td>";
                  echo "<td>" . $row["isVegetarian"] . "</td>";  
                  echo "<td>" . $row["isGlutenFree"] . "</td>";
                  echo "<td>" . $row["isVegan"] . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='3'>No results</td></tr>";
          }
          echo "</table>";

          $conn->close();
        }
      ?>
    </div>

    <?php

      if (isset($_POST['search']) && !empty($_POST[searchRestaurant])) {
        $query = escapeshellarg("searchBar");
        $rawName = $_POST[searchRestaurant];
        $name = escapeshellarg($_POST[searchRestaurant]);

        $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query . ' ' . $name;

        // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';

        $output = shell_exec($command);

        // Debugging
        // echo "Return code: $retVal<br>";

        // DISPLAYS THE RESTAURANTS WITH SEARCH NAME
        echo "<div style='margin-bottom: 30px'; class='table-wrapper'>";
        echo "<table border='1'>";
        echo "$output<br>";
        echo "</table>";
        echo "</div>";
        echo "<style> .menu-box{ display: none} </style>";
        echo "<style> .section{ display: none} </style>";


        // DISPLAYS THE REVIEWS FOR THE SEARCH RESTAURANT IF THERE ARE ANY
        echo '<div style="text-align: center;">';
        echo '<h1 style="color: black;"><u><strong>Restaurant Reviews</strong></u></h1>';
        if (!empty($reviews[$rawName])) {
            foreach ($reviews[$rawName] as $x) {
                echo "<p style='color: black;'>\"$x\"</p>";
            }
        } else {
            echo "<p style='color: gray;'>No reviews yet for <strong>$rawName</strong>.</p>";
        }

        echo '</div>';

      
      }
    ?>


  <div class="content">
    <div class="menu-box">
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=restaurant';"  >Add a restaraunt</button>
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=hours';">Add restaraunt hours</button>
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=menu';">Add a menu</button>
      <button class="button menu" type="button" onclick="window.location.href='review.php';">Add a Review</button>
      <br>
      <button class="button menu" type="button" onclick="window.location.href='find.php?type=hours';">Find Open Restaraunts</button>
      <button class="button menu" type="button" onclick="window.location.href='find.php?type=city';">Find restaraunts by city</button>
      <button class="button menu" type="button" onclick="window.location.href='search.php';">Search For Restaurants</button>
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=remove';" >Remove a restaraunt</button>
    </div>
  </div>


<div class="section" style="margin-top: 50px">
  <div class="col-6">
    <div class="image-container">  
      <div class="row">
        <!-- FAYETTEVILLE BUTTON START-->
        <div class="col-6">
          <form method="post" action="find.php?type=city">
            <input type="hidden" name="city" value="Fayetteville">
            <button type="submit" name="submitCity" style="border: none; background: none; padding: 0; cursor: pointer;">
              <div class="image-wrapper">
                <img src="fayetteville.png" alt="Fayetteville" width="256" height="144">
                <div class="overlay">
                  <div class="overlay-text">Fayetteville</div>
                </div>
              </div>
            </button>
          </form>
        </div>
        <!-- FAYETTEVILLE BUTTON START-->
        <!-- BENTONVILLE BUTTON START-->
        <div class="col-6">
          <form method="post" action="find.php?type=city">
            <input type="hidden" name="city" value="Bentonville">
            <button type="submit" name="submitCity" style="border: none; background: none; padding: 0; cursor: pointer;">
              <div class="image-wrapper">
                <img src="bentonville.jpg" alt="Bentonville" width="256" height="144">
                <div class="overlay">
                  <div class="overlay-text">Bentonville</div>
                </div>
              </div>
            </button>
          </form>
        </div>
        <!-- BENTONVILLE BUTTON END-->
      </div>
      <p style="color: #f1f1f1; ">Created by Jessica McBride and Bryan Williams, our restaurant finder 
        helps you discover the best places to eat across Northwest Arkansas. Whether you're looking for breakfast in Fayetteville, 
        a vegan-friendly spot in Bentonville, or late-night bites in Springdale, we've got you covered. Search, explore, and find 
        your next favorite restaurant—fast and easy.</p>
    </div>

    <div class="image-container">  
      <div class="row">
        <!-- ROGERS BUTTON START -->
        <div class="col-6">
          <form method="post" action="find.php?type=city">
              <input type="hidden" name="city" value="Rogers">
              <button type="submit" name="submitCity" style="border: none; background: none; padding: 0; cursor: pointer;">
                <div class="image-wrapper">
                  <img src="rogers.jpg" alt="Rogers" width="256" height="144">
                  <div class="overlay">
                    <div class="overlay-text">Rogers</div>
                  </div>
                </div>
              </button>
            </form>
        </div>
        <!-- ROGERS BUTTON END -->
        <!-- SPRINGDALE BUTTON BEGIN -->
        <div class="col-6">
          <form method="post" action="find.php?type=city">
            <input type="hidden" name="city" value="Springdale">
            <button type="submit" name="submitCity" style="border: none; background: none; padding: 0; cursor: pointer;">
              <div class="image-wrapper">
                <img src="springdale.jpg" alt="Springdale" width="256" height="144">
                <div class="overlay">
                  <div class="overlay-text">Springdale</div>
                </div>
              </div>
            </button>
          </form>
        </div>
        <!-- SPRINGDALE BUTTON BEGIN -->
      </div>
      <p style="color: #f1f1f1; ">From cozy cafes and family-owned diners to upscale dining and hidden gems, our platform makes it simple to browse local 
        favorites based on hours, cuisine, and location. With real-time updates and an intuitive design, you can spend less 
        time searching and more time enjoying great food. Wherever you are in NWA, let us guide your next delicious adventure.</p>
    <div>
  </div>
<div>

  


</body>

</html>

