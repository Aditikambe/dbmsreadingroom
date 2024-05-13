<!DOCTYPE html>
<html>
<head>
    <title>Reading Room Entry - Display</title>
</head>
<body>
    <h2>Entries</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Phone Number</th>
            <th>In Time</th>
            <th>Email Address</th>
            <th>Action</th>
        </tr>
       
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "readingroom";

        $aditi = new mysqli($servername, $username, $password, $dbname);
        if ($aditi->connect_error) {
            die("Connection failed: " . $aditi->connect_error);
        }

        $sql = "SELECT * FROM entry";
        $result = $aditi->query($sql);
 
        /*
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Date'] . "</td>";
                echo "<td>" . $row['Phone_number'] . "</td>";
                echo "<td>" . $row['In_time'] . "</td>";
                echo "<td>" . $row['Email_address'] . "</td>";
                echo "<td><a href='update.php?id=" . $row['id'] . "'>Update</a></td>"; // Add Update link
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No entries found</td></tr>";
       
     }
     */
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='text' name='name' value='" . $row['Name'] . "'></td>";
            echo "<td><input type='text' name='date' value='" . $row['Date'] . "'></td>";
            echo "<td><input type='text' name='phone_number' value='" . $row['Phone_number'] . "'></td>";
            echo "<td><input type='text' name='in_time' value='" . $row['In_time'] . "'></td>";
    echo "<td><input type='text' name='email_address' value='" . $row['Email_address'] . "' readonly></td>";
    echo "<td><a href='update.php?";
    echo "&name=" . urlencode($row['Name']); // Pass Name
    echo "&date=" . urlencode($row['Date']); // Pass Date
    echo "&phone_number=" . urlencode($row['Phone_number']); // Pass Phone Number
    echo "&in_time=" . urlencode($row['In_time']); // Pass In Time
    echo "&email_address=" . urlencode($row['Email_address']); // Pass Email Address
    echo "'>Update</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No entries found</td></tr>";
    }
        $aditi->close();
        ?>
    </table>
</body>
</html>
