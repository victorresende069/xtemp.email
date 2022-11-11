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

    $.post("api/", {user: user, pass: pass}).done(function(data) {
        alert('teste' + data);
    });


});