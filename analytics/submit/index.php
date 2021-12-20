<?php
//*desc: Submits the callers IP address to the node map
require_once('../../lib/config.php');
require_once('../../lib/analytics_helper.php');

if(ANALYTICS_DISABLED) {
    error_log(date(DATE_ISO8601) . ": SUBMIT:Analytics diabled\n", 3, LOG_FILE);
    echo 'Analytics disabled.';
    http_response_code(200);
    return;
}

$servername = DB_SERVER_NAME;
$dbname = DB_DATABASE_NAME;
$username = DB_USER_NAME;
$password = DB_USER_PASSWORD;

$ip = 'NA';
$ua = 'NA';

//Check to see if the CF-Connecting-IP header exists.
if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
    //If it does, assume that PHP app is behind Cloudflare.
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
} else{
    //Otherwise, use REMOTE_ADDR.
    $ip = $_SERVER['REMOTE_ADDR'];
}

//block common lan ip's
if (starts_with($ip, "127.") || starts_with($ip, "10.") || starts_with($ip, "192.168")) {
    error_log(date(DATE_ISO8601) . ": SUBMIT:Access from LAN addresses prohibited. IP: " . $ip . "\n", 3, LOG_FILE);
    echo 'Access from LAN addresses prohibited.';
    http_response_code(403);
    return;
}

if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
}

//block any user agent that does not start with nerva-cli
//a basic check as the ua string can be spoofed, but
//means someone actually has to put in effort to spam it

if ($ua == "NA" || substr($ua, 0, 9) != "nerva-cli") {
    error_log(date(DATE_ISO8601) . ": SUBMIT:Invalid user agent : " . $ua . "\n", 3, LOG_FILE);
    echo 'Invalid user agent string.';
    http_response_code(403);
    return;
}

$version = substr($ua, 10);
error_log(date(DATE_ISO8601) . ": SUBMIT:IP: " . $ip . " | Version : " . $version . "\n", 3, LOG_FILE);

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    error_log(date(DATE_ISO8601) . ": SUBMIT:Connection failed: ". $conn->connect_error . "\n", 3, LOG_FILE);
    die("Connection failed: " . $conn->connect_error);
}

// Query to see if node already known
$sql = "SELECT * FROM nodes WHERE address = '$ip'";
error_log(date(DATE_ISO8601) . ": SUBMIT:Looking up existing IP record: ". $ip . "\n", 3, LOG_FILE);

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Node already known so just update it    
    $sqlUpdate = "UPDATE nodes SET version = '$version', last_access_time = now() WHERE address = '$ip'";
    error_log(date(DATE_ISO8601) . ": SUBMIT:Record found. Updating...\n", 3, LOG_FILE);

    if ($conn->query($sqlUpdate) === TRUE) {
        error_log(date(DATE_ISO8601) . ": SUBMIT:Record updated successfully\n", 3, LOG_FILE);
        echo 'Record updated successfully';
    } else {
        error_log(date(DATE_ISO8601) . ": SUBMIT:Error updating record." . $sql . "<br>" . $conn->error . "\n", 3, LOG_FILE);
        echo 'Error updating record';
    }
} else {
    // New node so need to add it
    
    // First get geolocation data.
    error_log(date(DATE_ISO8601) . ": SUBMIT:Record not found. Calling geolocation.\n", 3, LOG_FILE);
    $geoUrl = "https://tools.keycdn.com/geo.json?host=$ip";
    $curl = curl_init($geoUrl);
    curl_setopt($curl, CURLOPT_URL, $geoUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "User-Agent: keycdn-tools:https://map.nerva.one",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Call API to retrieve geolocation
    $responseJson = curl_exec($curl);
    $responseDecoded = json_decode($responseJson);

    if($responseDecoded->status == 'success' && $responseDecoded->data->geo->ip == $ip) {
        // If geolocation returned success and IP matches, set that info
        $latitude = $responseDecoded->data->geo->latitude;
        $longitude = $responseDecoded->data->geo->longitude;
        $continent = $responseDecoded->data->geo->continent_code;
        $country = $responseDecoded->data->geo->country_code;

        error_log(date(DATE_ISO8601) . ": SUBMIT:Geolocation retrieved successfully. Inserting...\n", 3, LOG_FILE);
        $sqlInsert = "INSERT INTO nodes(address, version, latitude, longitude, continent_code, country_code) VALUES ('$ip', '$version', $latitude, $longitude, '$continent', '$country')";
    } else {
        // If geolocation failed, just set what we have
        error_log(date(DATE_ISO8601) . ": SUBMIT:Issue getting Geolocation. Inserting...\n", 3, LOG_FILE);
        $sqlInsert = "INSERT INTO nodes(address, version) VALUES ('$ip', '$version')";
    }

    // Insert new record to database
    if ($conn->query($sqlInsert) === TRUE) {
        error_log(date(DATE_ISO8601) . ": SUBMIT:New record created successfully\n", 3, LOG_FILE);
        echo "New record created successfully";
    } else {
        error_log(date(DATE_ISO8601) . ": SUBMIT:Error creating new record" . $sql . "<br>" . $conn->error . " \n", 3, LOG_FILE);
        echo "Error creating new record";
    }

    curl_close($curl);
    var_dump($responseJson);
}

$conn->close();

// Just return success
error_log(date(DATE_ISO8601) . ": SUBMIT:Returning Success.\n", 3, LOG_FILE);
http_response_code(200);

?>