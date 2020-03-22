$(".continue").click(function(){
    $(".errorMsg").empty();

    if(!$("#adr1").val() || !$("#adr2").val() || !$("#adr3").val()){
        $(".errorMsg").html("Wpisz pełny adres.");
        return;
    }

    if(!$("#email").val()){
        $(".errorMsg").html("Wpisz adres email.");
        return;
    }

    if(!$("#phone").val()){
        $(".errorMsg").html("Wpisz numer telefonu.");
        return;
    }
    if($("#phone").val().length != 9){
        $(".errorMsg").html("Podaj prawidłowy numer telefonu.");
        return;
    }

    if(!isEmail($("#email").val())){
        $(".errorMsg").html("Podany email nie jest prawidłowy.");
        return;
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
      }

    var address = $("#adr1").val()+", "+$("#adr2").val()+" "+$("#adr3").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var payment = $("#payment").val();

    $("input[name=address]").val(address);
    $("input[name=email]").val(email);
    $("input[name=phone]").val(phone);
    $("input[name=payment]").val(payment);

    $(".clientData").hide();
    $(".orderField").show();
});

$(".goBack").click(function(){
    $(".clientData").show();
    $(".orderField").hide();
});

var i = 0;
$('.add').click(function(event) {
    event.preventDefault();
    var id = $(this).attr("name");
    var name = $("#name"+id).text();
    var price = parseInt($("#price"+id).text());

    var result = "<div id='order"+id+"' class='orderId'><h1>"+name+"</h1><p><span id='order_price"+id+"'>"+price+"</span> PLN</p><button class='remove"+i+"' name='"+id+"'>X</button></div>";
    result+= "<input type='hidden' name='orders[]' value='"+id+"'>";
    $(result).appendTo(".elements");

    var suma = parseInt($("#full").text());
    $("#full").html(suma += price);
    $("input[name=full_price]").val(suma);


    $(".remove"+i).click(function(event) {
        event.preventDefault();
        var id = $(this).attr("name");
        var price = parseInt($("#order_price"+id).first().text());
        $(this).parent().remove();

        var suma = parseInt($("#full").text());

        suma -= price;
        if(!suma) suma = "0";
        $("#full").html(suma);
        $("input[name=full_price]").val(suma);

        i--;
    });

    i++;
});

var form_submit = false;
$(".orderCart").submit(function(event){
    if(!$(".orderId").length){
        event.preventDefault();
        $(".errorMsg2").html("Nie wybrałeś żadnej pizzy!");
        return;
    }
    form_submit = true;
});

window.onbeforeunload = function() {
    if($(".orderId").length && !form_submit){
        return 'Masz niedokończone zamówienie!\nCzy na pewno chcesz opuścić stronę?';
    }
};