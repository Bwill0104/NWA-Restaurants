<html>
<body>
<h3>Enter information about an item to add to the database:</h3>

<div>
    <b>Suppliers:</b>
    <table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Coco Fresh Tea &amp; Juice</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Sharetea</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Boba Guys</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Kung Fu Tea</td>
    </tr>
    <tr>
        <td>15</td>
        <td>Fat Straws</td>
    </tr>
    </tbody>
    </table>
</div>

<form action="odbc_insert_item.php" method="post">
    Restaraunt ID: <input type="text" name="rest_id"><br>
    Name: <input type="text" name="name"><br>
    City: <input type="text" name="city"><br>
    Address: <input type="text" name="address"><br>
    Rating: <input type="text" name="rating"><br>
    <input name="submit" type="submit" >
</form>
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


