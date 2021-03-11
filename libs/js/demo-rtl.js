// Toggle RTL mode for demo
// ----------------------------------- 


(function(window, document, $, undefined){

  $(function(){
    var maincss = $('#maincss');
    var bscss = $('#bscss');
    $('#chk-rtl').on('change', function(){
      
      // app rtl check
      maincss.attr('href', this.checked ? 'libs/css/app-rtl.css' : 'libs/css/main.css' );
      // bootstrap rtl check
      bscss.attr('href', this.checked ? 'libs/css/bootstrap-rtl.css' : 'libs/css/bootstrap.css' );

    });

     $('.filestyle').filestyle();

  });
  
})(window, document, window.jQuery);