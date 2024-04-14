// Retrieve high score from local storage
var highScore = window.localStorage.getItem('chrome-dino');

// Create a JSON object with the high score
var data = { highScore: highScore };

// Define the URL of your PHP script
var url = 'update_highscore.php'; // Replace with the actual URL of your PHP script

// Send a POST request to the PHP script
fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
})
.then(response => {
    // Handle the response from the PHP script, if needed
    console.log(response);
})
.catch(error => {
    // Handle any errors, if they occur
    console.error(error);
});
