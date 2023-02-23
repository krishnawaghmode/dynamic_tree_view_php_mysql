 <?php
    include "Main.php";
    $obj = new Main();
?>
 <!DOCTYPE html>
 <html>
   <head>
     <title>Test</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   </head>
   <body>
     <div class="container">
       <div id="list"></div>
       <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#myModal"> Add Member </button>
       <div class="modal" id="myModal">
         <div class="modal-dialog">
           <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
               <h4 class="modal-title">Add Member</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <!-- Modal body -->
             <form action="">
               <div class="modal-body">
                 <div class="form-group">
                   <label for="parentid">Parent</label>
                   <select id="parentid" class="form-control"></select>
                 </div>
                 <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" class="form-control" id="name" placeholder="Enter name" required>
                   <span class="text-danger name_err"></span>
                 </div>
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-success" id="submit">Save</button>
               </div>
             </form>
           </div>
         </div>
       </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
     <script>
       $(document).ready(function() {
         fetch_list();
         fetch_parent();

         function fetch_list() {
           $.ajax({
             url: "save.php",
             method: "POST",
             data: {
               action: 'list'
             },
             success: function(data) {
               $('#list').empty().html(data);
             }
           })
         }

         function fetch_parent() {
           $.ajax({
             url: "save.php",
             method: "POST",
             data: {
               action: 'parent_list'
             },
             success: function(data) {
               // console.log(data);
               $('#parentid').empty().html(data);
             }
           })
         }
         $("#submit").click(function(e) {
           e.preventDefault();
           $('.name_err').html('');
           var parentid = $('#parentid').val();
           var name = $('#name').val();
           if (name == '') {
             $('.name_err').html('Please Name requied!');
             return false;
           }
           $.ajax({
             url: "save.php",
             method: "POST",
             data: {
               action: 'save',
               parentid: parentid,
               name: name
             },
             success: function(data) {
               fetch_list();
               fetch_parent();
               $("form").trigger("reset");
               $('#myModal').modal('hide');
             }
           })
         });
       });
     </script>
   </body>
 </html>