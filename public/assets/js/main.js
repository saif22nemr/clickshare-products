$(function () {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
});
function generateComplexPassword(length = 12) {
    // Define character pools for the password
    var upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    var numbers = '0123456789';
    var specialChars = '!@#$%^&*()-_=+<>?';

    // Combine all character pools
    var allCharacters = upperCase + lowerCase + numbers + specialChars;

    // Ensure the password includes at least one character from each pool
    var password = upperCase.charAt(Math.floor(Math.random() * upperCase.length)) +
        lowerCase.charAt(Math.floor(Math.random() * lowerCase.length)) +
        numbers.charAt(Math.floor(Math.random() * numbers.length)) +
        specialChars.charAt(Math.floor(Math.random() * specialChars.length));

    // Fill the rest of the password with random characters from the full pool
    for (var i = 4; i < length; i++) {
        password += allCharacters.charAt(Math.floor(Math.random() * allCharacters.length));
    }

    // Shuffle the characters to make the password unpredictable
    password = password.split('').sort(function () { return 0.5 - Math.random() }).join('');

    return password;
}

function deleteItem(row , table , url) {

    $.ajax({
        url: url,
        method: 'POST',
        headers: { Accept: 'application/json' },
        data: {
            _token : csrfToken,
            _method: "DELETE"
        },
        success: function (json) {
            toastr.success(json.message);
            table.row(row).remove().draw(false);
        },
        error: function (xhr) {
            console.log('delete', xhr);
            var json = xhr.responseJSON;
            if(json.status == false && json.message){
                toastr.error(json.message);
            }
        }
    });
}
