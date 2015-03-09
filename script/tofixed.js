function toFixed(){
(window).scroll(function(){
    var divpos = $(".Backazul").offset().top;
    disvpos = divpos ;
    var scrollpos = $(window).scrollTop();
    if (scrollpos > 237){
        $(".Backazul").css("top",(scrollpos-200)); }
    else{
        $(".Backazul").css("top",'0');
        }
});
}