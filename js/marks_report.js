$(document).ready(() => {

    $('#search').click(() => {
        SearchRecord();
    });




    //search 
    function SearchRecord() {
        $("#table tbody").html('');
        let classroom = $('#class').val();
        let semester = $('#sem').val();

        let data = {
            "action": "search",
            "classroom": classroom,
            "semester": semester
        }

        $.ajax({
            method: "POST",
            url: "../api/marks_report.php",
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
                        };
                        thead += '</tr>';

                        tbody += '<tr>';
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
                        tbody += '</tr>'
                    });

                    $('#table thead').html(thead);
                    $('#table tbody').html(tbody);
                    $('#table').DataTable();
                    // $('#table').DataTable().columns(0).visible(false);


                } else {
                    $('#table tbody').html(`<h5 class="text-center">${message}</h5>`);
                }
            },
            error: function(data) {}

        })
    }


});