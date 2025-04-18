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
        color: white;
    }

    .content {
        margin: auto;
        scroll-behavior: smooth;
        margin-left: 40%;
    }

    label {
        color: black;
        font-size: 20px
    }
    .submit-container {
        display: flex;
        justify-content: flex-end;
        padding: 10px 20px; 
    }
    form {
        margin-top: 20px
    }
    .star {
  font-size: 25px;
  cursor: pointer;
}
 
.one {
    color: #ffb766;
}
 
.two {
    color: #ffb766;
}
 
.three {
    color: #ffb766;
}
 
.four {
  color: #ffb766;
}
 
.five {
    color: #ffb766;
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
        
    <form action="review.php" method="post">
        <div style="margin-bottom: 15px;">
            <label for="rest_id">Enter the restaurant ID:</label><br>
            <input type="text" id="rest_id" name="rest_id">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="review">Write a Review:</label><br>
            <textarea id="review" name="review" rows="5" cols="40"></textarea>
        </div>

        <input type="hidden" id="rating" name="rating" value="0">
        <span onclick="gfg(1)"
              class="star">★
        </span>
        <span onclick="gfg(2)"
              class="star">★
        </span>
        <span onclick="gfg(3)"
              class="star">★
        </span>
        <span onclick="gfg(4)"
              class="star">★
        </span>
        <span onclick="gfg(5)"
              class="star">★
        </span>
        <br><br>

        <input class="button"name="submit" type="submit" value="Submit">
    </form>
        <br><br>
    <script>
        let stars = document.getElementsByClassName("star");
        let output = document.getElementsByClassName("output");
        
        
        // Funtion to update rating
        function gfg(n) {
            remove();
            for (let i = 0; i < n; i++) {
                if (n == 1) cls = "one";
                else if (n == 2) cls = "two";
                else if (n == 3) cls = "three";
                else if (n == 4) cls = "four";
                else if (n == 5) cls = "five";
                stars[i].className = "star " + cls;
                
            }
            document.getElementById("rating").value = n;
        }
        
        // To remove the pre-applied styling
        function remove() {
            let i = 0;
            while (i < 5) {
                stars[i].className = "star";
                i++;
            }
        }
    </script>

    </div>

    </div>
</body>
</html>

<?php

if (isset($_POST['submit'])) {
  $query = escapeshellarg("review");
  $rest_id = escapeshellarg($_POST[rest_id]);
  $rating = escapeshellarg($_POST[rating]) ?? 0;

  $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query . ' ' . $rest_id. ' ' . $rating;

//   echo '<p>Command: ' . htmlspecialchars($command) . '</p>';

  $output = shell_exec($command);


}
?>