</div>

<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2022 &copy; Musdhafa Abubakar</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">JTech</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendors/jquery/jquery.min.js"></script>

<script src="../assets/js/mazer.js"></script>

<script>
    load_menu();

    function load_menu() {
        $.ajax({
            method: "POST",
            url: "../api/menus.php",
            data: {
                "action": "load_nav"
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var strHTML = '';
                var modules = '';

                if (status) {

                    strHTML += `<li class="">`;
                    message.forEach(function(item, i) {

                        if (modules != item['module']) {
                            if (modules != '') {
                                strHTML += `</ul></li><li class="">`;
                            }

                            strHTML +=
                                `
                                <a class="has-arrow" href="javascript:void()" module="` + item['module'] + `" aria-expanded="false">
                                    <i class="icon-grid menu-icon"></i><span class="nav-text">` + item['module'] + `</span>
                                </a>
                                <ul aria-expanded="false" class="collapse" style="height: 0px;">                           
                            `;

                            modules = item['module'];
                        }

                        strHTML += `  
                        <li><a href="` + item['link'] + `" module="` + item['module'] + `">` + item['menu'] + `</a></li>

                        `;

                    });
                    strHTML += '</li>';

                    $("#menu").html(strHTML);


                }


            },
            error: function(data) {

            }
        });

    }

    $(function() {
        for (var nk = window.location,
                o = $("ul#menu a").filter(function() {
                    return this.href == nk;
                })
                .addClass("active")
                .parent()
                .addClass("active");;) {
            if (!o.is("li")) break;
            o = o.parent()
                .addClass("in")
                .parent()
                .addClass("active");
        }
    });
</script>
</body>

</html>