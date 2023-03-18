// localStorage.getItem()
var cook = localStorage.getItem('datas');
if(cook != null){
    window.location.href = "profile.html";
}

$(document).ready(function(){
    $("#login").click(function(){
        var username = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        alert(username)
        $.ajax({
            url: "./php/login.php",
            type: "POST",
            data: {email: username, password: password},
            // success: function(data){
            //     $("#message").html(data);
            // }
            success: function(response){
                var res = JSON.parse(response);
                alert(res.msg);

                if(res.msg === "success"){
                    // alert('success');
                    // window.location.href = "./profile.html";
                    var exp = (new Date(Date.now() + 86400 * 1000)).toUTCString();
                    localStorage.setItem('datas',username);
                    window.location.href="profile.html"
                    $("#message").html(data);
                }else{
                    // $("#error-message").html("Invalid Email or Password");
                    $("#message").html(data);
                }
            }
        });
    });
});


