$(function (e) {
    // init: side menu for current page
    $('li#menu-companies').addClass('menu-open active');
    $('li#menu-companies').find('.treeview-menu').css('display', 'block');
    $('li#menu-companies').find('.treeview-menu').find('.edit-companies a').addClass('sub-menu-active');

    $('#company-form').validationEngine('attach', 
    {
        promptPosition : 'topLeft',
        scroll: true,
        'custom_error_messages' : 
        {
            '#image' : {
                'required': {
                    'message': "* Upload image (Recommeded file size 1280px x 720px. Maks. size 5 MB)"
                }
            }
        }
        // ,
        // ajaxFormValidation: true,
        // onAjaxFormComplete: ajaxValidationCallback,
        // onValidationComplete: ajaxValidationCallback,
        // onBeforeAjaxFormValidation: beforeCall,
       
    }
    );
    //xx
        // function beforeCall(form, options){
        // if (console) 
        //     console.log("Right before the AJAX form validation call");
        //     return true;
        // }

        // //// Called once the server replies to the ajax form validation request
        // function ajaxValidationCallback(status, form, json, options){
        //     //if (console) 
        //     console.log(status);
        //     if (status === true) {
        //     //check if all required field is valid
        //     form.validationEngine('detach');
            
        //     //trying to send the data using AJAX        
        //     // alert('kirim data')
        //     // e.preventDefault();
        //     var _data = $('#company-form').serialize(),
        //         company_data = new FormData($('#company-form')[0]);
        //         // img = $('#image')[0].files[0];

        //         // company_data.append('image', img);
            

        //     $.ajax({
        //         type: 'POST',
        //         url: rootUrl+'/companies/create',
        //         dataType: "JSON",
        //         data: $('#company-form').serialize(),
        //         success: function(response){
        //             console.log(response);
        //             alert('data saved');

        //         },
        //         error: function(response){
        //             console.log(response);
        //         }
        //     })
        //     }
        // }
    //
    // init: show tooltip on hover
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    
});

$('#image').on('change', function(evt) {
    var selectedImage = evt.currentTarget.files[0];
    var imageWrapper = document.querySelector('.company-image');
    var previewImg = document.createElement('img');
    imageWrapper.innerHTML = '';

    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;

    if (regex.test(selectedImage.name.toLowerCase())) {
        if (typeof(FileReader) != 'undefined') {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImg.id = 'new-selected-image';
                previewImg.src = e.target.result;
                imageWrapper.appendChild(previewImg);
                // var image = new Image();
                // image.src = previewImg.src;
                // image.onload = function(img){
                //     var width = img.width,
                //         height = this.height;
                //     if( width > 1280 || height > 720 || selectedImage.size > 5000000){
                        
                //         // $('.file_error').addClass('formError');
                //         // $(".formErrorContent").html("Image dimension more than 1280px x 720px or image size exceed 5 MB");
                //         return false;
                //     }
                // }
            }
            reader.readAsDataURL(selectedImage);
        } else {
            console.log('browser support issue');
        }
    } 
    else {
        $(this).prop('value', null);
        console.log('Please select and image file');
    }

});   

$('#search').click(function (e) {
    e.preventDefault();

    var postcode = $('#postcode').val();

    if (postcode === null || postcode == '' || postcode === 'undefined') {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Please Input Postcode',
            text: 'Make sure the data given is valid',
            showConfirmButton: false,
            timer: 2000
        });
        return false;
    }

    $.ajax({
        method: 'get',
        type: 'post',
        url: rootUrl + '/companies/' + postcode,
        dataType: 'json',
        success: function (data) {
            // console.info(data);

            if (data != '') {
                $("#local").val(data[0]['local']);
                $("#city").val(data[0]['city']);
                $('#prefecture_id option[value="' + data[0]['prefecture']['id'] + '"]').prop('selected', true);

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Data has been filled',
                    text: 'Postcode is valid and related field has been filled',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                // console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Postcode Not Found',
                    text: 'Please input a valid postcode',

                    showConfirmButton: false,
                    timer: 1500
                });
            }


        },
        error: function (data) {
            console.log(data);
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Oopss... Something went wrong',
                text: 'Failed to get postcode data',
                showConfirmButton: false,
                timer: 1500
            });
        }

    });


})

// $('#company-form').on('click', function(e){
//     if(!e.preventDefault()){
//         alert('kirim data')
//     }
// });
