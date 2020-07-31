$(function () {
    // init: side menu for current page
    $('li#menu-companies').addClass('menu-open active');
    $('li#menu-companies').find('.treeview-menu').css('display', 'block');
    $('li#menu-companies').find('.treeview-menu').find('.edit-companies a').addClass('sub-menu-active');

    $('#company-form').validationEngine('attach', {
        promptPosition : 'topLeft',
        scroll: false
    });

    // init: show tooltip on hover
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    
});


// function validate() {
// 	$("#image").html("");
// 	var file  = $('#image')[0].files[0];
//     var file_size = $('#image')[0].files[0].size;
//     var height = $('#image')[0].files[0].height;
    
// 	if(file_size>5000000) {
// 		$(".file_error").html("File size is greater than 5MB");
// 		return false;
// 	} 
// 	return true;
// }


$('#image').on('change', function(evt) {

    // validate();
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

            var image = new Image();
            image.src = e.target.result;
            image.onload = function(){
                var height = this.height;
                var width = this.width;
                var size = this.size;

                // if((height >= 1280 || height <= 1100) && (width >= 750 || width <= 800)){
                //     $(".file_error").html("Image maximum resolution is 1280px x 720px. And max size 5MB ");
                //     return false;
                // }
                // if(Math.round(size / (2048*2048)) > 5){
                //     $(".file_error").html("Your images more than 5MB");
                //     return false;
                    
                // }
                // else{
                //     $(".file_error").html('')
                // }
                // return true;
            }
        }
            //
        reader.readAsDataURL(selectedImage);

        if(selectedImage.size > 5000000){
            $('.file_error').addClass('formError formErrorContent');
            $(".file_error").html("Image maximum resolution is 1280px x 720px. And max size 5MB ");
            return false;

        }

        } else {
        
        console.log('browser support issue');
        }
    } else {
        
        $(this).prop('value', null);
        console.log('please select and image file');
    }

});   

$('#search').click(function (e){
    e.preventDefault();

    var postcode = $('#postcode').val();
    var selectedPrefecture = $('#prefecture_id').find('option:selected');


    if(postcode === null || postcode == '' || postcode === 'undefined' ){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'No Data Found',
            text: 'Make sure the data given is valid',
            showConfirmButton: false,
            timer: 2500
          });
          return false;
    }

    $.ajax({
        method: 'get',
        type: 'post',
        url: rootUrl + '/companies/'+ postcode,
        dataType: 'json',
        success: function(data){

            console.info(data);

            $("#local").val(data[0]['local']);
            $("#city").val(data[0]['city']);
            $('#prefecture_id option[value="'+data[0]['prefecture']['id']+'"]').prop('selected', true);


            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data has been filled',
                text: 'Postcode is valid and related field has been filled',
                showConfirmButton: false,
                timer: 1500
              });
        },
        error: function(data){
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

    })

    // $.get(rootUrl + '/companies/'+ postcode, function(data,status){

    //     console.log(data,status);
    //     if(status === 'success'){

    //         // var  obj = jQuery.parseJSON(data);
    //         $("#local").val(data.local);
    //         $("#city").val(data.city);

    //         Swal.fire({
    //             position: 'center',
    //             icon: 'success',
    //             title: 'Data has been filled',
    //             text: 'Postcode is valid and related field has been filled',
    //             showConfirmButton: false,
    //             timer: 2500
    //           });
    //     }else{

    //     }

    // })
    


})
