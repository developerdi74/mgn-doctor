	var allCalc = $(".health-calc-description__img svg > *");

	allCalc.on("click", function () {
		let idPath = $(this).attr('id');
		let currCalcTitle = $(`.health-calc-item[data-hcalc="${idPath}"]`).children('h5').text();
		let textCalc = $(`.health-calc-item[data-hcalc="${idPath}"]`).children('.health-calc-item__text').text();

		$('.health-calc-description__info').slideDown();
		allCalc.removeClass("on");
		$(this).addClass("on");
		$('.health-calc-item').removeClass('health-calc-item--active');
		$(`.health-calc-item[data-hcalc="${idPath}"]`).addClass('health-calc-item--active');
		$('.health-calc-description__title').text(currCalcTitle);
		$('.health-calc-description__text').text(textCalc);
	});

