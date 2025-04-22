<?php
$type = $_GET['type'] ?? '';
?>
<html>

<head>
<link rel="stylesheet" href="styles.css">
  <style>
 
h1{
  color:  #333;
}
.content {
  margin: auto;
  max-width: 200px;
  scroll-behavior: smooth;
}

  <?php if ($type === 'city'): ?>
          .city {
          display: block;
        }
          .rating {
          display: none;
        }
        .hours {
          display: none;
        }
        
    <?php elseif ($type === 'rating'): ?>
          .city {
          display: none;
        }
          .rating {
          display: block;
        }
        .hours {
          display: none;
        }

    <?php elseif ($type === 'hours'): ?>
          .city {
          display: none;
        }
          .rating {
          display: none;
        }
        .hours {
          display: block;
        }
       
    
    <?php endif; ?>

    #timeInput {
      display: none;
      margin-top: 10px;
    }


</style>
    </head>

<body>
<div class="nav-bar" style="margin-bottom: 0px;z-index: 2;">
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
    <div class="section-with-background">
      <img src="imgs/nwa-find.jpg" alt="Northwest Arkansas" width="100%" height="70%"/>
      <div class="text-block">
        <h1 >Find Restaurants</h1>
        <p>Discover restaurants wherever you are, whenever you need them</p>
      </div>
    </div> 
<?php

// FIND BY CITY
if (isset($_POST['submitCity'])) 
{
    $query = escapeshellarg("city");
    $city = escapeshellarg($_POST[city]);

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' ' .$city;


    // Run the command
    $output = shell_exec($command);
    
    // Display results
    echo "<div class='table-wrapper'>";
    echo "<table border='1'>";
    echo "$output<br>";
    echo "</table>";
    echo "<button class='button bac' type='button' onclick=\"window.location.href='find.php?type=city';\">Back</button>";
    echo "</div>";
    echo "<style> .content{ display: none} </style>";
}

if (isset($_POST['submitTime']) || isset($_POST['current'])) 
{
    $query = escapeshellarg("time");
    $enteredTime = escapeshellarg($_POST[manualTime]);
    $currentTime = date("h:i A");
    if (!empty($_POST['hours'])) {
      $selectedHour = $_POST['hours']; // this is an array

      $hourString = implode(",", $selectedHour);
      } 
      

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' ' .$enteredTime. ' '.$hourString. ' ' .$currentTime;


    // Run the command
    $output = shell_exec($command);
    
    // Display results
    echo "<div class='table-wrapper'>";
    echo "<table border='1'>";
    echo "$output<br>";
    echo "</table>";
    echo "<button class='button bac' type='button' onclick=\"window.location.href='find.php?type=hours';\">Back</button>";
    echo "</div>";
    echo "<style> .content{ display: none} </style>";
    
}

?>

    <div class="content">
      <div class="city">
          <h1>Find Restaraunts by city</h1>

          <form action="find.php?type=city" method="post">
          <?php $test = 'restaurant'; ?>
              Enter city: <input type="text" name="city"><br><br>
              <input class="button" name="submitCity" type="submit" >
          </form>
      </div>
      <div class="hours">
          <h1>Find Open Restaraunts</h1>
          <form action="find.php?type=hours" method="post">

          <!-- USER ENTERS TIME -->
          <div id="timeInput">
          <label for="manualTime">Enter time (hh:mm):</label>
          <input type="text" id="manualTime" name="manualTime"><br>
          <input type="checkbox" id="AM" name="hours[]" value="AM">
          <label for="AM">AM</label>
          <input type="checkbox" id="PM" name="hours[]" value="PM">
          <label for="PM">PM</label><br>
          <input name="submitTime" type="submit" >
          </div>
          <?php $test = 'hours'; ?>
            <div id="hoursButtons" >
              <input class="button" type="submit" name="current" value="Use current time">
              <input class="button" type="submit" name="enter" value="Enter a time" onclick="showInputBox(event)">
              </div>  
          </form>
      </div>
    </div>

    <div style="padding-bottom: 300px">
    </div>

</body>

<script>
  function showInputBox(event) {
    event.preventDefault(); // prevent form submission if inside a form
    document.getElementById('timeInput').style.display = 'block';
    document.getElementById('hoursButtons').style.display = 'none';

  }
</script>

</html>

