$(document).ready(function() {

    fillUsers();

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

                    $('#users').html(options);
                }
            },
            error: function(data) {

            }
        })
    }

    //
    function fetchUserRolls(user_id) {

        var data = {
            "action": 'fetchUserRolls',
            "user_id": user_id
        }

        $.ajax({

            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                var status = data.status;
                var message = data.message;
                $("#content_body input[type='checkbox']").prop("checked", false);
                if (status) {

                    message.forEach(function(item, i) {

                        console.log(message);
                        $("#content_body input[type='checkbox'][menu_id='" + item['menu_id'] + "']").prop("checked", true);

                    });

                } else {
                    console.log(message);
                }
            },
            error: function(data) {

            }
        });



    }


    //
    $("#content_body").on('change', "input[name='module[]']", function() {
        var value = $(this).val();

        if ($(this).is(":checked")) {
            $("#content_body input[type='checkbox'][module='" + value + "']").prop("checked", true);

        } else {
            $("#content_body input[type='checkbox'][module='" + value + "']").prop("checked", false);

        }
    });

    $("input[name='check_all']").on('change', function() {

        if ($(this).is(":checked")) {
            $("#content_body input[type='checkbox']").prop("checked", true);

        } else {
            $("#content_body input[type='checkbox']").prop("checked", false);

        }
    });

    $("#user_id").change(function() {
        var user_id = $(this).val();

        fetchUserRolls(user_id);
    });

    $("#form").on('submit', function(e) {
        e.preventDefault()

        var user_id = $("#user_id").val();
        var menu_id = [];

        $("input[name='submenu[]']").each(function() {

            if ($(this).is(":checked"))
                menu_id.push($(this).val())

        });

        var data = {
            "action": 'updateRolls',
            "menu_id": menu_id,
            "user_id": user_id,
        }

        $.ajax({

            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,

            success: function(data) {
                var status = data.status;
                var message = data.message;


                if (status) {

                    $("#form")[0].reset();
                    showAlert('success', message);

                } else {
                    showAlert('danger', message);
                }
            },
            error: function(data) {

            }
        });



    });

    load_authorities();

    function load_authorities() {
        $("#table tr").remove();

        var data = {
            "action": "readMenus",
            "id": "",
            "procedure": "user_menu_get",
        };

        $.ajax({
            method: "POST",
            url: "../api/users.php",
            data: data,
            dataType: "JSON",
            async: true,
            success: function(data) {
                var message = data.message;
                var status = data.status;
                var strHTML = '';
                var column = '';
                var currentModule = '';
                var menu = '';
                var currentMenu = '';

                if (status == true) {
                    // strHTML = '<div class="">';
                    message.forEach(function(item, i) {

                        //Print module if its not printed
                        if (currentModule != item['module']) {
                            strHTML += `</fieldset><fieldset class="col-md-2 m-3 pl-3 custom-checkbox" >`;
                            strHTML += `<legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="` + item['module'] + `"><input type="checkbox" class="custom-control-input" id="` + item['module'] + `" name="module[]" module="` + item['module'] + `" value="` + item['module'] + `">
                            <span class="custom-control-label">` + item['module'] + `</span></label></b></legend>`;
                            currentModule = item['module'];
                            strHTML += `<ul class="custom-control custom-checkbox" style="list-style-type:none">`;
                        }


                        if (currentMenu != item['menu']) {
                            strHTML += `<li><label class="custom-control custom-checkbox" for="` + item['menu_id'] + `"><input type="checkbox"  class="custom-control-input" id="` + item['menu_id'] + `" name="submenu[]" menu_id="` + item['menu_id'] + `" module="` + item['module'] + `" menu_id="` + item['menu_id'] + `" value="` + item['menu_id'] + `">
                                        <span class="custom-control-label">` + item['menu'] + `</span></label></li>`;
                            currentMenu = item['menu'];
                        }

                    });
                    // strHTML += '</div>';

                    $('#content_body').html(strHTML);
                    // $('#content_body').append(strHTML);
                } else {

                }

            },
            error: function(data) {

            }
        });

    }
});