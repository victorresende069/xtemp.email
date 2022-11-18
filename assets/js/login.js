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
            "HeaderFunction":"login"
        },
        success: function(data) {   
            //var obj = JSON.parse(data);
            if(data.status === 202){
                $(".msgReturnUser").html('Conectado com sucesso!');
                $('.msgReturnUser').css('color', '#3fff00');
                setTimeout(() => {
                    window.location.href = '?tokenGet='+data.token;
                }, 2000);
            }
            else{
                $(".msgReturnUser").html(data.return);
                $(".msgReturnUser").css('color', 'white');
                setTimeout(() => {
                    $(".msgReturnUser").html('');
                }, 3000);  
            }
     
    
        },
        error: function(data) {
      
        }

    });

});


$('#register').click(() => {
    $('#form').html(`
                <h1 class="h1Form">Criar uma Conta</h1>
                <div class="formInput">
                    <label>Nome:</label>
                    <input id="name" class="userInput Inputs" type="text" placeholder="Fulano de Tal">
                </div>

                <div class="formInput">
                    <label>Usuário:</label>
                    <input id="user" class="passInput Inputs" type="text" placeholder="fulano123">
                </div>


                <div class="formInput">
                    <label>Senha:</label>
                    <input id="pass" class="passInput Inputs" type="password" placeholder="**********">
                </div>

                
                <div class="formInput">
                    <label>E-mail:</label>
                    <input id="email" class="passInput Inputs" type="text" placeholder="fulano@email.com">
                </div>

                <div class="msgReturnUser" style="margin-top: 20px;"></div>

                <div class="formSubmit">
                    <button onclick="createUse();" id="createUser" class="createUser btnUser Inputs" type="submit">Criar</button>
                </div>

                <div class="formSubmit Register">
                        <button onclick="window.location.reload();":class="btnUser Inputs" type="submit">Voltar</button>
                    </div>
                </div>
    `);

});

function createUse() {
    let name = $("#name").val();
    let user = $("#user").val();
    let pass = $("#pass").val();
    let email = $("#email").val();
    $("#name").prop('disabled', true);
    $("#user").prop('disabled', true);
    $("#pass").prop('disabled', true);
    $("#email").prop('disabled', true);
    $(".createUser").prop('disabled', true);

    let data = JSON.stringify({user: user, pass: pass, name: name, email: email});

    if(user.length <= 3  || pass.length <= 3 || email.length <= 10 || name.length <= 5){
        $(".msgReturnUser").html('Informações curta, por favor preencha  todos os campos , minimo 5 caracteres.');
        $(".msgReturnUser").css('color', 'white');

        setTimeout(() => {
            $(".msgReturnUser").html('');
            $("#name").prop('disabled', false);
            $("#user").prop('disabled', false);
            $("#pass").prop('disabled', false);
            $("#email").prop('disabled', false);
            $(".createUser").prop('disabled', false);
        }, 4000);
        return false;
    }
    else{

        $.ajax({
            type: 'POST',
            url: 'api/',
            data: data,
            contentType: "application/json",
            dataType: 'json',
            headers: {
                "HeaderFunction":"register"
            },
            success: function(data) {   

                if(data.status){
                    $(".msgReturnUser").html(data.msg);
                    $('.msgReturnUser').css('color', '#3fff00');
                    setTimeout(() => {
                        window.location.href = '?tokenGet='+data.token;
                    }, 2000);
                }
                else{
                    $(".msgReturnUser").html(data.msg);
                    $(".msgReturnUser").css('color', 'white');
                    setTimeout(() => {
                        $(".msgReturnUser").html('');
                        $(".msgReturnUser").html('');
                        $("#name").prop('disabled', false);
                        $("#user").prop('disabled', false);
                        $("#pass").prop('disabled', false);
                        $("#email").prop('disabled', false);
                        $(".createUser").prop('disabled', false);
                    }, 3000);
                }

            },
            error: function(data) {
                
             
            }
    
        });
    

    }


}