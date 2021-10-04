const stripe = require('stripe')('sk_test_51JgKEBJytYJMwZffQlyBWq1QGaA705mTU6g1reBu5WW1hVuHC1o0IcpqdxRLWBGaX26wgcc99mC8W63bjrEA2bzI002UMB8ahG');
const express = require('express');
const app = express();
app.use(express.static('public'));

const YOUR_DOMAIN = 'http://localhost:4242';

app.post('/create-checkout-session', async (req, res) => {
  const session = await stripe.checkout.sessions.create({
    line_items: [
      {
        price: 'price_1JgYmJJytYJMwZffFUFpKHRO',
        quantity: 1,
      },
    ],
    payment_method_types: [
      'card',
      'alipay',
    ],
    mode: 'payment',
    success_url: `${YOUR_DOMAIN}/success.html`,
    cancel_url: `${YOUR_DOMAIN}/cancel.html`,
  });

  res.redirect(303, session.url)
});

app.listen(4242, () => console.log('Running on port 4242'));
