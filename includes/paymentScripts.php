<script>
		var stripe = Stripe('pk_test_pDLp70H5RFn9KPS0ohR1RzuQ00j9uAzPMg');
		var elements = stripe.elements();
		var style = {
			base: {
				color: '#32325d',
				fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
				fontSmoothing: 'antialiased',
				fontSize: '16px',
				'::placeholder': {
					color: '#aab7c4'
				}
			},
			invalid: {
				color: '#fa755a',
				iconColor: '#fa755a'
			}
		};
		document.querySelector('#payment-form button')
			.classList = 'btn btn-primary btn-block mt-4';
		var card = elements.create('card', {
			style: style
		});
		card.mount('#card-element');
		card.addEventListener('change', function(event) {
			var displayError = document.getElementById('card-errors');
			if (event.error) {
				displayError.textContent = event.error.message;
			} else {
				displayError.textContent = '';
			}
		});

		var form = document.getElementById('payment-form');
		form.addEventListener('submit', function(event) {
			event.preventDefault();

			stripe.createToken(card).then(function(result) {
				if (result.error) {
					var errorElement = document.getElementById('card-errors');
					errorElement.textContent = result.error.message;
				} else {
					stripeTokenHandler(result.token);
				}
			});
		});

		function stripeTokenHandler(token) {
			var form = document.getElementById('payment-form');
			var hiddenInput = document.createElement('input');
			hiddenInput.setAttribute('type', 'hidden');
			hiddenInput.setAttribute('name', 'stripeToken');
			hiddenInput.setAttribute('value', token.id);
			form.appendChild(hiddenInput);
			form.submit();
		}
		let all = document.getElementsByClassName('form-group StripeElement');
		for (var i = 0; i < all.length; i++) {
			all[i].style.border = "1px solid #ced4da";
			all[i].style.borderRadius = ".25rem";
			all[i].style.padding = "8px";
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" />
	