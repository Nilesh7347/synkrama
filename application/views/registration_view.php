<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign-Up</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-theme.min.css');?>" rel="stylesheet">
 
  </head>
  <body>
 
      <div class="container">
       <div class="col-md-4 col-md-offset-4">
         <form class="form-signin" action="<?php echo site_url('User_Controller/register');?>" method="post">
           <h2 class="form-signin-heading text-center">SignUp</h2>
          <div class="form-group">
           <label for="firstname" class="sr-only">First name</label>
           <input type="text" name="first_name" class="form-control" placeholder="First Name" required autofocus>
          </div>
          <div class="form-group">
           <label for="lastname" class="sr-only">Last Name</label>
           <input type="text" name="last_name" class="form-control" placeholder="Last Name" required autofocus>
          </div>
           <div class="form-group">
           <label for="username" class="sr-only">Email</label>
           <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
          </div>
          <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label class="radio-inline"><strong>User Type </strong></label>
            <label class="radio-inline"><input type="radio" name="user_type" value="1" >Employee</label>
            <label class="radio-inline"><input type="radio" name="user_type" value="2" checked>Dealer</label>
          </div>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

           <small>if already have login credentials <a href="<?php echo site_url('User_Controller/login_view'); ?>"><strong>Log In</strong></a></small>

         </form>
       </div>
       </div> <!-- /container -->
 
       <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

  </body>
</html>