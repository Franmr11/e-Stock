function previewImage() {        
    var reader = new FileReader();         
    reader.readAsDataURL(document.getElementById('uploadImage').files[0]);         
    reader.onload = function (e) {             
        document.getElementById('uploadPreview').src = e.target.result;         
    };     
}
$(document).ready(function () {
    //
});