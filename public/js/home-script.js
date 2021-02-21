var img = document.getElementById('img-group');

img.addEventListener('change', showFile);

function showFile(e){
    var fileName = document.getElementById('form-img').files[0].name;
    document.getElementById('img-name').innerText = fileName;
}