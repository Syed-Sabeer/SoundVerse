<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to I See You</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
      background-color: #000000;
    }

    .email-wrapper {
      background-image:
        linear-gradient(#000000bf, #000000db),
        url('/vision-image.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem 0;
    }

    .email-container {
      max-width: 450px;
      width: 100%;
      background-color: #010312;
      border-radius: 12px;
      overflow: hidden;
      box-sizing: border-box;
      text-align: center;
    }

    .logo-section {
      padding: 30px 40px 20px 40px;
    }

    .logo-section img {
      border-radius: 12px;
      max-width: 100%;
      height: auto;
    }

    .content-section {
      padding: 40px 40px 50px 40px;
      text-align: center;
    }

    .content-section h1 {
      margin: 0 0 20px 0;
      color: #03A9F4;
      font-size: 42px;
      font-weight: 700;
      letter-spacing: -0.5px;
      line-height: 1.2;
    }

    .content-section p {
      color: #cccccc;
      font-size: 15px;
      line-height: 1.7;
      font-weight: 400;
      max-width: 450px;
      margin: 10px auto;
    }

    .cta-button {
      margin: 50px 0 40px 0;
    }

    .cta-button a {
      display: inline-block;
      background-color: #03a9f4;
      color: #ffffff;
      text-decoration: none;
      padding: 18px 50px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      box-shadow: rgb(132 145 215 / 57%) 0px 2px 8px 0px;
    }

    .footer {
      padding: 40px 40px 50px 40px;
      border-top: 1px solid #1a1a1a;
      text-align: center;
    }

    .footer h3 {
      margin: 0;
      color: #03A9F4;
      font-size: 18px;
      font-weight: 700;
    }

    .footer p {
      margin: 8px 0;
      color: #999999;
      font-size: 14px;
      line-height: 1.6;
    }

    .footer-links {
      margin: 16px 0;
    }

    .footer-links a {
      color: #03A9F4;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: #ffffff;
    }

    .footer small {
      display: block;
      margin-top: 12px;
      color: #555555;
      font-size: 12px;
    }

    @media (max-width:767px) {
        .email-container {
            max-width: unset;
            width: 85%;
        }
    }
        @media (max-width:476px) { 
            .content-section h1 {
            font-size: 34px;
            }
        }
  </style>
</head>
<body>
  <div class="email-wrapper" style="background:  linear-gradient(#000000bf, #000000db),url('{{ asset('FrontendAssets/images/vision-image.jpg')}}')">
    <div class="email-container">

      <!-- Logo Section -->
      <div class="logo-section">
        <img src="{{ asset('FrontendAssets/images/image.png')}}" alt="logo">
      </div>

      <!-- Main Content -->
      <div class="content-section">
        <h1>Thank You for <br> Signing In!</h1>

        <p>
          From this moment on, you are now eligible to receive partnerships, scholarships,
          and other benefits from <strong>I See You</strong> and <strong>GATS</strong>.
        </p>

        <p>
          You’re taking the first step towards a future full of opportunities and growth
          in the artistic world.
        </p>

        <!-- CTA Button -->
        <div class="cta-button">
          <a href="https://germanvergara.iseeyouweb.com/">START YOUR APPLICATION</a>
        </div>
      </div>

      <!-- Footer -->
      <div class="footer">
        <h3>I See You &amp; GATS</h3>
        <p>Supporting artists worldwide with partnerships, scholarships, and opportunities.</p>

        <div class="footer-links">
          <a href="https://germanvergara.iseeyouweb.com/" target="_blank">Visit Website</a> •
          <a href="javascript:;">Contact Us</a>
        </div>

        <small>© 2025 I See You &amp; GATS. All rights reserved.</small>
      </div>

    </div>
  </div>
</body>
</html>


