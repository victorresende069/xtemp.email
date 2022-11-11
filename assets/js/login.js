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
        headers: {
            "HeaderViewFunction":"login"
        },
        success: function(data) {   
            //var obj = JSON.parse(data);
            if(data.status === 202){
                $(".msgReturnUser").html('Conectado com sucesso!');
                $('.msgReturnUser').css('color', '#17b506');
                setTimeout(() => {
                    window.location.href = '?tokenGet='+data.token;
                }, 2000);
            }
            else{
                $(".msgReturnUser").html(data.return);
                $(".msgReturnUser").css('color', '#8f0000');
                setTimeout(() => {
                    $(".msgReturnUser").html('');
                }, 3000);  
            }
     
    
        },
        error: function(data) {
      
        }

    });


    /*
    $.post("api/", data).done(function(data) {
        alert('teste' + data);


    }, "json");
    */
});