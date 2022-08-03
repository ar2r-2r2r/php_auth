$(document).ready(function(){
    $('button.regSend').on('click', function(e){                     //нажата кнопка регистрации
        e.preventDefault();
        let login=$('input[name="login"]').val(),
            name=$('input[name="name"]').val(),
            email=$('input[name="email"]').val(),
            password=$('input[name="password"]').val(),
            password2=$('input[name="password2"]').val()

        $.ajax({
            url:'registerPost.php',
            type:'POST',
            dataType:'json',
            data:{
                login:login,
                name:name,
                email:email,
                password:password,
                password2:password2,
            },
            success:function (data){
                console.log(data);
                $("div#mail").html(data);
            }
        });
    });

    $('button.logSend').on('click', function (e) {
            e.preventDefault();
            let login=$('input[name="login"]').val(),
                password=$('input[name="password"]').val()

            $.ajax({
                url:'loginPost.php',
                type:'POST',
                dataType:'json',
                data:{
                    login:login,
                    password:password
                },
                success:function (data){
                    console.log(data);
                    $("div#ack").html(data);
                }
            });
        });

});
