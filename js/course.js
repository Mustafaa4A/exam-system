$(document).ready(() => {
    //
    let model = $(".modal");
    var btn_action = 'insert';

    //
    $('#register').click(() => fillUsers());

    //insert  
    $("#form").on('submit', (e) => {
        e.preventDefault();

        let course_id = $("#course_id").val();
        let course_name = $("#course_name").val();
        let credit_hours = $("#credit_hours").val();
        let date = $("#date").val();


        if (btn_action == 'insert') {
            var data = {
                "action": "insert",
                "course_id": '',
                "course_name": course_name,
                "credit_hours": credit_hours,
                "date": date,

            };
        } else {
            var data = {
                "action": "update",
                "course_id": course_id,
                "course_name": course_name,
                "credit_hours": credit_hours,
                "date": date,
            };
        }


        $.ajax({
            method: "POST",
            url: "../api/course.php",
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
                    loadCourse();

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
        let course_id = $(this).attr("course_id");
        btn_action = 'update';
        fetchCourse(course_id);

    });

    //delete data
    $("#table tbody").on('click', 'button.delete', function() {
        let course_id = $(this).attr("course_id");
        if (confirm(`Are you sure to delete this Course ${course_id}`)) {
            deleteCourse(course_id);
        }
    });

    function deleteCourse(course_id) {

        let data = {
            "action": "delete",
            "course_id": course_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/course.php",
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

                    loadCourse();

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
    loadCourse();

    function loadCourse() {

        let data = {
            "action": "read",
            "course_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/course.php",
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
                            <button class="btn btn-sm btn-primary edit" course_id=${items['ID']}><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete" course_id=${items['ID']}><i class="fa fa-trash"></i></button>
                            
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
    function fetchCourse(course_id) {

        let data = {
            "action": "read",
            "course_id": course_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/course.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message[0];

                if (status) {
                    $("#course_id").val(message['ID']);
                    $("#course_name").val(message['Name']);
                    $("#credit_hours").val(message['Credit Hours']);
                    $("#date").val(message['Registered Date']);

                    model.modal('show');
                }
            },
            error: function(data) {

            }
        })
    }


});