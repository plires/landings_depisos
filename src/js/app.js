import $ from "jquery";
import WOW from 'wow.js/dist/wow.min.js'

window.setNextWhatsapp = function(rubro) {
	fetch('./../php/set-whatsapp.php', {
	  method: 'POST',
	  body: JSON.stringify({rubro: rubro})
	})
}

/* Cierra el seguidor de "Te llamamos ahora" */
$('#cerrar-seguidor').on('click', function(){
  $('#seguidor').slideToggle('slow');
});

$('#cerrar-seguidor-tel').on('click', function(){
  $('#seguidor-tel').slideToggle('slow');
});

$(function() {
  $('.btn_to_form').bind('click', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top - 350
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
  });
});

// Plugin Slick (Carrousel logos) Funcion
$('.galeria').slick({
	autoplay: true,
	autoplaySpeed: 1500,
	infinite: true,
	speed: 500,
	arrows: false,
	slidesToShow: 5,
	slidesToScroll: 1,
	responsive: [
	  {
	    breakpoint: 1200,
	    settings: {
	      slidesToShow: 4,
	      slidesToScroll: 1,
	      infinite: true,
	    }
	  },
	  {
	    breakpoint: 1024,
	    settings: {
	      slidesToShow: 3,
	      slidesToScroll: 1,
	      infinite: true,
	    }
	  },
	  {
	    breakpoint: 800,
	    settings: {
	      slidesToShow: 2,
	      slidesToScroll: 1
	    }
	  },
	  {
	    breakpoint: 480,
	    settings: {
	      slidesToShow: 1,
	      slidesToScroll: 1
	    }
	  }
	  // You can unslick at a given breakpoint now by adding:
	  // settings: "unslick"
	  // instead of a settings object
	]
});

// Inicializa Wow
new WOW().init();

// Validacion del Formulario
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();