<html>

 
<style>
    body {
        background-color: #ffb766
        background-image: url('restaraunt.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        
    }
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
</style>
<body>
    <div class="nav-bar">
        <div class="links">
            <!-- <a href="home.php">Home</a> -->
            <a href="add.php?type=restaurant">Add Restaurant</a>
            <a href="add.php?type=hours">Add restaraunt hours</a>
            <a href="add.php?type=menu">Add a menu</a>
        </div>
    <h1>NWA Restaraunts</h1>

        <div class="search-bar">
            <form action="search.php" method="get">
                <input type="text" name="q" placeholder="Search...">
                <input type="submit" value="Go">
            </form>
        </div>
    </div>  


  <div class="content">
    <div class="menu-box">
      <!-- <button class="button menu" type="button" onclick="window.location.href='add.php?type=restaurant';"  >Add a restaraunt</button>
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=hours';">Add restaraunt hours</button>
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=menu';">Add a menu</button>
      <br> -->
      <button class="button menu" type="button" onclick="window.location.href='find.php?type=hours';">Find Open Restaraunts</button>
      <button class="button menu" type="button">Query menu options</button>
      <button class="button menu" type="button" onclick="window.location.href='find.php?type=city';">Find restaraunts by city</button>
      <button class="button menu" type="button" onclick="window.location.href='search.php';">Search For Restaurants</button>
      <button class="button menu" type="button" onclick="window.location.href='add.php?type=remove';" >Remove a restaraunt</button>
    </div>
<br><br>
    
    </div>
    <br><br>
</body>
</html>

<?php

if (isset($_POST['submit'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $rest_id = escapeshellarg($_POST[rest_id]);
    $name = escapeshellarg($_POST[name]);
    $city = escapeshellarg($_POST[city]);
    $address = escapeshellarg($_POST[address]);
    $rating = escapeshellarg($_POST[rating]);

    $command = '/home/bryanw/public_html/project_cpp/odbc_insert_item.exe ' . $rest_id . ' ' . $name . ' ' . $city. ' ' . $address. ' ' .$rating;

    echo '<p>' . 'command: ' . $command . '<p>';
    // remove dangerous characters from command to protect web server
    $command = escapeshellcmd($command);
 
    // run odbc_insert_item.exe
    system($command);           
}
?>