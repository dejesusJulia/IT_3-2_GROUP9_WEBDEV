// VARIABLES
var img = document.getElementById('img-group');

// EVENT LISTENER
img.addEventListener('change', showFile);

// FUNCTIONS
function showFile(e){
    var fileName = document.getElementById('form-img').files[0].name;
    document.getElementById('img-name').innerText = fileName;
}
