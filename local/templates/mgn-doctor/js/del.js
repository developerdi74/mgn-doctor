
	// POPULAR SERVICES
	if ($('#popular-services__owl').length > 0) {
		let owlServices = $("#popular-services__owl");
		owlServices.owlCarousel({
			items: 3,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000, /*автопрокрутка время в мс*/
			singleItem: false,
			speed: 900,
			dots: false,
			margin: 13,
			nav: false,
			onInitialized: carouselInitialized,
			responsive: {
				0: {
					items: 1
				},
				550: {
					items: 1
				},
				768: {
					items: 2
				},
				1000: {
					items: 3
				}
			}

		});

		$(".popular-services__nav .slider__nav-next").click(function () {
			owlServices.trigger("next.owl.carousel");
		});
		$(".popular-services__nav .slider__nav-prev").click(function () {
			owlServices.trigger("prev.owl.carousel");
		});

		// Равная высота заголовков слайдера
		function carouselInitialized(event) {
			function equalHeightSlider(selector) {
				var tallest = 0;
				jQuery(selector).each(function () {
					var thisHeight = jQuery(this).height();
					if (thisHeight > tallest) {
						tallest = thisHeight;
					}
				});
				jQuery(selector).height(tallest);
			}
			equalHeightSlider(".popular-services__owl .services-item__title");
		}
	}