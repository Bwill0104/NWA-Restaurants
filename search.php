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
        h1 {
            color: white;
        }

        .content {
            margin: auto;
            max-width: 1000px;
            scroll-behavior: smooth;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 8px;
        }
        label {
            color: white;
            padding:  10px;
            font-size: 20px
        }


 
    </style>
</head>
<body>
    <div class="content">
        
        <div class="nav-bar">
        <form action="search.php" method="post">
        <label for="meal">Choose a Meal:</label>
            <select name="meal" id="meal">
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
            </select>
        <label for="vegetarian">Vegetarian</label>
            <select name="vegetarian" id="vegetarian">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        <label for="gluten">Gluten Free</label>
            <select name="gluten" id="gluten">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        <label for="vegan">Vegan</label>
            <select name="vegan" id="vegan">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        

            <br><br>
            <input name="submit" type="submit" value="Submit">
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


    $command = '/home/bryanw/public_html/NWA-Restaurants/odbc_insert_item.exe ' . $query. ' ' .$meal. ' ' .$vegetarian. ' ' .$gluten. ' ' .$vegan;

    echo '<p>Command: ' . htmlspecialchars($command) . '</p>';


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