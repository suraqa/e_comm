<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Stripe Checkout Sample</title>

    {{-- <link rel="icon" href="favicon.ico" type="image/x-icon" /> --}}
    <link rel="stylesheet" href="{{ asset("css/normalize.css") }}" />
    <link rel="stylesheet" href="{{ asset("css/global.css") }}" />
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset("js/index.js") }}" defer></script>
  </head>

  <body>
    <div class="sr-root">
      <div class="sr-main">
        <header class="sr-header">
          <div class="sr-header__logo"></div>
        </header>

        <section class="container">
          <div>
            <h1>Single photo</h1>
            <h4>Purchase a Pasha original photo</h4>

            <div class="pasha-image">
              <img
                src="https://picsum.photos/280/320?random=4"
                width="140"
                height="160"
              />
            </div>
          </div>

          <div class="quantity-setter">
            <button class="increment-btn" id="subtract" disabled>-</button>
            <input type="number" id="quantity-input" min="1" value="1" />
            <button class="increment-btn" id="add">+</button>
          </div>

          <p class="sr-legal-text">Number of copies (max 10)</p>

          <button id="submit">Buy</button>
        </section>

        <div id="error-message"></div>
      </div>
    </div>
  </body>
</html>
