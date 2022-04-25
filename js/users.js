$(document).ready(() => {
    //
    let model = $(".modal");
    var btn_action = 'insert';

    //insert  
    $("#form").on('submit', (e) => {
        e.preventDefault();

        let userId = $('#user_id').val();
        let username = $('#username').val();
        let password = $('#password').val();
        let status = $('#status').val();
        let regDate = $('#date').val();


        if (btn_action == 'insert') {
            var data = {
                "action": "insert",
                "user_id": '',
                "username": username,
                "password": password,
                "status": status,
                "reg_date": regDate
            };

        } else {
            var data = {
                "action": "update",
                "user_id": userId,
                "username": username,
                "password": password,
                "status": status,
                "reg_date": regDate
            };
        }


        $.ajax({
            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message;

                if (status) {
                    btn_action = (btn_action == 'update') ? 'insert' : btn_action;
                    $('#form')[0].reset();
                    model.modal('hide');
                    $('.alert').removeClass("alert-light-danger");
                    $('.alert').addClass("alert-light-success");
                    $('.alert span').html(message);
                    $('.alert').show();
                    loadUser();

                    setTimeout(() => {
                        $(".alert").hide();
                    }, 3000);



                } else {
                    $('.alert').removeClass("alert-light-success");
                    $('.alert').addClass("alert-light-danger");
                    $('.alert span').html(message);
                    $('.alert').show();
                }

            },
            error: function(data) {

            }
        });
    })

    //update button
    $("#table tbody").on('click', 'button.edit', function() {
        let userId = $(this).attr("userid");
        btn_action = 'update';
        fetchUser(userId);

    });

    //delete data
    $("#table tbody").on('click', 'button.delete', function() {
        let userId = $(this).attr("userid");
        if (confirm(`Are you sure to delete this user ${userId}`)) {
            deleteUser(userId);
        }
    });

    function deleteUser(userId) {

        let data = {
            "action": "delete",
            "user_id": userId,
        }

        $.ajax({
            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message;

                if (status) {
                    $('.alert').removeClass("alert-light-danger");
                    $('.alert').addClass("alert-light-success");
                    $('.alert span').html(message);
                    $('.alert').show();
                    console.log(message);

                    setTimeout(() => {
                        $(".alert").hide();
                    }, 3000);


                    loadUser();
                } else {
                    $('.alert').removeClass("alert-light-success");
                    $('.alert').addClass("alert-light-danger");
                    $('.alert span').html(message);
                    $('.alert').show();

                }



            },
            error: function(data) {

            }
        });
    }


    //load data
    loadUser();

    function loadUser() {

        let data = {
            "action": "read",
            "user_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message;
                let thead = '',
                    tbody = '';

                if (status) {
                    message.forEach((items, i) => {
                        thead = '<tr>';
                        for (index in items) {
                            thead += `
                                <th> ${index} </th>
                            `
                        }
                        thead += '<th>Action</th>'
                        thead += '</tr>'

                        tbody += '<tr>'
                        for (index in items) {

                            //checking if the status column is actyive or not
                            if (items[index] == 'active') {
                                tbody += `<td> <span class="badge bg-success"> ${items[index]} </span></td>`;
                            } else if (items[index] == 'inactive') {
                                tbody += `<td> <span class="badge bg-danger"> ${items[index]} </span></td>`;
                            } else {
                                tbody += `
                                <td> ${items[index]} </td>
                            `;
                            };

                        }

                        tbody += `
                        <td>
                            <button class="btn btn-sm btn-primary edit" userid=${items['User ID']}><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete" userid=${items['User ID']}><i class="fa fa-trash"></i></button>
                            
                        </td?
                        `;
                        tbody += '</tr>'
                    });

                    $('#table thead').html(thead);
                    $('#table tbody').html(tbody);
                    $('#table').DataTable();
                }
            },
            error: function(data) {

            }
        })
    }


    //fetch data
    function fetchUser(userId) {

        let data = {
            "action": "read",
            "user_id": userId,
        }

        $.ajax({
            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message[0];

                if (status) {
                    $('#user_id').val(message['User ID']);
                    $('#username').val(message['Username']);
                    $('#password').val(message['Password']);
                    $('#status').val(message['Status']);
                    $('#date').val(message['Registered Date']);

                    model.modal('show');
                }
            },
            error: function(data) {

            }
        })
    }

});