$(document).ready(() => {
    var btn_action = 'insert';
    let model = $(".modal");

    $(model).on('show', () => $('#form')[0].reset())

    $('#search').click(() => {
        SearchRecord();
    });

    //delete
    $("#table tbody").on('click', 'button.delete', function() {
        let record_id = $(this).attr("record_id");
        deleteRecord(record_id);

    });
    //update
    $("#table tbody").on('click', 'button.edit', function() {
        let record_id = $(this).attr("record_id");
        btn_action = 'update';
        fetchRecord(record_id);

    });

    //fill user
    fillStudent();

    function fillStudent() {

        let data = {
            "action": "fillStudent",
            "student_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/marks.php",
            data: data,
            dataType: "JSON",
            async: true,
            success: function(data) {
                let status = data.status;
                let message = data.message;
                let options = "";
                if (status) {
                    message.forEach((items, i) => {
                        options += `<option value = '${items['ID']}'>${items['Name']}</option>`
                    });


                    $('#students').html(options);
                }
            },
            error: function(data) {

            }
        })
    }

    //fill course
    fillCourse();

    function fillCourse() {

        let data = {
            "action": "fillCourse",
            "course_id": '',
        }

        $.ajax({
            method: "POST",
            url: "../api/marks.php",
            data: data,
            dataType: "JSON",
            async: true,
            success: function(data) {
                let status = data.status;
                let message = data.message;
                let options = "";
                if (status) {
                    message.forEach((items, i) => {
                        options += `<option value = '${items['ID']}'>${items['Name']}</option>`
                    });


                    $('#courses').html(options);
                }
            },
            error: function(data) {

            }
        })
    }

    //search 
    function SearchRecord() {
        $("#table tbody").html('');
        let student = $('#student').val();
        let course = $('#course').val();
        let semester = $('#sem').val();

        let data = {
            "action": "search",
            "student_id": student,
            "course_id": course,
            "semester": semester
        }
        $.ajax({
            method: "POST",
            url: "../api/marks.php",
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
                            if (items[index] == 'Re-Exam') {
                                tbody += `<td> <span class="badge bg-danger"> ${items[index]} </span></td>`;
                            } else {
                                tbody += `
                                <td> ${items[index]} </td>
                            `;
                            };

                        }
                        tbody += `
                        <td>
                            <button class="btn btn-sm btn-primary edit" record_id=${items['id']}><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete" record_id=${items['id']}><i class="fa fa-trash"></i></button>
                            
                        </td?
                        `;
                        tbody += '</tr>'
                    });

                    $('#table thead').html(thead);
                    $('#table tbody').html(tbody);
                    $('#table').DataTable();
                    // $('#table').DataTable().columns(0).visible(false);


                } else {
                    $('#table tbody').html('<h5 class="text-center"> No Data Found </h5>');
                }
            },
            error: function(data) {}

        })
    }


    //
    //fetch data
    function fetchRecord(record_id) {

        let data = {
            "action": "read",
            "record_id": record_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/marks.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                let status = data.status;
                let message = data.message[0];

                if (status) {
                    $('#record_id').val(message['id']);

                    $('#student_id').val(message['Student ID']);
                    $('#student_id').attr('readonly', true);

                    $('#course_id').val(message['Course ID']);
                    $('#course_id').attr('readonly', true);

                    $('#semester').val(message['Semester']);
                    $('#semester').attr('readonly', true);

                    $('#course_work').val(message['Course Work']);
                    $('#midterm').val(message['Midterm']);
                    $('#final').val(message['Final']);
                    $('#total').val(message['Total']);
                    $('#remark').val(message['Remark']);
                    $('#date').val(message['Registered Date']);


                }
                model.modal('show');
            },
            error: function(data) {

            }
        })
    }

    //delete
    function deleteRecord(record_id) {
        let data = {
            "action": "delete",
            "record_id": record_id,
        }

        $.ajax({
            method: "POST",
            url: "../api/marks.php",
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


                    SearchRecord();
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


    //submit
    //insert  
    $("#form").on('submit', (e) => {
        e.preventDefault();
        let record_id = $('#record_id').val();
        let student_id = $('#student_id').val();
        let course_id = $('#course_id').val();
        let semester = $('#semester').val();
        let course_work = $('#course_work').val();
        let midterm = $('#midterm').val();
        let final = $('#final').val();
        let total = $('#total').val();
        let remark = $('#remark').val();
        let date = $('#date').val();


        if (btn_action == 'insert') {
            var data = {
                "action": "insert",
                "record_id": record_id,
                "student_id": student_id,
                "course_id": course_id,
                "semester": semester,
                "course_work": course_work,
                "midterm": midterm,
                "final": final,
                "total": total,
                "remark": remark,
                "date": date
            };

        } else {
            var data = {
                "action": "update",
                "record_id": record_id,
                "student_id": student_id,
                "course_id": course_id,
                "semester": semester,
                "course_work": course_work,
                "midterm": midterm,
                "final": final,
                "total": total,
                "remark": remark,
                "date": date
            };
        }



        $.ajax({
            method: "POST",
            url: "../api/marks.php",
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

                    SearchRecord();

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
    });


    //import file

    $('#exel_file').change(function(e) {
        $('#import_exel').submit();
    });

    $('#import_exel').on('submit', (e) => {
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: "../api/import.php",
            data: new FormData(this),
            dataType: "JSON",
            async: true,

            success: function(data) {
                $('#result').html(data);
                $('#exel_file').val('');
            },
            error: function(data) {

            }
        });
    });
});