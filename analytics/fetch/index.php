<?php
//*desc: Fetch analytics data
require_once('../../lib/config.php');
require_once('../../lib/analytics_helper.php');

if(ANALYTICS_DISABLED) {
    error_log("FETCH:Analytics diabled\n", 3, LOG_FILE);
    echo 'Analytics disabled.';
    http_response_code(200);
    return;
}

$servername = DB_SERVER_NAME;
$dbname = DB_DATABASE_NAME;
$username = DB_USER_NAME;
$password = DB_USER_PASSWORD;

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    error_log("FETCH:Connection failed: ". $conn->connect_error . "\n", 3, LOG_FILE);
    die("Connection failed: " . $conn->connect_error);
}

// Get analytics records from database
// TODO: Modify this to only pull for given number of days
$sql = "SELECT * FROM nodes";

error_log("FETCH:Pulling records from DB...\n", 3, LOG_FILE);

$nodes_json = "[";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    error_log("FETCH:Records found. Building JSON. Count: " . $result->num_rows . "\n", 3, LOG_FILE);

    while ($row = $result->fetch_assoc()) {
        if(strlen($nodes_json) > 3)
        {
            // Add comma before records but only if not first record
            $nodes_json .= ",";
        }

        // Create JSON row
        $nodes_json .= "{{\"version\":\"" . $row['version'] . 
            "\",\"time\":\"" . $row['last_access_time'] . 
            "\",\"lat\":\"" . $row['latitude'] . 
            "\",\"long\":\"" . $row['longitude'] . 
            "\",\"cn\":\"" . $row['continent_code'] . 
            "\",\"cc\":\"" . $row['country_code'] . 
            "\"}}";
    }    
}

$nodes_json .= "]";
error_log("FETCH:Returning JSON\n", 3, LOG_FILE);
echo $nodes_json ;

?>