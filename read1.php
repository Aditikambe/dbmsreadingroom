<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readingroom";
$aditi = new mysqli($servername, $username, $password, $dbname);
if ($aditi->connect_error) {
  die("Connection failed: " . $aditi->connect_error);
}

function validateName($name) {
  $pattern = "/^[a-zA-Z\s\-']+$/";
  return preg_match($pattern, $name);
}

function validateEmail($email) {
  $pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
  return preg_match($pattern, $email);
}

function validateDateTime($dateTime) {
  
  $currentTime = new DateTime();
  $enteredTime = new DateTime($dateTime);
  return $enteredTime >= $currentTime;
}

if (isset($_POST['save'])) {
  $Name = $_POST['Name'];
  $Date = $_POST['Date'];
  $Phone_number = $_POST['Phone_number'];
  $In_time = $_POST['In_time'];
  $Email_address = $_POST['Email_address'];

  $nameValid = validateName($Name);
  $emailValid = validateEmail($Email_address);
  $dateTimeValid = validateDateTime("$Date $In_time");

  if ($nameValid && $emailValid && $dateTimeValid) {
    $sql_query = "INSERT INTO entry (Name, Date, Phone_number, In_time, Email_address)
                   VALUES ('$Name', '$Date', '$Phone_number', '$In_time', '$Email_address')";

    if ($aditi->query($sql_query) === TRUE) {
      echo "Entry done successfully!";
    } else {
      echo "Error: " . $sql_query . "<br>" . $aditi->error;
    }
  } else {
    if (!$nameValid) {
      echo "Error: Name can only contain letters, spaces, hyphens, and apostrophes.";
    }
    if (!$emailValid) {
      echo "Error: Invalid email format. Please enter a valid email address.";
    }
    if (!$dateTimeValid) {
      echo "Error: Please enter current date and time.";
    }
  }
}
if (isset($_POST['update'])) {
  $entry_id = $_POST['entry_id']; // Assuming an entry_id field for update
  $Name = $_POST['Name'];
  $Date = $_POST['Date'];
  $Phone_number = $_POST['Phone_number'];
  $In_time = $_POST['In_time'];
  $Email_address = $_POST['Email_address'];

  $nameValid = validateName($Name);
  $emailValid = validateEmail($Email_address);

  if ($nameValid && $emailValid) {
    $sql_query = "UPDATE entry SET 
                   Name = '$Name', 
                   Date = '$Date', 
                   Phone_number = '$Phone_number', 
                   In_time = '$In_time', 
                   Email_address = '$Email_address'
                   WHERE id = '$entry_id'";

    if ($aditi->query($sql_query) === TRUE) {
      echo "Entry updated successfully!";
    } else {
      echo "Error: " . $sql_query . "<br>" . $aditi->error;
    }
  } else {
    // Similar error messages for validation failures
  }
}


$aditi->close();
?>
