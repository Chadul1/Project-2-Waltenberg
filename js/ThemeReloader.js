
//Sets the cookie.
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

//finds the cookie if available.
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

//Changes the background color.
function changeBackgroundColor() {
    var dropdown = document.getElementById('dropdown');
    var selectedClass = dropdown.value;
    var body = document.getElementById('body');

    // Remove any existing Bootstrap background color class
    body.className = ''; // Clear all classes

    // Apply the selected Bootstrap background color class
    body.classList.add(selectedClass);

    if(selectedClass == 'bg-light'){
        body.classList.add('text-dark');
    }
    if(selectedClass == 'bg-dark'){
        body.classList.add('text-light');
    }

    // Set the selected class in a cookie
    setCookie('backgroundColor', selectedClass, 7); // Expires in 7 days
}

// Add event listener to the dropdown
var ID = document.getElementById('dropdown');
if(ID != null){
    ID.addEventListener('change', changeBackgroundColor);
}


// On page load, apply the color stored in the cookie
window.onload = function() {
    var colorClass = getCookie('backgroundColor');
    if (colorClass) {
        document.getElementById('body').classList.add(colorClass);
    }

    if(colorClass == 'bg-light'){
        body.classList.add('text-dark');
    }
    if(colorClass == 'bg-dark'){
        body.classList.add('text-light');
    }   
}