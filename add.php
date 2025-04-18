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
<head>
<link rel="stylesheet" href="styles.css">

  <style>
  
h1 {
  color: #333;
}
  .top{
    color: white;
    text-align: center
  }

  .content {
        margin: auto;
        scroll-behavior: smooth;
        margin-left: 40%;

        
  }
  input[type=text] {
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #555;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=text]:focus {
  border: 3px solid #ffb766;
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
  .form-container {
  position: relative;
  height: 600px; /* or whatever height you want */
}

.form-container > div {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;

  
}
    <?php if ($type === 'restaurant'): ?>
          .restaurant {
          /* background-color: #555555; */
          display: block;
        }
          .hours {
          display: none;
        }
        .menu {
          display: none;
        }
        .remove{
          display: none;
        }
    <?php elseif ($type === 'hours'): ?>
          .restaurant {
          display: none;
        }
          .hours {
          /* background-color: #fcd995; */
          display: block;
        }
        .menu {
          display: none;
        }
        .remove{
          display: none;
        }
    <?php elseif ($type === 'menu'): ?>
          .restaurant {
          display: none;
        }
          .hours {
          display: none;
        }
        .menu {
          /* background-color: #555555; */
          display: block;
        }
        .remove{
          display: none;
        }
    <?php elseif ($type === 'remove'): ?>
        .restaurant {
        display: none;
      }
        .hours {
        display: none;
      }
      .menu {
        display: none;
      }
      .remove{
        display: block;
      }
    <?php endif; ?>


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
                <input type="text" name="searchRestaurant" placeholder="Search...">
                <input name="search" type="submit" value="Search">
            </form>
        </div>
    </div> 

<div class="content">
    <!-- PRINT THE RESTAURANT TABLE -->
    <?php
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
    ?>  

    <div class="form-container">

      <div class="restaurant">
          <h1 >Add a restaurant</h1>
          <form action="add.php?type=restaurant" method="post">
          <?php $test = 'restaurant'; ?>
              Restaurant ID: <input  type="text" name="rest_id"><br><br>
              Name: <input type="text" name="name"><br><br>
              City: <input type="text" name="city"><br><br>
              Address: <input type="text" name="address"><br><br>
              Rating: <input type="text" name="rating"><br><br>
              <input class="button" name="submitRest" type="submit" >
          </form>
      </div>

      <div class="hours">
          <h1>Add hours</h1>
          <form action="add.php?type=hours" method="post">
              Restaurant ID: <input type="text" name="rest_id"><br><br>
              Days: 
              <input type="checkbox" id="M" name="days[]" value="M">
              <label for="M"> M</label>
              <input type="checkbox" id="T" name="days[]" value="T">
              <label for="T"> T</label>
              <input type="checkbox" id="W" name="days[]" value="W">
              <label for="W"> W</label>
              <input type="checkbox" id="Th" name="days[]" value="Th">
              <label for="Th"> Th</label>
              <input type="checkbox" id="F" name="days[]" value="F">
              <label for="F"> F</label>
              <input type="checkbox" id="S" name="days[]" value="S">
              <label for="S"> S</label>
              <input type="checkbox" id="Su" name="days[]" value="Su">
              <label for="Su"> S</label><br><br>

              Open for Breakfast: 
              <input type="radio" id="yes" name="openBreak" value="yes">
              <label for="yes">Yes</label>
              <input type="radio" id="no" name="openBreak" value="no">
              <label for="no">No</label><br><br>
                                
              Open for Lunch: 
              <input type="radio" id="yes" name="openLunch" value="yes">
              <label for="yes">Yes</label>
              <input type="radio" id="no" name="openLunch" value="no">
              <label for="no">No</label><br><br>

              Open for Dinner: 
              <input type="radio" id="yes" name="openDinner" value="yes">
              <label for="yes">Yes</label>
              <input type="radio" id="no" name="openDinner" value="no">
              <label for="no">No</label><br><br>


              <input class="button" name="submitHours" type="submit" >
          </form>
      </div>

      <div class="menu">
          <h1>Add a menu</h1>
          <form action="add.php?type=menu" method="post">
              Restaurant ID: <input type="text" name="rest_id"><br><br>
              Cuisine Type: <input type="text" name="cuisineType"><br><br>
              Price range: 
              <input type="radio" id="low" name="priceRange" value="low">
              <label for="yes">Low</label>
              <input type="radio" id="med" name="priceRange" value="med">
              <label for="no">Med</label>
              <input type="radio" id="high" name="priceRange" value="high">
              <label for="no">High</label><br><br>

              Is vegetaian: 
              <input type="radio" id="yes" name="isVegetarian" value="yes">
              <label for="yes">Yes</label>
              <input type="radio" id="no" name="isVegetarian" value="no">
              <label for="no">No</label><br><br>

              Is gluten free: 
              <input type="radio" id="yes" name="isGlutenFree" value="yes">
              <label for="yes">Yes</label>
              <input type="radio" id="no" name="isGlutenFree" value="no">
              <label for="no">No</label><br><br>


              Is vegan: 
              <input type="radio" id="yes" name="isVegan" value="yes">
              <label for="yes">Yes</label>
              <input type="radio" id="no" name="isVegan" value="no">
              <label for="no">No</label><br><br>
              <input class="button" name="submitMenu" type="submit" >
          </form>
      </div>

      <div class="remove">
          <h1>Remove a restaurant</h1>
          <form action="add.php?type=remove" method="post">
              Restaurant ID: <input type="text" name="rest_id"><br>
              Name: <input type="text" name="name"><br>
              <input class="button" name="remove" type="submit" >
          </form>
      
      </div>

    </div>
    
</div>

</body>
</html>

<?php

// ADD RESTAURANT
if (isset($_POST['submitRest'])) 
{
   if ($type === 'restaurant')
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("restaurant");
    $rest_id = escapeshellarg($_POST[rest_id]);
    $name = escapeshellarg($_POST[name]);
    $city = escapeshellarg($_POST[city]);
    $address = escapeshellarg($_POST[address]);
    $rating = escapeshellarg($_POST[rating]);

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' ' .$rest_id . ' ' . $name . ' ' . $city. ' ' . $address. ' ' .$rating;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';
   
    system('chmod 755 odbc_query.exe');

    // Run the command
    $output = system($command, $retVal);
    
    // Display results
    // echo "Return code: $retVal<br>";
    // echo "Output: $output<br>";
}

// ADD HOURS
else if (isset($_POST['submitHours'])) 
{
    # THE RESTAURANT HAS TO ALREADY BE IN THE RESTAURANT TABLE TO ADD ITS HOURS
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("hours");
    $rest_id = escapeshellarg($_POST[rest_id]);
    $days = escapeshellarg($_POST[days]);
    $openBreak = escapeshellarg($_POST[openBreak]);
    $openLunch = escapeshellarg($_POST[openLunch]);
    $openDinner = escapeshellarg($_POST[openDinner]);

    // DAY OPTIONS
    if (!empty($_POST['days'])) {
      $selectedDays = $_POST['days']; // this is an array

      // You can also implode them into a single string if needed
      $daysString = implode(",", $selectedDays);
      // echo "All selected days: $daysString";
      } else {
          echo "No days selected.";
      }

    // DOES IT HAVE BREAKFAST
    if (isset($_POST['openBreak'])) {
        $isBreakfast = $_POST['openBreak'];
        // echo "Breakfast selected: " . htmlspecialchars($isBreakfast);
      } else {
          echo "No breakfast option selected.";
      }

    // DOES IT HAVE LUNCH
    if (isset($_POST['openLunch'])) {
      $isLunch = $_POST['openLunch'];
      // echo "Lunch selected: " . htmlspecialchars($isLunch);
      } else {
          echo "No lunch option selected.";
      }

    // DOES IT HAVE DINNER
    if (isset($_POST['openDinner'])) {
      $isDinner = $_POST['openDinner'];
      // echo "Dinner selected: " . htmlspecialchars($isDinner);
      } else {
          echo "No dinner option selected.";
      }

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' '. $rest_id . ' ' . $daysString . ' ' . $isBreakfast. ' ' . $isLunch. ' ' .$isDinner;
   

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';

    // Run the command
    $output = system($command, $retVal); 
    
    // For debugging 
    // echo "Return code: $retVal<br>";
    // echo "Output: $output<br>";
}

// ADD MENU
else if (isset($_POST['submitMenu'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("menu");
    $rest_id = escapeshellarg($_POST[rest_id]);
    $cuisineType = escapeshellarg($_POST[cuisineType]);
    $priceRange = escapeshellarg($_POST[priceRange]);
    $isVegetarian = escapeshellarg($_POST[isVegetarian]);
    $isGlutenFree = escapeshellarg($_POST[isGlutenFree]);
    $isVegan = escapeshellarg($_POST[isVegan]);

    // VEGAN
    if (isset($_POST['isVegan'])) {
      $isVegan = $_POST['isVegan'];
      // echo "Vegan selected: " . htmlspecialchars($isVegan);
      } else {
          echo "No dinner option selected.";
      }
    // VEGETARIAN
    if (isset($_POST['isVegetarian'])) {
      $isVegetarian = $_POST['isVegetarian'];
      // echo "Vegetarian selected: " . htmlspecialchars($isVegetarian);
      } else {
          echo "No dinner option selected.";
      }
    // GLUTEN FREE
    if (isset($_POST['isGlutenFree'])) {
      $isGlutenFree = $_POST['isGlutenFree'];
      // echo "Gluten free selected: " . htmlspecialchars($isGlutenFree);
      } else {
          echo "No dinner option selected.";
      }
    // PRICE RANGE
    if (isset($_POST['priceRange'])) {
      $priceRange = $_POST['priceRange'];
      // echo "Vegan selected: " . htmlspecialchars($priceRange);
      } else {
          echo "No dinner option selected.";
      }

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' '. $rest_id . ' ' . $cuisineType . ' ' . $priceRange. ' ' .$isVegetarian. ' ' . $isGlutenFree. ' ' . $isVegan;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';

    // Run the command
    $output = system($command, $retVal);

    // For debugging 
    // echo "Return code: $retVal<br>";
    // echo "Output: $output<br>";
}

// REMOVE RESTAURANT
else if (isset($_POST['remove'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("remove");
    $rest_id = escapeshellarg($_POST[rest_id]);
    $name = escapeshellarg($_POST[name]);

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' '. $rest_id . ' ' . $name;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';

    // Run the command
    $output = system($command, $retVal);    

    // For debugging 
    // echo "Return code: $retVal<br>";
    // echo "Output: $output<br>";
}
?>


