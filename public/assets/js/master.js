// ========================password fild hide show========================
$(".toggle-password").click(function() { 
    $(this).toggleClass("fa-eye fa-eye-slash");

    $(this).text($(this).text() == 'visibility_off' ? 'visibility' : 'visibility_off');
    
    
    var input = $(this).closest('.input-control').find('input');
   
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

// check confirm password
$('#password_confirmation').keyup(function(){
    $('#password_confirmation').css('border','1px solid #f00');
    $('#submit_button').prop('disabled', true);
 
   if($('#password_confirmation').val() == $('#pwd').val()){
    $('#password_confirmation').css('border','1px solid #ced4da');
    $('#submit_button').prop('disabled', false);
   }
})
 

 // =================================strong password js=====================
 
 $("input#pwd").on("focus keyup", function() {

});

$("input#pwd").blur(function() {

});
$("input#pwd").on("focus keyup", function() {
var score = 0;
var a = $(this).val();
var desc = new Array();

// strength desc
desc[0] = "Too short";
desc[1] = "Weak";
desc[2] = "Good";
desc[3] = "Strong";
desc[4] = "Best";

});

$("input#pwd").blur(function() {

});
$("input#pwd").on("focus keyup", function() {
var score = 0;
var a = $(this).val();
var desc = new Array();

// strength desc
desc[0] = "Too short";
desc[1] = "Weak";
desc[2] = "Good";
desc[3] = "Strong";
desc[4] = "Best";

// password length
if (a.length >= 6) {
    $("#length").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#length").removeClass("valid").addClass("invalid");
}

// at least 1 digit in password
if (a.match(/\d/)) {
    $("#pnum").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#pnum").removeClass("valid").addClass("invalid");
}

// at least 1 capital & lower letter in password
if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
    $("#capital").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#capital").removeClass("valid").addClass("invalid");
}

// at least 1 special character in password {
if (a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
    $("#spchar").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#spchar").removeClass("valid").addClass("invalid");
}


if (a.length > 0) {
    //show strength text
    $("#passwordDescription").text(desc[score]);
    // show indicator
    $("#passwordStrength").removeClass().addClass("strength" + score);
} else {
    $("#passwordDescription").text("Password not entered");
    $("#passwordStrength").removeClass().addClass("strength" + score);
}
});

$("input#pwd").blur(function() {

});
$("input#pwd").on("focus keyup", function() {
var score = 0;
var a = $(this).val();
var desc = new Array();

// strength desc
desc[0] = "Too short";
desc[1] = "Weak";
desc[2] = "Good";
desc[3] = "Strong";
desc[4] = "Best";

$("#pwd_strength_wrap").fadeIn(400);

// password length
if (a.length >= 6) {
    $("#length").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#length").removeClass("valid").addClass("invalid");
}

// at least 1 digit in password
if (a.match(/\d/)) {
    $("#pnum").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#pnum").removeClass("valid").addClass("invalid");
}

// at least 1 capital & lower letter in password
if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
    $("#capital").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#capital").removeClass("valid").addClass("invalid");
}

// at least 1 special character in password {
if (a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
    $("#spchar").removeClass("invalid").addClass("valid");
    score++;
} else {
    $("#spchar").removeClass("valid").addClass("invalid");
}


if (a.length > 0) {
    //show strength text
    $("#passwordDescription").text(desc[score]);
    if(score>=3){
      $('#submit_button').prop('disabled', false);
    }else{
        $('#submit_button').prop('disabled', true);
    }
    // show indicator
    $("#passwordStrength").removeClass().addClass("strength" + score);
} else {
    $("#passwordDescription").text("Password not entered");
    $("#passwordStrength").removeClass().addClass("strength" + score);
}
});

$("input#pwd").blur(function() {
$("#pwd_strength_wrap").fadeOut(400);
});
