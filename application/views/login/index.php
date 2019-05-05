
<?php include("../req/head.php"); ?>
  <body class="animsition page-login-v2 layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <style>
      body {
        background: transparent;
      }
    </style>
    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content">
        <div class="page-brand-info">
          <div class="brand">
            <img class="brand-img" src="../../assets/images/logo@2x.png" alt="...">
            <h2 class="brand-text font-size-40">Remark</h2>
          </div>
          <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="page-login-main animation-slide-right animation-duration-1">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="../../assets/images/logo-colored@2x.png" alt="...">
            <h3 class="brand-text font-size-40">Remark</h3>
          </div>
          <h3 class="font-size-24">Sign In</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

          <form method="post" action="login-v2.html">
            <div class="form-group">
              <label class="sr-only" for="inputEmail">Email</label>
              <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label class="sr-only" for="inputPassword">Password</label>
              <input type="password" class="form-control" id="inputPassword" name="password"
                placeholder="Password">
            </div>
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                <input type="checkbox" id="rememberMe" name="rememberMe">
                <label for="rememberMe">Remember me</label>
              </div>
              <a class="float-right" href="forgot-password.html">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
          </form>

          <p>No account? <a href="register-v2.html">Sign Up</a></p>

        </div>

      </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    
  </body>
</html>
