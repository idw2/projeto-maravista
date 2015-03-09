/* 
= Ahmad Tag - v0.1 - 02/02/2013
= http://lab.joaoahmad.com.br
= Copyright (c) 2013 Joao Ahmad;
*/

var font_size = 1;


jQuery.fn.ahmadImage = function(){
  $.each(this,function(){
    var img = $(this);
    var src = img.attr("src");
    
    if(img.css("background-image")!="none"){src = img.css("background-image").replace(/^url|[\(\)]/g, '');}
    //var prop = img.prop("display");
    //$(this).before("<div style='background-image: url("+src+");width:"+img.width()+"px;height:"+img.height()+"px'></div>");
    img.before("<div class='ai-preload' style='width:"+img.width()+"px;height:"+img.height()+"px'><i class='ai-loader'></i></div>");
    //$(".ai-preload").prop(prop);
    img.hide();
    console.log("carregando: "+src);
    $("<img/>").attr("src",src).load(function(){
       console.log("pronto: "+src);
      img.prev(".ai-preload").remove();
      img.show();
    });
    console.log("w: "+img.width());
    console.log("h: "+img.height());
  });
};

$("a[aria=upfont]").click(function(){
  if((font_size <= 3) && (font_size >= 1)){
    font_size++;
    setfont(font_size);
  }
});

$("a[aria=downfont]").click(function(){
  if((font_size <= 3) && (font_size >= 1)){
    font_size = font_size-1;
    setfont(font_size);
  }
});

function setfont(size){
  if(font_size == 1){
      $("html").css("font-size","100%");
    }
    if(font_size == 2){
      $("html").css("font-size","125%");
    }
    if(font_size == 3){
      $("html").css("font-size","150%");
    }
}