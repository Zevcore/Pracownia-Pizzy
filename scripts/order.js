$(".continue").click(function(){
    $(".errorMsg").empty();

    if(!$("#adr1").val() || !$("#adr2").val() || !$("#adr3").val()){
        $(".errorMsg").html("Wpisz pełny adres");
        return;
    }

    var address = $("#adr1").val()+", "+$("#adr2").val()+" "+$("#adr3").val();
    var payment = $("#payment").val();

    $("input[name=address]").val(address);
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
$(".orderCart").submit(function(){
    form_submit = true;
});

window.onbeforeunload = function() {
    if($(".orderId").length && !form_submit){
        return 'Masz niedokończone zamówienie!\nCzy na pewno chcesz opuścić stronę?';
    }
};