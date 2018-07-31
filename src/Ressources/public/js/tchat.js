var Tchat = 
{
    init: function()
    {
        $('#tchatform').submit(function(e){
           e.preventDefault();
           var msg = $('#textmsg').val();
           var id  =  $('#user_id').val();
           $.post("/tchat/web/?c=main&act=addmsg", 
                {
                    msg: msg,
                    user_id: id
                }, 
                function(result)
                {
                    $("#message").append(msg+'<br>');
                    $('#textmsg').val('');
                });    
        });
    }
}