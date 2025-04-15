<html>

 
<style>
    body {
        /* background-color: #ffb766 */
        background-image: url('restaraunt.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        
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

.menu-box {
  /* margin-bottom: 300px; */
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


    <div class="top">
      <h1>NWA Restaraunts</h1>
    </div>
  <div class="content">
    <div class="menu-box">
      <button class="button menu" type="button" >Add a restaraunt</button>
      <button class="button menu" type="button">Add restaraunt hours</button>
      <button class="button menu" type="button">Add a menu</button>
      <br>
      <button class="button menu" type="button">Query hours</button>
      <button class="button menu" type="button">Query menu options</button>
      <button class="button menu" type="button">Find restaraunts by city</button>
      <button class="button menu" type="button">Find restaraunts by ratings</button>
      <button class="button menu" type="button">Remove a restaraunt</button>
    </div>
<br><br>
    <div class="form">
      <form action="odbc_insert_item.php" method="post">
          Restaraunt ID: <input type="text" name="rest_id"><br>
          Name: <input type="text" name="name"><br>
          City: <input type="text" name="city"><br>
          Address: <input type="text" name="address"><br>
          Rating: <input type="text" name="rating"><br>
          <input name="submit" type="submit" >
      </form>
    </div>
    <br><br>
</div>
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


