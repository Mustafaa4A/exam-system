$(document).ready(() => {
    $("#form").on('submit', (e) => {
        e.preventDefault();

        let username = $("#username").val();
        let password = $("#password").val();


        var data = {
            "action": "login",
            "username": username,
            "password": password


        };

        $.ajax({
            method: "POST",
            url: "../api/login.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message;

                if (status) {
                    window.location = 'dashboard.php';
                } else {
                    $('.alert').html(message);
                    $('.alert').show();
                }

            },
            error: function(data) {

            }
        });
    })
});