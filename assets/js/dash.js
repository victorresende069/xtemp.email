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
            
        },
        error: function (){

        }

    });
})


document.querySelector('#mails').addEventListener('change', function(){
    var mail = document.getElementById('mails').value
    alert(mail);
});