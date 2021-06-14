<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />


<style>
    #project-label {
        display: block;
        font-weight: bold;
        margin-bottom: 1em;
    }

    #project-icon {
        float: left;
        height: 32px;
        width: 32px;
    }

    #project-description {
        margin: 0;
        padding: 0;
    }

</style>


<div id="project-label">Select a project (type "s" for a start):</div>
<input id="project">
<input type="hidden" id="project-id">
<p id="project-description"></p>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

<script>
    $(function() {
        //random json values
        var projects = "search.php";

        $.widget("custom.tablecomplete", $.ui.autocomplete, {
            _create: function() {
                this._super();
                this.widget().menu("option", "items", "> tr:not(.ui-autocomplete-header)");
            },
            _renderMenu(ul, items) {
            var self = this;
            //table definitions
            var $t = $("<table class='table table-responsive'>", {
                border: 1
            }).appendTo(ul);
            $t.append($("<thead>"));
            $t.find("thead").append($("<tr>", {
                class: "ui-autocomplete-header"
            }));
            var $row = $t.find("tr");
            $("<th>").html("ID#").appendTo($row);
            $("<th>").html("Name").appendTo($row);
            $("<th>").html("Cool Point").appendTo($row);
            $("<tbody>").appendTo($t);
            $.each(items, function(index, item) {
                self._renderItemData(ul, $t.find("tbody"), item);
            });
        },
        _renderItemData(ul, table, item) {
            return this._renderItem(table, item).data("ui-autocomplete-item", item);
        },
        _renderItem(table, item) {
            var $row = $("<tr>", {
                class: "ui-menu-item",
                role: "presentation"
            })
            $("<td>").html(item.id).appendTo($row);
            $("<td>").html(item.value).appendTo($row);
            $("<td>").html(item.cp).appendTo($row);
            return $row.appendTo(table);
        }
    });

    function _doFocusStuff(event, ui) {
        if (ui.item) {
            console.log(ui.item);
            var $item = ui.item;
            $("#project").val($item.value);
            $("#project-id").val($item.id);
            $("#project-description").html($item.cp);
        }

        return false;
    }

    // create the autocomplete
    var autocomplete = $("#project").tablecomplete({
        minLength: 1,
        source: projects,
        focus: _doFocusStuff
    });

    // get a handle on it's UI view
    var autocomplete_handle = autocomplete.data("ui-autocomplete");
    });

</script>