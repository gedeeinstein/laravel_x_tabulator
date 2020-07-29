$(function () {

    // init: side menu for current page
    $('li#menu-users').addClass('menu-open active');
    $('li#menu-users').find('.treeview-menu').css('display', 'block');
    $('li#menu-users').find('.treeview-menu').find('.list-users a').addClass('sub-menu-active');

    // call tabulator function and create tables
    const TRIANGLE_IMAGE_FOR_FILTER = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAJCAYAAAA/33wPAAAAvklEQVQoFY2QMQqEMBBFv7ERa/EMXkGw11K8QbDXzuN4BHv7QO6ifUgj7v4UAdlVM8Uwf+b9YZJISnlqrfEUZVlinucnBGKaJgghbiHOyLyFKIoCbdvecpyReYvo/Ma2bajrGtbaC58kCdZ1RZ7nl/4/4d5EsO/7nzl7IUtodBexMMagaRrs+06JLMvcNWmaOv2W/C/TMAyD58dxROgSmvxFFMdxoOs6lliWBXEcuzokXRbRoJRyvqqqQvye+QDMDz1D6yuj9wAAAABJRU5ErkJggg==';

    var editorStyles = {
        "padding": "4px",
        "width": "100%",
        "box-sizing": "border-box",
        "-webkit-appearance": "none",
        "background-color": "white",
        "background-image": "url(" + TRIANGLE_IMAGE_FOR_FILTER + ")",
        "background-position": "right center",
        "background-repeat": "no-repeat",
        "padding-right": "1.5em",
        "border": "solid 1px #ccc",
        "border-radius": "0",
    };

    // Formatter for edit/delete
    var formatActionField = function (row, cell, formatterParams) {
        return '<form id="form-delete-' + row.getData()['id'] + '" action="' + rootUrl + '/admin/delete/" method="get">' +
               '<a class="btn btn-primary" href="' + rootUrl + '/admin/edit/' + row.getData()['id'] + '" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;' +
               '<input type="hidden" name="id" value="' + row.getData()['id'] + '">' +
               '<input type="hidden" name="delete_flag" value="1">' +
               '<span onclick="javascript:if(confirm(\'Are you sure want to delete this Data？\')) { document.getElementById(\'form-delete-' + row.getData()['id'] + '\').submit(); } return false;" class="btn btn-warning btn-delete" title="削除"><i class="fa fa-trash"></i></span>' +
               '</form>';
    }; // Formatter for edit/delete

    // call tabulator function and create tables
    $("#datalist").tabulator({
        layout: "fitColumns",
        placeholder: "There is not Data",
        responsiveLayout: false,
        resizableColumns: true,
        pagination: "local",
        paginationSize: 20,
        langs:{
            "ja-jp":{
                "pagination":{
                    "first":"<<",
                    "first_title":"First Page",
                    "last":">>",
                    "last_title":"Last Page",
                    "prev":"<",
                    "prev_title":"Prev Page",
                    "next":">",
                    "next_title":"Next Page",
                },
            },
        },
        columns: [
            {title: "ID", field: "id", width: 45, headerFilter: "input", sorter: "number", headerFilterPlaceholder: " "},
            {title: "Username", field: "username", minwidth: 200, headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "Name", field: "display_name", width: 150, headerFilter: "input", headerFilterPlaceholder: " "},
			      {title: "Created At", field: "created_at", width: 150, headerFilter:"input", headerFilterPlaceholder: " "},
            {title: "Updated At", field: "updated_at", width: 150, headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "Action", field: "action", align: "center", headerFilter: false, width: 100, formatter: formatActionField, headerFilterPlaceholder: " ", headerSort: false, frozen: true}
        ],
        dataLoaded: function (data) {
            redrawTabulator();
        },
        columnResized: function (column) {
            // none
        },
        pageLoaded: function (pageno) {
            setTimeout(function () {
                // display datalist information : Showing xx to yy of zz entries
                var totalData = $('#total-data').val();
                var pageSize = $("#datalist").tabulator("getPageSize");
                var dataMin = ((pageno * pageSize) + 1) - pageSize;
                var dataMax = pageno * pageSize;
                if (totalData < dataMax) {
                    dataMax = totalData;
                }
                $('#datalist-min-data').html(dataMin);
                $('#datalist-max-data').html(dataMax);
            }, 1200);
        },
        dataFiltered:function(filters, rows){
            redrawTabulator();
        }
    });

    $('#datalist').tabulator('setData', rootUrl + '/api/admin/users/getUsersTabular');
    $('#datalist').tabulator('setLocale', 'ja-jp');

    $(window).resize(function(){
       redrawTabulator();
    });

    $('.sidebar-toggle').click(function() {
        redrawTabulator();
    });
});
// switch the style of column show/hide toggle modal panel
function switchAppearanceTabulatorColFilter() {
    var windowsize = $(window).width();
    if(windowsize > 767) {
        $('.modal-col-tabulator-content').css({
            'left' : $("#btn-col-tabulator").offset().left - 550 + 140,
            'top' : $("#btn-col-tabulator").offset().top + 10,
        });
    } else {
        $('.modal-col-tabulator-content').removeAttr("style");
    }
}
// redraw tabulator column
function redrawTabulator() {
    setTimeout(function() {
        $('#datalist').tabulator('redraw', true);
        PageDataInfo();

    }, 300);
}

function PageDataInfo(data){
    var getDataCount = $("#datalist").tabulator("getDataCount");
    var getPage      = $("#datalist").tabulator("getPage");
    var getPageSize  = $("#datalist").tabulator("getPageSize");
    var getPageMax   = $("#datalist").tabulator("getPageMax");

    $('#datalist-total-data').html(getDataCount);
    $('#total-data').val(getDataCount);

    if(getDataCount < getPageSize) {
        getPageSize = getDataCount;
    }

    $('#datalist-max-data').html(getPageSize);


    if(getPageSize == 0) {
        $('#datalist-min-data').html(0);
    } else {
        $('#datalist-min-data').html(1);
    }

    if(getDataCount > 0 ){
        $('#datalist-header').removeClass('invisible');
    }else{
        $('#datalist-header').addClass('invisible');
    }
}
