 $("#menu-btn").click(function(){
     $('aside').fadeIn();
 })

 $('#close-btn').click(function(){
     $('aside').fadeOut();
 })


 $( document ).ready(function() {
    if(localStorage.getItem("theme")=='dark-theme-variables'){
        $('body').addClass('dark-theme-variables');
        $('.theme-toggler span').removeClass('active'); 
        $('.dark_btn').addClass('active');  
    }
});

 $('.theme-toggler').click(function(){
     $('body').toggleClass('dark-theme-variables');
     $('.theme-toggler span').toggleClass('active');  
     localStorage.setItem("theme", $('body').attr('class')); 
 })

