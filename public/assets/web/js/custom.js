// Init Animate on Scroll
AOS.init({
    once: true,
    delay: 100
});

// Jquery validator default configuration
$.validator.setDefaults({
    errorPlacement: function (label, element) {
        label.addClass('mt-2 text-danger');
        element.parent().append(label);
    }
});

// Toggle password visibility
function togglePassword(event, target) {
    const checked = event.target.checked;
    const input = $(`input#${target}`);

    input.attr('type', checked ? 'text' : 'password');
}

// Preview single image
function previewImage(event, target) {
    const fileInput = event.target;
    const file = fileInput.files[0];
    const imageBlob = new Blob([file], { type: file.type });
    const imageBlobPath = URL.createObjectURL(imageBlob);
    $(`img#${target}`).attr('src', imageBlobPath);
}

// Preview single image on modal
function previewImageModal(event) {
    const image = $(event.target);
    const imageSrc = image.attr('src');
    const imageAlt = image.attr('alt');

    const imageTarget = $('#modal-image-preview img');
    imageTarget.attr('src', imageSrc);
    imageTarget.attr('alt', imageAlt);
}

// Validate number input only
$('input.number-input').each(function () {
    const value = parseFloat($(this).val());
    if (!isNaN(value)) {
        $(this).val(Math.floor(value));
    }
});

$('input.number-input').keypress(function (e) {
    const keyCode = e.which ? e.which : e.keyCode;
    const inputChar = String.fromCharCode(keyCode);

    // Allow numeric characters only
    if (!/^\d+$/.test(inputChar)) {
        e.preventDefault();
    }
});