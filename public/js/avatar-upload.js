let uploadBtn = $('.upload-button');
let uploadForm = $('.file-upload');


let readURL = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

uploadForm.on('change', function () {
    readURL(this);
});

uploadBtn.on('click', function () {
    $(".file-upload").click();
});
