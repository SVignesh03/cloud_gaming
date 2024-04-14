document.addEventListener("DOMContentLoaded", function() {
    var contentArea = document.getElementById("content-area");

    // Function to load and display content
    function loadContent(pageUrl) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", pageUrl, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                contentArea.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }

    // Add click event listeners to navigation links
    var navLinks = document.querySelectorAll("ul li a");
    navLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            var pageUrl = link.getAttribute("data-page");
            loadContent(pageUrl);
        });
    });
});

function send_request(event) {
    event.preventDefault(); // Prevent the default link behavior

    var data = window.localStorage.getItem("chrome-dino");
    // window.location.href = 'test.php';
    document.cookie = "myData=" + encodeURIComponent(data);
}