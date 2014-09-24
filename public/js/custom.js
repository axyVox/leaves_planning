$(document).ready(function(){

    $("#login_form").submit(function(){
        if($("#username").val().trim() == "" || $("#password").val().trim() == ""){
            $("#username, #password").css("border-color","red");
            return false;
        }
    });


    $(".datepicker").datepicker({ dateFormat: "dd-mm-yy", minDate: 0});

    $("#leave_request_form").submit(function(){

        if($("#leave_type").val() == "-"){
            $("#leave_type").css("border-color","red");
            return false;
        }

        if($("#from_date").val().trim() == "" || $("#to_date").val().trim() == ""){
            $("#from_date, #to_date").css("border-color","red");
            return false;
        }

    });




});
