$(document).ready(function(){
    var path = $(location).attr('href');
    if(path.search('dashboard') != -1){
        var post_path = "../includes/check_orders.php";
    }else{
        var post_path = "includes/check_orders.php";
    }

    function checkOrders(){
        $.post(post_path, function(data){
            if(!data){
                if(!$(".no_orders").length){
                    $(".ordersTable").empty();
                    $(".ordersTable").html("<span class='no_orders'>Brak nowych zamówień.</span>");
                    return;
                }
            }else{
                if($(".no_orders").length){
                    $(".ordersTable").empty();
                }

                var arr = $.parseJSON(data);
                showOrder(arr);
            }
        });
    }

    function showOrder(data){
        for(var i = 0; i < data.length; i++){
            if(!$("#order"+data[i]['id']).length){
                data[i]['menu_items'] = "";
                for(var j = 0; j < data[i]['menu_ids'].length; j++){
                    data[i]['menu_items'] += "<li>"+data[i]['menu_ids'][j]+"</li>";
                    if(j < data[i]['menu_ids'].length - 1) data[i]['menu_items'] += "<span class='przecinek'>, </span>";
                }

                var result = "<section class='order' id='order"+data[i]['id']+"'><ul class='pizza'>"+data[i]['menu_items']+"</ul><section class='date'>"+data[i]['date']+"</section><b class='price'>"+data[i]['price']+" PLN</b><div class='email'>"+data[i]['email']+"</div><p class='phone'>"+data[i]['phone']+"</p><p class='address'>"+data[i]['address']+"</p><div class='payment'>"+data[i]['payment']+"</div><form method='POST' class='form"+data[i]['id']+"'><input type='submit' name='acceptOrder' value='Akceptuj'><input type='submit' name='declineOrder' value='Odrzuć'><input type='hidden' name='orderId' value='"+data[i]['id']+"'></form></section>";
                $(result).appendTo(".ordersTable");
            }
        }

        var clicked = false;
        $("input[name=declineOrder]").click(function(){
            if(clicked == false) clicked = true;
        });

        $("form").submit(function(event){
            if(clicked){
                if($(this).has("input[name=reason]").length){
                    if($(".active_reason").val() == ""){
                        event.preventDefault();
                        if(!$(".error_msg").length){
                            $("<span class='error_msg'>Podaj powód.</span>").appendTo(this);
                        }
                    }
                }else{
                    event.preventDefault();
                    $("input[name=reason]").remove();
                    $("<input type='text' name='reason' placeholder='Powód' class='active_reason'>").appendTo(this);
                }

                clicked = false;
            }
        });
    }
    
    checkOrders();
    setInterval(function(){ checkOrders(); }, 15000);
});