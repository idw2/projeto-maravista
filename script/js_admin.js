/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
  var url = (window.location.href).split("/").pop();
  url = url.replace("index?","index.php?");
  $('.menu-ul-cntr .menu-item a[href="'+url+'"]').addClass('active');
  $('.menu-ul-cntr .menu-item a[href="'+url+'"]').parents(".menu-ul-cntr").addClass('active');
  if(url == ''){ 
    $('.menu-ul-cntr .menu-item a[href="index.php"]').addClass('active');
    $('.menu-ul-cntr .menu-item a[href="index.php"]').parents(".menu-ul-cntr").addClass('active');
    
  }
})

$(document).ready(function(){
  $(".menu-ul-toggle").click(function(){
    var pai = $(this).parents(".menu-ul-cntr");
    $(".menu-ul-cntr").not(pai).removeClass("active");
    pai.toggleClass("active");
  });
  
  
  $('html').click(function() {
    $(".dropout").removeClass("open");
  });
  
  $("a[data-dropdown]").click(function(){
    event.stopPropagation();
    //var dropID = "#"+$(this).attr("data-dropdown");
    $(this).parent(".dropout").toggleClass("open");
  });
  
  
});