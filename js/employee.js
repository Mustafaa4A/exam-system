$(document).ready(() => {
    //
    let model = $(".modal");
    var btn_action = 'insert';

    //
    $('#register').click(() => fillUsers());

    //insert  
    $("#form").on('submit', (e) => {
        e.preventDefault();
        let emp_id = $('#emp_id').val()
        let emp_name = $('#emp_name').val()
        let gender = $('#gender').val()
        let degree = $('#degree').val()
        let title = $('#title').val()
        let address = $('#address').val()
        let email = $('#email').val()
        let phone = $('#phone').val()
        let salary = $('#salary').val()
        let user_id = $('#user_id').val()
        let status = $('#status').val()
        let date = $('#date').val()

        if (btn_action == 'insert') {
            var data = {
                "action": "insert",
                "emp_id": '',
                "emp_name": emp_name,
                "gender": gender,
                "degree": degree,
                "title": title,
                "address": address,
                "email": email,
                "phone": phone,
                "salary": salary,
                "user_id": user_id,
                "status": status,
                "date": date
            };

        } else {
            var data = {
                "action": "update",
                "emp_id": emp_id,
                "emp_name": emp_name,
                "gender": gender,
                "degree": degree,
                "title": title,
                "address": address,
                "email": email,
                "phone": phone,
                "salary": salary,
                "user_id": user_id,
                "status": status,
                "date": date
            };
        }


        $.ajax({
            method: "POST",
            url: "../api/employee.php",
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
                    loadEmployee();

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
        let empId = $(this).attr("emp_id");
        btn_action = 'update';
        fillUsers();
        fetchEmployee(empId);

    });

    //delete data
    $("#table tbody").on('click', 'button.delete', function() {
        let empId = $(this).attr("emp_id");
        if (confirm(`Are you sure to delete this R=Employee with ID: ${empId}`)) {
            deleteEmployee(empId);
        }
    });

    function deleteEmployee(empId) {
        let data = {
            "action": "delete",
            "emp_id": empId,
        }

        $.ajax({
            method: "POST",
            url: "../api/employee.php",
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

                    setTimeout(() => {
                        $(".alert").hide();
                    }, 3000);


                    loadEmployee();
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
    loadEmployee();

    function loadEmployee() {
        let data = {
            "action": "read",
            "emp_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/employee.php",
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
                            <button class="btn btn-sm btn-primary edit" emp_id=${items['ID']}><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete" emp_id=${items['ID']}><i class="fa fa-trash"></i></button>
                            
                        </td?
                        `;
                        tbody += '</tr>'
                    });

                    $('#table thead').html(thead);
                    $('#table tbody').html(tbody);
                    $('#table').DataTable();

                }
            },
            error: function(data) {}

        })
    }


    //fetch data
    function fetchEmployee(empId) {

        let data = {
            "action": "read",
            "emp_id": empId,
        }

        $.ajax({
            method: "POST",
            url: "../api/employee.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message[0];

                if (status) {
                    $('#emp_id').val(message['ID']);
                    $('#emp_name').val(message['Name']);
                    $('#gender').val(message['Gender']);
                    $('#degree').val(message['Degree']);
                    $('#title').val(message['Title']);
                    $('#address').val(message['Address']);
                    $('#email').val(message['Email']);
                    $('#phone').val(message['Phone']);
                    $('#salary').val(message['Salary']);
                    $('#user_id').val(message['User']);
                    $('#status').val(message['Status']);
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
            "emp_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/employee.php",
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