<html>
  <head>
    <title>Margalya Press</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <button id="checkout-button">Checkout</button>
    <script>
      var stripe = Stripe('pk_test_51LclOqK2XRplstJPeHtJQdBAyVPcVCBriph3n4qOQ0GfFbB9bnzM3IcbKFiynmPuF6x88drlXxMSC9XJQorFSY8U00lsLPY2kG'); //create an instance of stripe (client side)
      const btn = document.getElementById("checkout-button")
      btn.addEventListener('click', function(e) { //add this so that the stripe checkout doesnt display immediately.event listener
        e.preventDefault();
        stripe.redirectToCheckout({ //redirect to stripe checkout
          sessionId: "<?php echo $session->id; ?>"
        });
      });
    </script>
  </body>
</html>
