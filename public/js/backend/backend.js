$(function () {
    //datepicker
    if ($('.isDatepicker').length > 0) {
        $('.isDatepicker').datepicker({
            language: 'ja',
            format: 'yyyy/mm/dd',
            autoclose: true
        });
    }

    //timepicker
    if ($('.isTimepicker').length > 0) {
        $('.isTimepicker').timepicker({
            language: 'ja',
            format: 'HH:mm',
            autoclose: true,
            minuteStep: 60,
            showMeridian: false
        });
    }

    //tabulator
    setTimeout(function () {
        if ($('.tabulator').length > 0) {
            if ($('.tabulator-placeholder').html() == "<span>データがありません</span>") {
                $('.tabulator-placeholder').css({"padding": "20px", "border-bottom": "1px solid #ddd"});
            }
        }
    }, 300);
});
