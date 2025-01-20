<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Latitude and Longitude</title>
</head>
<body>
    <h1>Get Latitude and Longitude</h1>

    <button id="get-location-btn">Get My Location</button>
    <p id="location"></p>

    <script>
        document.getElementById("get-location-btn").addEventListener("click", function() {
            // Check if geolocation is supported
            if (navigator.geolocation) {
                // Get current position
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Display the coordinates
                    document.getElementById("location").innerText = "Latitude: " + latitude + ", Longitude: " + longitude;

                    // // Send the data to the server (example with AJAX)
                    // fetch('/save-location', {
                    //     method: 'POST',
                    //     headers: {
                    //         'Content-Type': 'application/json'
                    //     },
                    //     body: JSON.stringify({
                    //         latitude: latitude,
                    //         longitude: longitude
                    //     })
                    // })
                    // .then(response => response.json())
                    // .then(data => console.log('Location saved:', data))
                    // .catch(error => console.error('Error:', error));
                    
                }, function(error) {
                    console.log("Error getting location: " + error.message);
                });

            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        });
    </script>
</body>
</html>
