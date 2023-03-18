$(document).ready(function() {


    const email = localStorage.getItem('datas');

    $.ajax({
        method: 'GET',
        url: './php/profile.php',
        dataType:'json',
        data:{
            email:email
        },
        success: function(res) {
            var html = '';
            $.each(res, function(key, value) {
              html += '<div class="data">';
              html += '<p>Name: ' + value.update_name + '</p>';
              html += '<p>Email: ' + value.update_email + '</p>';
              html += '<p>address: ' + value.address + '</p>';
              html += '<p>dob: ' + value.dob + '</p>';
              html += '<p>Contact: ' + value.phoneno + '</p>';
              html += '</div>';
            });
            $('#data-container').html(html);


        },
        error: function(res)
        {
                alert("Something went wrong in front end");
        }
    });
});
