const logout = () =>{
    localStorage.removeItem('datas');
    window.location.replace('http://localhost:8080/guvi/login.html');
}


$(document).ready(function(){
    $('form').submit(function(event){
        event.preventDefault();
       
        var formData = $('form').serialize();
        $.ajax({
            type: 'POST',
            url: './php/register.php',
            data: formData,
            success: function(data){
                if(data.trim() === "User registered successfully in database."){
                            window.location.href = "login.html";


                }else{
                    $("#message").html(data);
                }
            }
            
        });
    });
});
