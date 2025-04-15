// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

// owl carousel 

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 6
        }
    }
})

// toggle button

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('.mobile-nav-toggle');
    const navMenu = document.querySelector('.navbar-nav');
    const searchBar = document.querySelector('#searchBar');

    toggleButton.addEventListener('click', () => {
        navMenu.classList.toggle('show');
    });
});

// active menu

document.addEventListener("DOMContentLoaded", function () {
    // Get all navigation links
    const navLinks = document.querySelectorAll(".nav-item .nav-link");

    // Function to set the active link
    function setActiveLink() {
        // Get the current URL path
        const currentPath = window.location.pathname;

        // Loop through all navigation links
        navLinks.forEach((link) => {
            // Remove the "active" class from all links
            link.classList.remove("active");

            // Get the link's href attribute (relative path)
            const linkPath = new URL(link.href).pathname;

            // Check if the link's path matches the current path
            if (linkPath === currentPath) {
                // Add the "active" class to the matching link
                link.classList.add("active");
            }
        });
    }

    // Call the function to set the active link on page load
    setActiveLink();

    // Add click event listeners to the navigation links
    navLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            // Prevent default link behavior (optional, depending on your setup)
            event.preventDefault();

            // Remove the "active" class from all links
            navLinks.forEach((link) => link.classList.remove("active"));

            // Add the "active" class to the clicked link
            this.classList.add("active");

            // Navigate to the clicked link's href
            window.location.href = this.getAttribute("href");
        });
    });
});