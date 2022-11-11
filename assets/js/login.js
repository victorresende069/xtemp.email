$("#submit").click(function() {

    let user = $("#user").val();
    let pass = $("#pass").val();

    if(user.length <= 2  || pass.length <= 2){
        $(".msgReturnUser").html('Usuário e Senha muito curto!');
        $(".msgReturnUser").css('color', '#8f0000');
        setTimeout(() => {
            $(".msgReturnUser").html('');
        }, 2000);
        return false;
    }

    let data = JSON.stringify({user: user, pass: pass});

    $.ajax({
        type: 'POST',
        url: 'api/',
        data: data,
        contentType: "application/json",
        dataType: 'json',
        success: function(data) { alert('data: ' + data); },
    });


    /*
    $.post("api/", data).done(function(data) {
        alert('teste' + data);


    }, "json");
    */
});