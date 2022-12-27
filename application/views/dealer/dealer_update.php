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
         <form class="form-signin" action="<?php echo site_url('User_Controller/update_dealer_data');?>" method="post">
           <h2 class="form-signin-heading text-center">Dealer <br><small>(when you first time login as a dealer required to add a city,state,zip code)</small></h2>
           <!-- </?php echo "<pre>";
                    print_r($data);
                    echo "</pre>"; ?> -->
           <?php  foreach ($data as $dd) { ?>
          <div class="form-group">
           <label for="firstname" class="sr-only">First name</label>
           <input type="hidden" name="id" value="<?php echo $dd->id; ?>">
           <input type="text" name="first_name" class="form-control" readonly value="<?php echo $dd->first_name; ?>" placeholder="First Name" required autofocus>
          </div>
          <div class="form-group">
           <label for="lastname" class="sr-only">Last Name</label>
           <input type="text" name="last_name" class="form-control" readonly value="<?php echo $dd->last_name; ?>" placeholder="Last Name" required autofocus>
          </div>
           <div class="form-group">
           <label for="username" class="sr-only">Email</label>
           <input type="email" name="email" class="form-control" readonly value="<?php echo $dd->email; ?>" placeholder="Email" required autofocus>
          </div>
          <div class="form-group">
            <label for="city" class="sr-only">City</label>
            <input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $dd->city; ?>" required>
          </div>
          <div class="form-group">
            <label for="State" class="sr-only">State</label>
            <input type="text" name="state" class="form-control" placeholder="State" value="<?php echo $dd->state; ?>" required>
          </div>
          <div class="form-group">
            <label for="zip_code" class="sr-only">Zip Code</label>
            <input type="text" name="zip_code" class="form-control" placeholder="Zip Code" value="<?php echo $dd->zip_code; ?>" required>
          </div> 
          <?php if($this->session->userdata('user_type')==='1'){ ?>
           <div class="form-group">
            <label class="radio-inline"><strong>User Type </strong></label>
            <label class="radio-inline"><input type="radio" name="user_type" value="1" <?php echo set_value('user_type', $dd->user_type) == 1 ? "checked" : ""; ?> >Employee</label>
            <label class="radio-inline"><input type="radio" name="user_type" value="2" <?php echo set_value('user_type', $dd->user_type) == 2 ? "checked" : ""; ?> >Dealer</label>
          </div> <?php } ?>
          <?php } ?>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>

         

         </form>
       </div>
       </div> <!-- /container -->
 
       <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

  </body>
</html>