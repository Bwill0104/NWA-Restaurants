<?php
$type = $_GET['type'] ?? '';
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
<style>
   
h1{
  color: white
}
.top{
  color: white;
  text-align: center
}
.nav-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 10px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.nav-bar a {
    color: white;
    text-decoration: none;
    margin-right: 20px;
    font-weight: bold;
}

.nav-bar a:hover {
    text-decoration: underline;
}

.search-bar input[type="text"] {
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 200px;
}

.search-bar input[type="submit"] {
    padding: 5px 12px;
    border-radius: 5px;
    background-color: #555;
    color: white;
    border: none;
    cursor: pointer;
}

.search-bar input[type="submit"]:hover {
    background-color: #777;
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


.button {
  background-color: #555555; /* Green */
  border: none;
  color: white;
  padding: 8px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.menu {
  background-color: white;
  color: black;
  border: 2px solid #555555;
}

.menu:hover {
  background-color: #555555;
  color: white;
}

.form {
  background-color: #555555;
  display: "none";
}
.table-wrapper {
  display: flex;
  justify-content: center;
  align-items: start; /* align to top */
  padding-top: 20px;
  position: relative; /* not absolute */
  height: auto;
}
</style>
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
                <input type="text" name="searchRestaurant" placeholder="Search...">
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
        echo "<tr><th>Restaurant ID</th><th>Cuisine Type</th><th>Price Range</th><th>Vegetarian</th><th>Gluten Free</th><th>Vegan</th></tr>";  // Customize columns

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
  $name = escapeshellarg($_POST[searchRestaurant]);

  $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_insert_item.exe ' . $query . ' ' . $name;

  // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';

  $output = shell_exec($command);

  // Debugging
  // echo "Return code: $retVal<br>";
  echo "<div style='margin-bottom: 30px'; class='table-wrapper'>";
  echo "<table border='1'>";
  echo "$output<br>";
  echo "</table>";
  echo "</div>";
  echo "<style> .menu-box{ display: none} </style>";

 
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
<br><br>
    
    </div>
    <br><br>
</body>

</html>

