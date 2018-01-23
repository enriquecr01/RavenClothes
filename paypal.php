<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<title></title>
</head>
<body>
	<div id="paypal-button"></div>

    <script>
        paypal.Button.render({

            env: 'sandbox', // 'production' o 'sandbox'

            commit: true, // Show a 'Pay Now' button

            payment: function() {
                // Set up the payment here
            },

            onAuthorize: function(data, actions) {
                // Execute the payment here
           }

        }, '#paypal-button');
    </script>
</body>
</html>