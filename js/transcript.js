$(document).ready(() => {

    $('#search').click(() => {
        let student_id = $('#student').val();
        read(student_id);
    });


    function read(student_id) {
        data = {
            'action': 'read',
            'student_id': student_id
        }


        $.ajax({
            type: "POST",
            url: "../api/transcript.php",
            data: data,
            dataType: "JSON",

            success: function(data) {
                let status = data.status;
                let message = data.message;
                let div = `
                    <div class="col-6 m-2">
                        <h5 class="bg-primary p-2 text-white">Smester ${message[0]['semester']}</h5>
                        <table class="table">
                        <thead>
                            <th>Course</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                `;


                if (status) {
                    message.forEach(row => {
                        div += `
                            <tr>
                                <td>${row['course_name']}</td>
                                <td>${row['total']}</td>
                            </tr>
                        `;
                    })
                }

                div += `
                    </tbody>
                    </table>
                    </div>
                `;

                $('#transcript').html(div);
            }
        });
    }


    //fill
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


});