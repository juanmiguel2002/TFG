(function($) {

	"use strict";

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			$this.find('.dropdown-menu').removeClass('show');
	});

})(jQuery);

$(document).ready(function(){ irArriba(); }); //Hacia arriba

// FUNCION PARA IR ARRIBA
function irArriba(){
  $('.ir-arriba').click(function(){ $('body,html').animate({ scrollTop:'0px' },1000); });
  $(window).scroll(function(){
    if($(this).scrollTop() > 0){ $('.ir-arriba').slideDown(600); }else{ $('.ir-arriba').slideUp(600); }
  });
  $('.ir-abajo').click(function(){ $('body,html').animate({ scrollTop:'1000px' },1000); });
}


//COOKIES
(() => {
    const getCookie = (name) => {
      const value = " " + document.cookie;
      const parts = value.split(" " + name + "=");
      return parts.length < 2 ? undefined : parts.pop().split(";").shift();
    };
  
    const setCookie = function (name, value, expiryDays, domain, path, secure) {
      const exdate = new Date();
      exdate.setHours(
        exdate.getHours() +
          (typeof expiryDays !== "number" ? 365 : expiryDays) * 24
      );
      document.cookie =
        name +
        "=" +
        value +
        ";expires=" +
        exdate.toUTCString() +
        ";path=" +
        (path || "/") +
        (domain ? ";domain=" + domain : "") +
        (secure ? ";secure" : "");
    };
  
    const $cookiesBanner = document.querySelector(".cookies");
    const $cookiesBannerButton = $cookiesBanner.querySelector("button");
    const cookieName = "cookiesBanner";
    const hasCookie = getCookie(cookieName);
  
    if (!hasCookie) {
      $cookiesBanner.classList.remove("hiden");
    }
  
    $cookiesBannerButton.addEventListener("click", () => {
      setCookie(cookieName, "closed");
      $cookiesBanner.remove();
    });
  })();
 
  //Cargando
  document.addEventListener("DOMContentLoaded", function() {
    var lazyImages = [].slice.call(document.querySelectorAll("img[data-src]"));

    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove("lazy");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
});

// BUSCADOR
$(document).on('ready', function() {
  
  $('.field').on('focus', function() {
    $('body').addClass('is-focus');
  });
  
  $('.field').on('blur', function() {
    $('body').removeClass('is-focus is-type');
  });
  
  $('.field').on('keydown', function(event) {
    $('body').addClass('is-type');
    if((event.which === 8) && $(this).val() === '') {
      $('body').removeClass('is-type');
    }
  });
  
});