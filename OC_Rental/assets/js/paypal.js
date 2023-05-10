function paymentFailed(){
    setTimeout(function(){
          Swal.fire({
          icon: 'error',
          title: 'Payment Failed',
          text: "Please try again, or use a different payment method",
          showConfirmButton: true,
          confirmButtonColor: '	#CD1B2B',
        })
 }, 1000);
}

function paymetSuccess(){

                Swal.fire({
                    icon: 'success',
                    title: 'Payment Success',
                    text: "Transaction ID : " + tr_id,
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                  })

                  document.getElementById("tr_id").value = tr_id;
                  document.getElementById("amount").value = amount;

         setTimeout(function(){
            var form = document.getElementById("rentForm");
            form.submit();
        }, 3500);

    

}


paypal.Buttons({
    style:{
        color:'blue',
        shape:'pill'
    },
    createOrder:function(data,actions){
        return actions.order.create({
            purchase_units:[{
                amount:{
                    value:'2'
                }
            }]
        });
    },
    onApprove:function(data,actions){
        return actions.order.capture().then(function(orderData){
            console.log(orderData)
            const transaction = orderData.purchase_units[0].payments.captures[0];

            email = orderData.payer.email_address;
            amount = transaction.amount.value;
            tr_id = transaction.id;
            paymetSuccess()


        })
    },
    onCancel:function(data){
        paymentFailed()

    }

}).render('#cbtn1');
