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


document.querySelector('#mails').addEventListener('change', function(){
    var mail = document.getElementById('mails').value
});



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