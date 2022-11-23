<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" type="text/css" href="css\style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>inser data</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Last Name : <input type="text" id="lname">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
            <td id="table-data">
            </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <!-- <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div> -->

                <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript">
                 $(document).ready(function(){
                  function loadTable(page){
                     $.ajax({
                      url: "ajax-load.php",
                      type: "POST",
                      data: {page_no :page },
                      success: function(data) {
                        $("#table-data").html(data);
                      }
                    });
                  }
                  loadTable();
                  //Pagination Code
                  $(document).on("click","#pagination a",function(e) {
                    e.preventDefault();
                    var page_id = $(this).attr('id');
                    loadTable(page_id);
                  });
                

                  //insert data 
                $("#save-button").on("click",function(e){
                  e.preventDefault();
                  var fname = $("#fname").val();
                  var lname = $("#lname").val();
                  if(fname == "" || lname ==""){
                    $("#error-message").html("All fields are required.").slideDown();
                    $("#success-message").slideUp();
                  }
                 else{
                  $.ajax({
                    url : "ajax-insert.php",
                    type : "POST",
                    data : {frist_name : fname, last_name : lname},
                    success : function(data){
                      if(data ==1 ){
                        loadTable();
                        $("#addForm").trigger("reset");
                        $("#success-message").html("record save").slideDown();
                        $("#error-message").slideUp();
                      }else{
                        $("#error-message").html("cannot save record").slideDown();
                        $("#success-message").slideUp();
                      }
                     
                    }
                  })
                 }
                });


                //   //Delete Records
                $(document).on("click",".delete-btn", function(){
                  if(confirm("Do you really want to delete this record ?")){
                    var studentId = $(this).data("id");
                    var element = this;

                    $.ajax({
                      url: "ajax-delete.php",
                      type : "POST",
                      data : {id : studentId},
                      success : function(data){
                      if(data == 1){
                        $(element).closest("tr").fadeOut();
                      }else{
                        $("#error-message").html("Can't Delete Record.").slideDown();
                        $("#success-message").slideUp();
                      }
                    }
                  });
                }
              });

                          // Live Search
                      $("#search").on("keyup",function(){
                        var search_term = $(this).val();

                        $.ajax({
                          url: "ajax-live-search.php",
                          type: "POST",
                          data : {search:search_term },
                          success: function(data) {
                          $("#table-data").html(data);
                        }
                      });
                    });
                    });
</script>
</body>





</html>
