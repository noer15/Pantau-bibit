<html>
<head>
  <title>Multiple Insert</title>
  
  <!-- Load File Jquery -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

</head>
<body>
        <form action="<?=site_url('sumbang/abc') ?>" method="POST"> 
  <div class="table-responsive"> 
                <table class="table table-bordered" id="dynamic_field"> 

                  <!-- APPEND -->
                    <tr>  
                        <td><input type="text" name="addmore[$i][sub_name]" placeholder="Enter Name" class="form-control name_list" required="" /></td>
                        <td><input type="text" name="addmore[$i][sub_tests]" placeholder="Total Tests" class="form-control name_list" required="" /></td>
                        <td><input type="text" name="addmore[$i][sub_dx]" placeholder="Total Diagnosed" class="form-control name_list" required="" /></td>

                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                    </tr>  
                  <!-- APPEND -->

                </table>  
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
            </div>
    </form>


            <script type="text/javascript">
    $(document).ready(function(){      
      var i=1;  

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"> <td><input type="text" name="addmore[$i][sub_name]" placeholder="Enter Name" class="form-control name_list" required="" /></td> <td><input type="text" name="addmore[$i][sub_tests]" placeholder="Total Tests" class="form-control name_list" required="" /></td> <td><input type="text" name="addmore[$i][sub_dx]" placeholder="Total Diagnosed" class="form-control name_list" required="" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td> </tr>');  
      });

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  

    });  
</script>
</body>
</html>