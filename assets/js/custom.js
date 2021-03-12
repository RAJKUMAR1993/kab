 $(function(){
  
  $('.dataTable').on("click",".kabdelete",function(e){
    var element = jQuery(this);
    var delid = element.attr("name");
   
     swal({
        title: "Are you sure?",
        text: "You want to delete this ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText: "Yes, delete it!",
     }). then ((result) => {
		  if (result.value) {
			swal("Deleted!", "Successfully deleted.", "success");
			 $.ajax({
			  url:delid,
			  type:"get",
			  success:function(str){
				setTimeout(function(){ location.reload(); }, 1000);
			  }
			}); 
	 	  }
//         setTimeout(function(){ location.reload(); }, 1000);
    })

    return false;
  });


 jQuery('.course_delete').click(function(e){
    var element = jQuery(this);
    var delid = element.attr("name");
  
     swal({
        title: "Are you sure?",
        text: "You want to delete this course",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }). then ((result) => {
        swal("Deleted!", "Course has been deleted.", "success");
         $.ajax({
          url:delid,
          type:"get",
          success:function(str){
            setTimeout(function(){ location.reload(); }, 1000);
          }
        }); 
         setTimeout(function(){ location.reload(); }, 1000);
    });

    return false;
  });

 jQuery('.category_delete').click(function(e){
    var element = jQuery(this);
    var delid = element.attr("name");
  
     swal({
        title: "Are you sure?",
        text: "You want to delete this category",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }). then ((result) => {
        swal("Deleted!", "Category has been deleted.", "success");
         $.ajax({
          url:delid,
          type:"get",
          success:function(str){
            setTimeout(function(){ location.reload(); }, 1000);
          }
        }); 
         setTimeout(function(){ location.reload(); }, 1000);
    });

    return false;
  });

  $(function(){
      var dtToday = new Date();
      
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
          day = '0' + day.toString();
      
      var maxDate = year + '-' + month + '-' + day;
      $('#txtDate').attr('min', maxDate);
  });
  toastr.options.timeOut = 3000;
  toastr.options.closeButton = true;
  toastr.options.positionClass = 'toast-top-right';
  $("#txtDate").on("blur", function(){
      var current_date = new Date();
      current_date.setDate(current_date.getDate() - 1);
      var date = $(this).val();
      if(date!='' && typeof date!='undefined'){
          var dt = new Date(date);
          dt.setDate(dt.getDate() + 1);
          if (dt >= current_date){
              return true;
          } else {
              toastr.remove();
              toastr['error']('You are not allowed to create session for completed date', '', {
                  positionClass: 'toast-top-right'
              });
              setTimeout(function(){ $("#txtDate").val(""); }, 1000); 
          }
      }
  });

});