$(document).ready(function() {
    studentsCount();

    function studentsCount() {
        data = {
            'action': 'studentsCount',
        }

        $.ajax({
            type: "POST",
            url: "../api/dashboard.php",
            data: data,
            dataType: "JSON",
            success: function(data) {
                let status = data.status;
                let message = data.message['count'];

                if (status) {
                    $('#students').html(message);
                }

            }
        });
    }


    UsersCount();

    function UsersCount() {
        data = {
            'action': 'UsersCount',
        }

        $.ajax({
            type: "POST",
            url: "../api/dashboard.php",
            data: data,
            dataType: "JSON",
            success: function(data) {
                let status = data.status;
                let message = data.message['count'];

                if (status) {
                    $('#users').html(message);
                }

            }
        });
    }


    EmployeeCount();

    function EmployeeCount() {
        data = {
            'action': 'EmployeeCount',
        }

        $.ajax({
            type: "POST",
            url: "../api/dashboard.php",
            data: data,
            dataType: "JSON",
            success: function(data) {
                let status = data.status;
                let message = data.message['count'];

                if (status) {
                    $('#employees').html(message);
                }

            }
        });
    }


    RecordsCount();

    function RecordsCount() {
        data = {
            'action': 'RecordsCount',
        }

        $.ajax({
            type: "POST",
            url: "../api/dashboard.php",
            data: data,
            dataType: "JSON",
            success: function(data) {
                let status = data.status;
                let message = data.message['count'];

                if (status) {
                    $('#records').html(message);
                }

            }
        });
    }
});