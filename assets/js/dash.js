
bodyMailsList();

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
                                            <label>Usuário</label>
                                            <input  type="text" id="userMail" class="inputaddMail" />
                            
                                            <label style="margin-top: 20px;">Email/Domínio</label>
                                            <select class="selectMail" id="domainMail">
                                                <option>@xtemp.email</option>
                                                <option>@meuxtemp.live</option>
                                            </select>
                            
                                            <div class="textaddMail">
                                                    <label>Emails Criado:</label>
                                                    <span>`+data.emailUsed+`/<b>`+data.maxMail+`
                                                    </b>
                                                    </span>
                                            </div>
                            
                                            <div class="addMail">
                                                <button class="btnaddMail" id="createMail">Criar</button>
                                            </div>
                            
                            
                                        </div>
                                    <div>
                                `);
                }
                else{

                }
                
            },
            error: function (){

            }
        });

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
        success: function (array) {
            for (let i = 1; i < array.listMails.length; i++) {
                const element = array[i];
                console.log(array.listMails[i]);
                $('#mails').append(`<option value="`+array.listMails[i]+`">`+array.listMails[i]+`</option>`); 
            }
        },
        error: function (){}
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