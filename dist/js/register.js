define(["jquery"], function($){
    function registerSend(){
        $("#register-button").click(function(){
            $.ajax({
                type: "post",
                url: "./php/register.php",
                data: {
                    username: $(".item_account").eq(0).val(),
                    password: $(".item_account").eq(1).val(),
                    repassword: $(".item_account").eq(2).val(),
                    createtime: (new Date()).getTime()
                },
                success: function(result){
                    console.log(result);
                },
                error: function(msg){
                    console.log(msg);
                }
            })
        })
    }

    return {
        registerSend: registerSend
    }
})