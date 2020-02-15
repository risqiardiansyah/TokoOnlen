 // $("#btn-add").click(function (e) {
 //        $.ajaxSetup({
 //            headers: {
 //                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
 //            }
 //        });
 //        e.preventDefault();
 //        var formData = {
 //            url: jQuery('#link').val(),
 //            description: jQuery('#description').val(),
 //        };
 //        var state = jQuery('#btn-add').val();
 //        var type = "POST";
 //        // var link_id = jQuery('#link_id').val();
 //        var ajaxurl = "{{route('ajax-crud.add_cart'}}";
 //        $.ajax({
 //            type: type,
 //            url: ajaxurl,
 //            data: formData,
 //            dataType: 'json',
 //            success: function (data) {
 //                var link = '<tr id="link' + data.id + '"><td>' + data.id + '</td><td>' + data.url + '</td><td>' + data.description + '</td>';
 //                link += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
 //                link += '<button class="btn btn-danger delete-link" value="' + data.id + '">Delete</button></td></tr>';
 //                if (state == "add") {
 //                    jQuery('#links-list').append(link);
 //                } else {
 //                    $("#link" + link_id).replaceWith(link);
 //                }
 //                jQuery('#modalFormData').trigger("reset");
 //                jQuery('#linkEditorModal').modal('hide')
 //            },
 //            error: function (data) {
 //                console.log('Error:', data);
 //            }
 //        });
 //    });

$(document).ready(function(){
    $('#btn-add').on('submit', function(event){
        event.preventDefault();

        $.ajax({
            url: "{{route('ajax-crud.add_cart')}}",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cached: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                var html = '';
                if (data.errors) {
                    html += '<div class="alert alert-danger">';
                        for (var i = 0; i < data.errors.length; i++) {
                            html += '<p> '+ data.errors[count] +' </p>';
                        }
                    html += '</div>';
                }
                if (data.success) {
                    html += '<div class="alert alert-success">'+ data.success +'</div>';
                    location.href = "{{url('/blog')}}";
                }
                $('form_result').html(html);
            }
        })
    })
});