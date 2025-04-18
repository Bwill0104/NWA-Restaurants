<html>
<head>
<link rel="stylesheet" href="styles.css">
<style>

  

    .content {
    margin: auto;
    max-width: 200px;
    scroll-behavior: smooth;
    }

    .select {
        background-color: #333;
        padding: 10px 20px;
        border-radius: 8px;
        width: 300px;
    }
    
    label {
        color: white;
        font-size: 20px
    }
    .submit-container {
        display: flex;
        justify-content: flex-end;
        padding: 10px 20px; 
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
        
        <div class="select">
            <h1>Select your options</h1>
        <form action="search.php" method="post">
            <div style="margin-bottom: 10px;">
            <label for="meal">Choose a Meal:</label>
                <select name="meal" id="meal">
                    <option value="openBreak">Breakfast</option>
                    <option value="openLunch">Lunch</option>
                    <option value="openDinner">Dinner</option>
                </select>
        </div>
            <div style="margin-bottom: 10px;">
        <label for="vegetarian">Vegetarian</label>
            <select name="vegetarian" id="vegetarian">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            </div>
            <div style="margin-bottom: 10px;">
        <label for="gluten">Gluten Free</label>
            <select name="gluten" id="gluten">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            </div>
            <div style="margin-bottom: 10px;">
        <label for="vegan">Vegan</label>
            <select name="vegan" id="vegan">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            </div>
        

            <div class="submit-container">
                <input name="submit" type="submit" value="Submit">
            </div>
        </form>
        </div>
    </div>
</body>
</html>

<?php

if (isset($_POST['submit'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $query = escapeshellarg("search");
    $meal = escapeshellarg($_POST[meal]);
    $vegetarian = escapeshellarg($_POST[vegetarian]);
    $gluten = escapeshellarg($_POST[gluten]);
    $vegan = escapeshellarg($_POST[vegan]);


    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_query.exe ' . $query. ' ' .$meal. ' ' .$vegetarian. ' ' .$gluten. ' ' .$vegan;

    // echo '<p>Command: ' . htmlspecialchars($command) . '</p>';


    // Run the command
    $output = shell_exec($command);
    
    // Display results
    // echo "Return code: $retVal<br>";
    echo "<div class='table-wrapper'>";
    echo "<table border='1'>";
    echo "$output<br>";
    echo "</table>";
    echo "<button class='button bac' type='button' onclick=\"window.location.href='home.php';\">Back</button>";
    echo "</div>";
    echo "<style> .content{ display: none} </style>";
}
?>