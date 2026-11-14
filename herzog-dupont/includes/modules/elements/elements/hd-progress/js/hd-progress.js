/* Herzog Dupont for YOOtheme Pro Copyright (C) 2018-2026 Thomas Weidlich GNU GPL v3 */

UIkit.util.ready(() => {

	// Reads a number from an attribute. A missing or empty attribute is not a number.
	const number = (el, name) => {
		const value = el.getAttribute(name);
		return value === null || value.trim() === '' ? NaN : Number(value);
	};

	UIkit.util.$$('.hd-progress progress').forEach(bar => {

		UIkit.scrollspy(bar, { hidden: false });

		UIkit.util.on(bar, 'inview', function() {

			const bar   = this,
			      // The browser caps the value at max, so that is as far as the bar can go.
			      stop  = Math.min(number(bar, 'data-stop'), bar.max),
			      step  = number(bar, 'data-step'),
			      speed = number(bar, 'data-speed');

			// Without a stop value there is nothing to animate towards.
			if (!Number.isFinite(stop)) {
				return;
			}

			// The bar is already there, or step size and speed do not describe an animation.
			if (bar.value >= stop || !(step > 0) || !(speed >= 0)) {
				bar.value = stop;
				return;
			}

			const animate = setInterval(() => {

				bar.value = Math.min(bar.value + step, stop);

				if (bar.value >= stop) {
					clearInterval(animate);
				}

			}, speed);

		});

	});

});
