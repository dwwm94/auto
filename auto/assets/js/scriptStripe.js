$(function(){
    const stripe = Stripe("pk_test_51IcbyxAHDrsAEQyVpeK7JHV3UPm3RUiDdyA5rCqrH2dqUEV8lQ1wo1ziI4Pm33X8ZcWRwOwq28ax1aABvsXXCXUq00Z6dNwdgw");
    const checkoutButton = $('#checkout-button');
    checkoutButton.on('click', function(e){
        e.preventDefault();
        console.log($('#nb').val());
        $.ajax({
            url:'index.php?action=pay',
            method:'post',
            data:{
                id: $('#ref').val(),
                marque: $('#marque').val(),
                modele: $('#modele').val(),
                prix: $('#prix').val(),
                email: $('#email').val(),
                quantite: $('#quant').val(),
                nb: $('#nb').val()
            },
            datatype: 'json',
            success:function(session){
                console.log(session);
                return stripe.redirectToCheckout({ sessionId: session.id });
            },
            error: function(){
                console.error("fail to send!");
            }
        });
    })
});