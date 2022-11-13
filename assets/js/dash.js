$('.boxMail').click(()=>{
    $('.inboxMail').html('');
    var mail = $('').val();

    $.ajax({
        type: 'POST',
        url: 'api/',
        data: '',
        contentType: 'application/json',
        dataType: 'json',
        Headers: {
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