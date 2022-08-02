$(document).ready(function(){
    $('button.regSend').on('click', function(){                     //нажата кнопка регистрации
        $.post("registerPost.php",
            $("#regForm :input").serializeArray(),
            function (data){
                answer=JSON.parse(data);
                console.log(answer);
                $("div#mail").html(answer);
            });

        $("#regForm").submit(function (){
            return false;
        });
    });

    $('button.logSend').on('click', function(){                     //нажата кнопка логина
        $.post("loginPost.php",
            $("#logForm :input").serializeArray(),
            function (data){
                answer=JSON.parse(data);
                console.log(answer);
                $("div#ack").html(answer);
        });

        $("#logForm").submit(function (){
            return false;
        });
    });

});
        // $.ajax({
        //     method: "POST",
        //     url: "loginPost.php",
        //     data: {
        //         'login': login,
        //         'password': password },
        //     success: function(data) {
        //         $("div#ack").html(data);
        //         }
        //     });
        //  })














        // var login=$("#login").val();
        // var password=$("#password").val();
        //
        // fetch('loginPost.php',{
        //     method:'POST',
        //     body:JSON.stringify({login,password}),          //передача в формате json
        // })
        //     .then(data=>data.text())
        //     .then(data=>{
        //         console.log(data);
        //         alert(data);
        //     })

        // $.ajax({
        //     method: "POST",
        //     dataType: 'json',
        //     processData: false,
        //     contentType: false,
        //     url: "loginPost.php",
        //     cache:false,
        //     data: {
        //         login: login,
        //         password: password },
        //     success: function(data) {
        //         console.log(data);
        //     }
        // })
