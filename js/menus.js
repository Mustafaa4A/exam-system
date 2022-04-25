$(document).ready(() => {
    //
    let model = $(".modal");
    var btn_action = 'insert';

    //
    $('#register').click(() => fillUsers());

    //insert  
    $("#form").on('submit', (e) => {
        e.preventDefault();

        let menu_id = $("#menu_id").val();
        let menu_name = $("#menu_name").val();
        let menu_link = $("#menu_link").val();
        let menu_module = $("#menu_module").val();
        let user_id = '';
        let reg_date = $('#date').val();


        if (btn_action == 'insert') {
            var data = {
                "action": "insert",
                "menu_id": '',
                "menu_name": menu_name,
                "menu_link": menu_link,
                "menu_module": menu_module,
                "user_id": user_id,
                "reg_date": reg_date
            };
        } else {
            var data = {
                "action": "update",
                "menu_id": menu_id,
                "menu_name": menu_name,
                "menu_link": menu_link,
                "menu_module": menu_module,
                "user_id": user_id,
                "reg_date": reg_date
            };
        }


        $.ajax({
            method: "POST",
            url: "../api/menus.php",
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
                    loadMenu();

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
        let menu_id = $(this).attr("menu_id");
        btn_action = 'update';
        fillUsers();
        fetchMenu(menu_id);

    });

    //delete data
    $("#table tbody").on('click', 'button.delete', function() {
        let menu_id = $(this).attr("menu_id");
        if (confirm(`Are you sure to delete this menu ${menu_id}`)) {
            deleteMenu(menu_id);
        }
    });

    function deleteMenu(menu_id) {

        let data = {
            "action": "delete",
            "menu_id": menu_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/menus.php",
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

                    loadMenu();

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
    }


    //load data
    loadMenu();

    function loadMenu() {

        let data = {
            "action": "read",
            "menu_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/menus.php",
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
                            <button class="btn btn-sm btn-primary edit" menu_id=${items['ID']}><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete" menu_id=${items['ID']}><i class="fa fa-trash"></i></button>
                            
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
    function fetchMenu(menu_id) {

        let data = {
            "action": "read",
            "menu_id": menu_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/menus.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message[0];

                if (status) {
                    $('#menu_id').val(message['ID']);
                    $('#menu_name').val(message['Name']);
                    $('#menu_link').val(message['Link']);
                    $('#menu_module').val(message['Module']);
                    $('#user_id').val(message['User ID']);
                    $('#date').val(message['Registered Date']);

                    model.modal('show');
                }
            },
            error: function(data) {

            }
        })
    }

    //fill user
    function fillUsers() {

        let data = {
            "action": "fillUser",
            "user_id": ''
        }

        $.ajax({
            method: "POST",
            url: "../api/menus.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message;
                let options = `<option value=''>Select user</option>`;
                if (status) {
                    message.forEach((items, i) => {
                        options += `<option value = '${items['user_id']}'>${items['username']}</option>`
                    });

                    $('#user_id').html(options);
                }
            },
            error: function(data) {

            }
        })
    }

});