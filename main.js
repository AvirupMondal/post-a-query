
function login_submit(){
    $('.field_error').html('');
    var email= jQuery("#login_email").val();
    var password= jQuery("#login_password").val();
    var is_error='';
   
    if(email==""){
      $('#email_error').html("Enter your email");
      is_error='yes';
      }

    if(password==""){
        $('#password_error').html("Enter your password");
        is_error='yes';
    }
    if(is_error==''){
       jQuery.ajax({
           url: 'login_submit.php',
           type: 'post',
           data: 'email='+email+  '&password='+password,
           success:function(result){
           if(result=='wrong'){
                $('.login_msg p').html("Please Enter Valid login Details");
           }
               if(result=='1'){
               window.location.href='queries.php';
           }
           if(result=='2'){
            window.location.href='teacher_queries.php';
        }
       }
           
       });
   }
}


function registration(){
    $('.field_error').html('');
        var name= jQuery("#name").val();
     var email= jQuery("#email").val();
     var college_name= jQuery("#college_name").val();
     var college_id= jQuery("#college_id").val();
     var year= jQuery("#year").val();
     var semester= jQuery("#semester").val();
     var stream= jQuery("#stream").val();
     var password= jQuery("#password").val();
   
    var is_error='';
     if(name==""){
        $('#name_error').html("Enter your name");
         is_error='yes';
       }
   if(email==""){
       $('#email_error').html("Enter your email");
       is_error='yes';
       }
   if(college_name==""){
         $('#college_name_error').html("Enter your college_name");
       is_error='yes';
       }
    if(college_id==""){
        $('#college_id_error').html("Enter your college_id");
         is_error='yes';
       }
    if(year==""){
        $('#year_error').html("Enter your year");
         is_error='yes';
       }
    if(semester==""){
        $('#semester_error').html("Enter your semester");
         is_error='yes';
       }
    if(stream==""){
        $('#stream_error').html("Enter your stream");
         is_error='yes';
       }
       
   if(password==""){
    $('#password_error').html("Enter your password");
        is_error='yes';
       }
       
    if(is_error==''){

        jQuery.ajax({
            url: 'register_submit.php',
            type: 'post',
            data: 'name='+name+ '&email='+email+ '&college_name='+college_name+ '&college_id='+college_id+ '&year='+year+ '&semester='+semester+ '&stream='+stream+  '&password='+password,
            success:function(result){
            if(result=='email_present'){
                 $('#email_error').html("Email ID Already Present");
            }
                if(result=='email_insert'){
                 $('.register_msg p').html("Successfully Registered. You can login Now");
                 
            }
        }
            
        });
    }
}




function teacher_registration(){
    $('.field_error').html('');
    var name= jQuery("#teacher_name").val();
    var email= jQuery("#teacher_email").val();
    var password= jQuery("#teacher_password").val();
   
    var is_error='';
    if(name==""){
        $('#name_error').html("Enter your name");
         is_error='yes';
       }
    if(email==""){
       $('#email_error').html("Enter your email");
       is_error='yes';
       }
    if(password==""){
        $('#password_error').html("Enter your password");
        is_error='yes';
       }
       
    if(is_error==''){

        jQuery.ajax({
            url: 'teacher_register_submit.php',
            type: 'post',
            data: 'name='+name+ '&email='+email+ '&password='+password,
            success:function(result){
            if(result=='email_present'){
                 $('#email_error').html("Email ID Already Present");
            }
                if(result=='email_insert'){
                 $('.register_msg p').html("Successfully Registered. You can login Now");
                 
            }
        }
            
        });
    }
}