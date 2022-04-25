$(document).ready(() => {
    //
    let model = $(".modal");
    var btn_action = 'insert';

    //
    $('#register').click(() => fillUsers());

    //insert  
    $("#form").on('submit', (e) => {
        e.preventDefault();

        let student_id = $('#student_id').val()
        let student_name = $('#student_name').val()
        let gender = $('#gender').val()
        let address = $('#address').val()
        let phone = $('#phone').val()
        let semester = $('#semester').val()
        let _class = $('#class').val()
        let faculty = $('#faculty').val()
        let status = $('#status').val()
        let date = $('#date').val()


        if (btn_action == 'insert') {
            var data = {
                "action": "insert",
                "student_id": '',
                "student_name": student_name,
                "gender": gender,
                "address": address,
                "phone": phone,
                "semester": semester,
                "_class": _class,
                "faculty": faculty,
                "user_id": '',
                "status": status,
                "reg_user": '',
                "date": date
            };

        } else {
            var data = {
                "action": "update",
                "student_id": student_id,
                "student_name": student_name,
                "gender": gender,
                "address": address,
                "phone": phone,
                "semester": semester,
                "_class": _class,
                "faculty": faculty,
                "user_id": '',
                "status": status,
                "reg_user": '',
                "date": date
            };
        }

        $.ajax({
            method: "POST",
            url: "../api/student.php",
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
                    loadStudent();

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
        let student_id = $(this).attr("student_id");
        btn_action = 'update';
        fillUsers();
        fetchStudent(student_id);

    });

    //delete data
    $("#table tbody").on('click', 'button.delete', function() {
        let student_id = $(this).attr("student_id");
        if (confirm(`Are you sure to delete this Student with ID: ${student_id}`)) {
            deleteStudent(student_id);
        }
    });

    function deleteStudent(student_id) {
        let data = {
            "action": "delete",
            "student_id": student_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/student.php",
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


                    loadStudent();
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
    loadStudent();

    function loadStudent() {
        let data = {
            "action": "read",
            "student_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/student.php",
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
                            <button class="btn btn-sm btn-primary edit" student_id=${items['ID']}><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete" student_id=${items['ID']}><i class="fa fa-trash"></i></button>
                            
                        </td?
                        `;
                        tbody += '</tr>'
                    });

                    $('#table thead').html(thead);
                    $('#table tbody').html(tbody);
                    $('#table').DataTable();

                    // $('#table').DataTable().columns([0, 2, 6, 7, 11]).visible(false);

                }
            },
            error: function(data) {}

        })
    }


    //fetch data
    function fetchStudent(student_id) {

        let data = {
            "action": "read",
            "student_id": student_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/student.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message[0];

                if (status) {
                    $('#student_id').val(message['ID']);
                    $('#student_name').val(message['Name']);
                    $('#gender').val(message['Gender']);
                    $('#address').val(message['Address']);
                    $('#phone').val(message['Phone']);
                    $('#semester').val(message['Current Semester']);
                    $('#class').val(message['Class']);
                    $('#faculty').val(message['Faculty']);
                    $('#reg_user').val(message['Registered user']);
                    $('#status').val(message['Status']);
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
            "student_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/student.php",
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