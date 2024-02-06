<script>

	$('.my-select').selectpicker();

      var swiper = new Swiper(".mySwiper-1", {
		loop:true,
		dots:true,
		//nav:true,
		autoplay: {
			delay: 3000,
		},

		 navigation: {
          nextEl: ".swiper-button-next-1",
          prevEl: ".swiper-button-prev-1",
		  //loop: true
        },

        pagination: {
          el: ".swiper-pagination-banner",
		   clickable: true,
        },
        mousewheel: false,
        keyboard: false,
      });


	  var swiper = new Swiper(".mySwiper-2", {
        slidesPerView: 5,
        spaceBetween: 20,
		loop:true,
		autoplay: {
			delay: 1000,
		},
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		breakpoints: {
          360: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
		  600: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 4,
            spaceBetween: 20,
          },
          1200: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
		  1920: {
            slidesPerView: 5,
            spaceBetween: 20,
          },

        },

      });

	  var swiper = new Swiper(".mySwiper-3", {
        slidesPerView: 3,
        spaceBetween: 30,
		autoplay: {
			delay: 2000,
		},

        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		breakpoints: {
		360: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          600: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
		  768: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
		  1200: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
		  1400: {
            slidesPerView: 3,
            spaceBetween: 20,
          },


        },
      });


		$(function() {
	$('[data-decrease]').on('click', decrease);
	$('[data-increase]').click(increase);
	$('[data-value]').change(valueChange);
});

function decrease() {
	var value = $(this).parent().find('[data-value]').val();
	if(value > 0) {
		value--;
		$(this).parent().find('[data-value]').val(value);
	}
}

function increase() {
	var value = $(this).parent().find('[data-value]').val();
	if(value < 100) {
		value++;
		$(this).parent().find('[data-value]').val(value);
	}
}

function valueChange() {
	var value = $(this).val();
	if(value == undefined || isNaN(value) == true || value <= 0) {
		$(this).val(0);
	} else if(value >= 101) {
		$(this).val(100);
	}
}


$(document).ready(function(){
  $(".plus").click(function(){
    $(this).toggleClass("active");

  });
});
$(document).ready(function(){
  $(".c-heart").click(function(){
    $(this).toggleClass("active");

  });
});


jQuery(document).ready(function(){
			setTimeout(function(){
				dlabSettingsOptions.version = 'light';
				new dlabSettings(dlabSettingsOptions);
			},1500)
		});



</script>
