<html>
<head>
    <title></title>
    <style type="text/css">
        body {
        }
    </style>
    <link rel="stylesheet" type="text/css" href="aut/tautocomplete.css"/>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="aut/tautocomplete.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            var text2 = $("#Text2").tautocomplete({
                width: "500px",
                columns: ['Full Name', 'Email Address', 'Index Number'],
                //source:"search.php",
                data: function () {
                    try {
                        var data = [{"id": 1, "fullname": "Isaac Osafo", "email_address": "ikosafo@gmail.com", "indexnumber": "Kabul"}, {
                            "id": 2,
                            "fullname": "Albania",
                            "email_address": "ALB",
                            "indexnumber": "Tirane"
                        }, {"id": 3, "fullname": "Algeria", "email_address": "DZA", "indexnumber": "Algiers"}, {
                            "id": 4,
                            "fullname": "Andorra",
                            "email_address": "AND",
                            "indexnumber": "Andorra la Vella"
                        }, {"id": 5, "fullname": "Angola", "email_address": "AGO", "indexnumber": "Luanda"}, {
                            "id": 6,
                            "fullname": "Antigua and Barbuda",
                            "email_address": "ATG",
                            "indexnumber": "Saint John"
                        }, {"id": 194, "fullname": "Yemen", "email_address": "YEM", "indexnumber": "Sanaa"}, {
                            "id": 195,
                            "fullname": "Zambia",
                            "email_address": "ZMB",
                            "indexnumber": "Lusaka"
                        }, {"id": 196, "fullname": "Zimbabwe", "email_address": "ZMB", "indexnumber": "Harare"}];
                    }
                    catch (e) {
                        alert(e)
                    }
                    var filterData = [];

                    var searchData = eval("/" + text2.searchdata() + "/gi");

                    $.each(data, function (i, v) {
                        if (v.fullname.search(new RegExp(searchData)) != -1 
                            || v.email_address.search(new RegExp(searchData)) != -1
                            || v.indexnumber.search(new RegExp(searchData)) != -1
                        ) {
                            filterData.push(v);
                        }
                    });
                    return filterData;
                },
                onchange: function () {
                    $("#ta-txt").html(text2.text());
                    $("#ta-id").html(text2.id());
                    $("#ta-all").html(JSON.stringify(text2.all()));
                }
            });
        });
    </script>
</head>
<body><br/><br/><br/><br/><br/>

<div style="width: 100%; text-align:center;">
    <input type="text" id="Text2" style="width: 200px; font-size:1.2em;"/><br/><br/>
    Text: <span id="ta-txt"></span><br/>
    ID: <span id="ta-id"></span><br/>
    All: <span id="ta-all"></span><br/>
</div>
</body>
</html>