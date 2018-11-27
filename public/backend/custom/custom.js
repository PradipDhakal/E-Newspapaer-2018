$(document).ready(function () {

    setTimeout(function () {
        $('.alert').hide('slow')

    },1000)


});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#show_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#change_image").change(function(){
    readURL(this);
});
CKEDITOR.replace('description');
