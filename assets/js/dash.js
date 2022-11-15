
bodyMailsList();

$('.perfilMail').click(()=>{
    
    $.ajax({
        type: 'POST',
        url: 'api/',
        contentType: 'application/json',
        dataType: 'json',
        headers: {
            'HeaderFunction':'profileMail'
        },
        success: function (data) {

            if(data.status){
                $('.inboxMail').html(`
                
                        <div>
                                <div class="inboxProfile">

                                    <label style="margin-top: 20px;">Nome</label>
                                    <input value="`+data.name+`" type="text" id="ProfileName" class="ProfileName" />
                                    
                                    <label style="margin-top: 20px;">Usuário</label>
                                    <input value="`+data.user+`"  type="text" id="ProfileUser" class="ProfileUser" disabled/>

                                    <label style="margin-top: 20px;">Email</label>
                                    <input value="`+data.email+`"  type="email" id="ProfileMail" class="ProfileMail" />

                                    <label style="margin-top: 20px;">Senha</label>
                                    <input value="`+data.senha+`"  type="password" id="ProfilePassword" class="ProfilePassword" />

                                    <input value="`+data.id+`"  type="hidden" id="ProfileID" class="ProfileID" />

                                    <div class="editProfile">
                                        <button onclick="editProfile();">Editar</button>
                                    </div>

                                </div>
                        <div>

                `);
            }
            else{

            }

        },
        error: function (){}
    })
});

$('.boxMail').click(()=>{
    $('.inboxMail').html('');
    var mail = $('#mails').val();
    let data = JSON.stringify({mail: mail});
    $.ajax({
        type: 'POST',
        url: 'api/',
        data: data,
        contentType: 'application/json',
        dataType: 'json',
        headers: {
            'HeaderFunction':'inboxMail'
        },
        success: function (data) {
            
            if(data == null || data == undefined || data == []){
                alert('Error: Invalid data email');
            }
            else{

                data.forEach(function(element, id) {
                    $('.inboxMail').append(`
                    <div class="Mail1">
                        <h2 class="tituloMail">`+element.subject+`</h2>
                            <p>`+element.from+` </p>
                                <div class="actionMail">
                                    <a onclick="deleteMailBox('`+element.path+`');"; style="color: red;">Deletar</a>
                                    <a onclick="viewMailBox('`+id+`');"; style="color: green;">Mostrar</a>
                                </div>
                    </div>
                    `);
                    
                });
            }

        },
        error: function (){

        }

    });
})

$('.sairMail').click(()=>{
    window.location.href = './?deslogar=true';
});


$('#addMail').click(()=>{
    $('.inboxMail').html('');
        $.ajax({
            type: 'POST',
            url: 'api/',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'HeaderFunction':'addMail'
            },
            success: function (data) {

                if(data.status){
                                    $('.inboxMail').html(`  
                                    <div>
                                        <div class="inboxAddMail">

                                            <label style="margin-top: 20px;">Nome</label>
                                            <input  type="text" id="userName" class="inputaddMail" />
                                            
                                            <label style="margin-top: 20px;">Usuário</label>
                                            <input  type="text" id="userMail" class="inputaddMail" />
                            
                                            <label style="margin-top: 20px;">Email/Domínio</label>
                                            <select class="selectMail" id="domainMail">

                                            </select>
                            
                                            <div class="textaddMail">
                                                    <label>Emails Criado:</label>
                                                    <span>`+data.emailUsed+`/<b>`+data.maxMail+`</b>
                                                    </span>
                                            </div>
                            
                                            <div class="addMail">
                                                <button onclick="createMail();">Criar</button>
                                            </div>

                                        </div>
                                    <div>
                                `);
                                $('#domainMail').append(data.domainMails); 
                }
                else{
                    $('.inboxMail').html(data.return);
                }
                
            },
            error: function (){

            }
        });
});


$('#delMail').click(()=>{
        var mail = $('#mails').val();
        let data = JSON.stringify({mail: mail});
        $('.inboxMail').html('');

        if (confirm('Você realmente quer deletar este Email "'+mail+'"')) {
                $.ajax({
                        type: 'POST',
                        url: 'api/',
                        data: data,
                        contentType: 'application/json',
                        dataType: 'json',
                        headers: {
                            'HeaderFunction':'delMail'
                        },
                        success: function (data) {
                            if(data.status){
                                alert(data.msg);
                                window.location.reload();
                            }
                            else{
                                alert(data.msg);
                                window.location.reload();
                            }
                        },
                        error: function(){

                        }
                })
           
          } else {
            
          }
    
});


document.querySelector('#mails').addEventListener('change', function(){
    var mail = document.getElementById('mails').value
});







function bodyMailsList() {
    $.ajax({
        type: 'POST',
        url: 'api/',
        contentType: 'application/json',
        dataType: 'json',
        headers: {
            'HeaderFunction':'listMail'
        },
        success: function (data) {
            if(data.status){
                for (let i = 1; i < data.listMails.length; i++) {
                    $('#mails').append(`<option value="`+data.listMails[i]+`">`+data.listMails[i]+`</option>`); 
                }
            }
            else{
                alert(data.return);
            }
        },
        error: function (){}
    })
}

function createMail() {
    var domainMail = $('#domainMail').val();
    var user = $('#userMail').val();
    var name = $('#userName').val();
    let data = JSON.stringify({domain: domainMail, name: name, user: user, create: true});
    $.ajax({
        type: 'POST',
        url: 'api/',
        data: data,
        contentType: 'application/json',
        dataType: 'json',
        headers: {
            'HeaderFunction':'addMail'
        },
        success: function (data) {
            if(data.status){
                alert(data.msg);
                window.location.reload();
            }
            else{
                alert(data.msg);
            }

        },
        error: function (){

        }
    })
}

function deleteMailBox(path) {
        let data = JSON.stringify({path: path, delete: true});
        $.ajax({
            type: 'POST',
            url: 'api/',
            data: data,
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'HeaderFunction':'inboxMail'
            },
            success: function (data) {
                if(data.status){
                    alert(data.msg);
                    window.location.reload();
                }
                else{
                    alert(data.msg);
                }
            },
            error: function (){}
        })
}


function viewMailBox(id) {
    var mail = $('#mails').val();
    let data = JSON.stringify({id: id, mail:mail, view: true});
        $.ajax({
            type: 'POST',
            url: 'api/',
            data: data,
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'HeaderFunction':'inboxMail'
            },
            success: function (data) {
                $('.inboxMail').html(`
                    <div class="inboxOpen" style="display: block;">
                        <div class="inboxContainerOpen">
                                    <h1>`+data.subject+`</h1>
                                    <p>`+data.from+`</p>
                                    `+data.html+`
                        </div>  
                    </div>  
                    `);
            },
            error: function (){

            }
        })
    
}

function editProfile() {
    var id = $('#ProfileID').val();
    var name = $('#ProfileName').val();
    var mail = $('#ProfileMail').val();
    var password = $('#ProfilePassword').val();

    let data = JSON.stringify({id: id, name: name, mail:mail, password: password, edit: true});
        $.ajax({
            type: 'POST',
            url: 'api/',
            data: data,
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'HeaderFunction':'profileMail'
            },
            success: function (data) {
                if(data.status){
                    alert(data.msg);
                    window.location.reload();
                }
                else{
                    alert(data.msg);
                }
            },
            error: function (){

            }
        })
    
}  
