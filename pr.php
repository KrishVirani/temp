<!DOCTYPE html>
<html lang="en" >
<head>
 

</head>
<body>
<!-- partial:index.partial.html -->
<body>
    >
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "krish";

// Create connection
        $conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
        if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";
        $sql="select * from login";
        $result=$conn->query($sql);
                
        if ($result->num_rows > 0) 
        {   
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - username: " . $row["username"]. " Password " . $row["Password"]. "<br>";
        }
        } else {
        echo "0 results";
        }
        $conn->close();
    ?>
</body>
<!-- partial -->
  

</body>
</html>