$(document).ready(function() { // Start work jQuery--------------------->>>>>>>>>>>>>>>>>>>>

    // акстивная ссылка меню header при нажатии на нее
    $("#navbarSupportedContent [href]").each(function () {
      if (this.href == window.location.href) {
          $(this).addClass("active");
      }
    });
    

}); // END work jQuery------------------------------------>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    