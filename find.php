<?php
$type = $_GET['type'] ?? '';
?>
<html>

<head>
  <style>
    body {
        background-color: #ffb766;
        /* background-image: url('restaraunt.jpg'); */
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
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
.content {
      margin: auto;
      max-width: 200px;
      scroll-behavior: smooth;
  }
  <?php if ($type === 'city'): ?>
          .city {
          /* background-color: #555555; */
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
    .table-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* fills the full screen height */
}

</style>
    </head>

<body>

    <div class="content">


        <div class="city">
            <h1>Find Restaraunts by city</h1>

            <form action="find.php?type=city" method="post">
            <?php $test = 'restaurant'; ?>
                Enter city: <input type="text" name="city"><br><br>
                <input name="submitCity" type="submit" >
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
                <input type="submit" name="current" value="Use current time">
                <input type="submit" name="enter" value="Enter a time" onclick="showInputBox(event)">
               </div>  
            </form>
        </div>

        <button class="button back" type="button" onclick="window.location.href='home.php';" >Back</button>
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

<?php

// FIND BY CITY
if (isset($_POST['submitCity'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("city");
    $city = escapeshellarg($_POST[city]);

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_insert_item.exe ' . $query. ' ' .$city;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';
    system('chmod o+x odbc_insert_item.exe');
    system('chmod 755 odbc_insert_item.exe');

    // Run the command
    $output = shell_exec($command);
    
    // Display results
    // echo "Return code: $retVal<br>";
    echo "<div class='table-wrapper'>";
    echo "<table border='1'>";
    echo "$output<br>";
    echo "</table>";
    echo "</div>";
}

// FIND BY RATING
if (isset($_POST['submitRating'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("rating");
    $rating = escapeshellarg($_POST[rating]);

    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_insert_item.exe ' . $query. ' ' .$rating;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';
    system('chmod o+x odbc_insert_item.exe');
    system('chmod 755 odbc_insert_item.exe');

    // Run the command
    $output = shell_exec($command);
    
    // Display results
    // echo "Return code: $retVal<br>";
    echo "<div class='table-wrapper'>";
    echo "<table border='1'>";
    echo "$output<br>";
    echo "</table>";
    echo "</div>";
}

if (isset($_POST['submitTime']) || isset($_POST['current'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("time");
    $enteredTime = escapeshellarg($_POST[manualTime]);
    $currentTime = date("h:i A");
    if (!empty($_POST['hours'])) {
      $selectedHour = $_POST['hours']; // this is an array

      // You can also implode them into a single string if needed
      $hourString = implode(",", $selectedHour);
      // echo "All selected days: $daysString";
      } 
      


    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_insert_item.exe ' . $query. ' ' .$enteredTime. ' '.$hourString. ' ' .$currentTime;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';
    system('chmod o+x odbc_insert_item.exe');
    system('chmod 755 odbc_insert_item.exe');

    // Run the command
    $output = shell_exec($command);
    
    // Display results
    // echo "Return code: $retVal<br>";
    echo "<div class='table-wrapper'>";
    echo "<table border='1'>";
    echo "$output<br>";
    echo "</table>";
    echo "</div>";
}

?>