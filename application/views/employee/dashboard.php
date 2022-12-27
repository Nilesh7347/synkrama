<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-theme.min.css');?>" rel="stylesheet">
 
  </head>
  <body>
    <div class="container">
      <div class="row">
      <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">LOGO</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <!--ACCESS MENUS FOR ADMIN-->
                <?php if($this->session->userdata('user_type')==='1'):?>
                  <li class="active"><a href="#">Dashboard</a></li>
                 
                <!--ACCESS MENUS FOR DEALER-->
                <?php elseif($this->session->userdata('user_type')==='2'):?>
                  <li class="active"><a href="#">Dashboard</a></li>
                
                <?php endif;?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('User_controller/logout');?>">Sign Out</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </nav>
 
        <div class="jumbotron">
            
          <h1>Welcome <?php echo $this->session->userdata('name');?></h1>
        <form id="search_filter">
                    <div class="row">
                        <div class="col-md-7"></div>
                        <div class="col-md-3">
                        <input type="text" class="form-control" name="zipfilter" id="zipfilter" placeholder="Enter Zip Code">
                        </div>
                        <div class="col-md-2">
                        <button type="button" type="submit"  id="zipcodefilter" class="btn btn-primary">Search</button>
                        </div>
                    </div>
        </form>
          <table class="table table-striped" id="dealerListing" >
                <thead>
                    <tr>
                       
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="listRecords"> 

	            </tbody>
            </table>

        </div>
      </div>
    </div>


    <!-- MODAL EDIT -->
    <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Dealer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">City</label>
                            <div class="col-md-10">
                            <input type="hidden" name="id" id="id" >
                            <input type="text" name="city" id="city" class="form-control" placeholder="city">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">State</label>
                            <div class="col-md-10">
                              <input type="text" name="state" id="state" class="form-control" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Zip Code</label>
                            <div class="col-md-10">
                              <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="Zip Code">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->



<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>

  
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

    <script>
        listDealer();
      function listDealer(){

	    $.ajax({
		type  : 'ajax',
        url   : '<?php echo site_url('User_Controller/show_Dealer')?>',
		//url   : 'User_Controller/show_Dealer',
		async : false,
		dataType : 'json',
		success : function(data){
			var html = '';
            var j = 1;
			var i;
			for(i=0; i<data.length; i++){
				html += '<td>'+data[i].first_name+' '+data[i].last_name+'</td>'+
						'<td>'+data[i].email+'</td>'+
						'<td>'+data[i].user_type+'</td>'+		                        
						'<td>'+data[i].city+'</td>'+
						'<td>'+data[i].state+'</td>'+
                        '<td>'+data[i].zip_code+'</td>'+
						'<td style="text-align:center;">'+
							'<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="'+data[i].id+'" data-city="'+data[i].city+'" data-state="'+data[i].state+'" data-zip_code="'+data[i].zip_code+'">Edit</a>'+' '+'</td>'+'</tr>';
			}
			$('#listRecords').html(html);					
		  }
	    });
    }



 //get data for update record
 $('#listRecords').on('click','.editRecord',function(){
            var id = $(this).data('id');
            var city = $(this).data('city');
            var state        = $(this).data('state');
            var zip_code        = $(this).data('zip_code');
             
            $('#Modal_Edit').modal('show');
            $('[name="id"]').val(id);
            $('[name="city"]').val(city);
            $('[name="state"]').val(state);
            $('[name="zip_code"]').val(zip_code);
});

   //update record to database
   $('#btn_update').on('click',function(){
            var id = $('#id').val();
            var city = $('#city').val();
            var state        = $('#state').val();
            var zip_code = $('#zip_code').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('User_controller/dealer_Update')?>",
                dataType : "JSON",
                data : {id:id , city:city, state:state, zip_code:zip_code},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="city"]').val("");
                    $('[name="state"]').val("");
                    $('[name="zip_code"]').val("");
                    $('#Modal_Edit').modal('hide');
                    listDealer();
                }
            });
            return false;
        });

    $('#zipcodefilter').on('click', function(){
        var zip_code = $('#zipfilter').val();
        // alert(zip_code);
        $.ajax({
		type  : 'ajax',        
        url   : '<?php echo site_url('User_Controller/filter_Dealer_zipcode')?>',
		//url   : 'User_Controller/show_Dealer',
		async : false,
		dataType : 'json',
        method: "post",    
        data : {zip_code:zip_code},   
		success : function(data){
			var html = '';
            var j = 1;
			var i;
			for(i=0; i<data.length; i++){
				html += 
						'<td>'+data[i].first_name+' '+data[i].last_name+'</td>'+
						'<td>'+data[i].email+'</td>'+
						'<td>'+data[i].user_type+'</td>'+		                        
						'<td>'+data[i].city+'</td>'+
						'<td>'+data[i].state+'</td>'+
                        '<td>'+data[i].zip_code+'</td>'+
						'<td style="text-align:center;">'+
							'<a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="'+data[i].id+'" data-city="'+data[i].city+'" data-state="'+data[i].state+'" data-zip_code="'+data[i].zip_code+'">Edit</a>'+' '+'</td>'+'</tr>';
			}
			$('#listRecords').html(html);					
		  }
	    });
    });
 </script>
  </body>
</html>