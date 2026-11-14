/* Herzog Dupont for YOOtheme Pro Copyright (C) 2019-2026 Thomas Weidlich GNU GPL v3 */

/**
 * Counts from start to the number and prints each value into the element.
 *
 * @param {HTMLElement} el
 * @param {number} start
 * @param {string|undefined} number The number as it was entered. Its decimals are kept.
 * @param {number} duration In milliseconds.
 * @param {string|undefined} separatorLocale
 */
function countUp(el, start, number, duration, separatorLocale) {
	const end = (number ?? '').trim() === '' ? NaN : Number(number);

	// Without a number to count to, the text printed by the server stays.
	if (!Number.isFinite(end)) {
		return;
	}

	// Show as many decimals as the number has, so that 12.5 ends at 12.5 and not at 13.
	const decimals = Math.min((number.split('.')[1] || '').trim().length, 20);
	const range = end - start;
	let timer;

	function show(value) {
		// Adding 0 turns -0 into 0.
		const rounded = Number(value.toFixed(decimals)) + 0;

		el.textContent = (separatorLocale === undefined)
			? rounded.toFixed(decimals)
			: rounded.toLocaleString(separatorLocale, { useGrouping: true, minimumFractionDigits: decimals, maximumFractionDigits: decimals });
	}

	// Nothing to animate.
	if (range === 0 || !(duration > 0)) {
		show(end);
		return;
	}

	const endTime = Date.now() + duration;

	function count() {
		const remaining = Math.max((endTime - Date.now()) / duration, 0);

		// The duration is over. The value shown below is then the end value.
		if (remaining === 0) {
			clearInterval(timer);
		}

		show(end - (remaining * range));
	}

	// One tick for each value that can be shown.
	timer = setInterval(count, Math.floor(duration / (Math.abs(range) * 10 ** decimals)));
	count();
}

UIkit.util.ready(_ => {
	// Register IntersectionObserver
	const io = new IntersectionObserver((entries) => {
		entries.forEach((entry) => {
			let el = entry.target;
			if (entry.intersectionRatio > 0 && !el.getAttribute('data-animated')) {
				let perimeter = 2 * Math.PI * el.dataset.radius,
					circle = el.querySelector('.counter-value'),
					numberEl = el.querySelector('.el-number'),
					svg = el.querySelector('.el-circle');

				if (svg) { svg.setAttribute('id', el.dataset.uniqid); }

				if (circle) {
					circle.style.strokeDashoffset = perimeter * (1 - el.dataset.percentage / 100);
					circle.style.strokeDasharray = perimeter;
				}

				if (numberEl) {
					countUp(numberEl, 0, el.dataset.number, Number(el.dataset.duration), el.dataset.separatorLocale);
				}

				el.setAttribute('data-animated', true);
			}
		});
	});

	// Declares what to observe, and observes its properties.
	const counterElList = document.querySelectorAll('.counter-container');
	counterElList.forEach((el) => {
		io.observe(el);
	});
});