;(function($){
 $(document).ready(function(){
  var slider = tns({
   container: '.slider',
   items: 1,
   autoplay: true,
   autoplayTimeout: 3000,
   speed: 300,
   autoHeight: true,
   controls: false,
   nav: false,
   autoplayButtonOutput: false

 });


  $(".popup").each(function(){
   var image = $(this).find("img").attr("src");
   $(this).attr("href", image);
  })
 });
})(jQuery);