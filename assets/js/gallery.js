let modalId = $('#image-gallery');
var currentImg;

$(document).ready(function () {

	$('body').on('click', '.transferImg', function () {
		let isi = $(this).find('.img-thumbnail').attr('src');
		$('.modal-bodyX').find('#image-gallery-image').attr('src', isi);
		currentImg = isi;
		// alert(isi);
	});

	$('body').on('click', '#show-next-image', function () {
		$('.transferImg').each(function () {
			if ($(this).find('.img-thumbnail').attr('src') == currentImg) {
				if ($(this).next('.transferImg').length) {
					let newIsi = $(this).next('.transferImg').find('.img-thumbnail').attr('src');
					currentImg = newIsi;
					$('.modal-bodyX').find('#image-gallery-image').attr('src', newIsi);
					// $('#show-previous-image').show();
					return false;
				} else {
					// $('#show-next-image').hide();
					return false;
				}

			}
		});
	});
	$('body').on('click', '#show-previous-image', function () {
		$('.transferImg').each(function () {
			if ($(this).find('.img-thumbnail').attr('src') == currentImg) {
				if ($(this).prev('.transferImg').length) {
					let newIsi = $(this).prev('.transferImg').find('.img-thumbnail').attr('src');
					currentImg = newIsi;
					$('.modal-bodyX').find('#image-gallery-image').attr('src', newIsi);
					// $('#show-next-image').show();
					return false;
				} else {
					// $('#show-previous-image').hide();
					return false;
				}

			}

		});
	});

	loadGallery(true, 'a.thumbnail');

	//This function disables buttons when needed
	function disableButtons(counter_max, counter_current) {
		$('#show-previous-image, #show-next-image')
			.show();
		if (counter_max === counter_current) {
			$('#show-next-image')
				.hide();
		} else if (counter_current === 1) {
			$('#show-previous-image')
				.hide();
		}
	}

	/**
	 *
	 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
	 * @param setClickAttr  Sets the attribute for the click handler.
	 */

	function loadGallery(setIDs, setClickAttr) {
		let current_image,
			selector,
			counter = 0;

		$('#show-next-image, #show-previous-image')
			.click(function () {
				if ($(this)
					.attr('id') === 'show-previous-image') {
					current_image--;
				} else {
					current_image++;
				}

				selector = $('[data-image-id="' + current_image + '"]');
				updateGallery(selector);
			});

		function updateGallery(selector) {
			let $sel = selector;
			current_image = $sel.data('image-id');
			$('#image-gallery-title')
				.text($sel.data('title'));
			$('#image-gallery-image')
				.attr('src', $sel.data('image'));
			disableButtons(counter, $sel.data('image-id'));
		}

		if (setIDs === true) {
			$('[data-image-id]')
				.each(function () {
					counter++;
					$(this)
						.attr('data-image-id', counter);
				});
		}
		$(setClickAttr)
			.on('click', function () {
				updateGallery($(this));
			});
	}
});

// build key actions
$(document)
	.keydown(function (e) {
		switch (e.which) {
			case 37: // left
				if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
					$('#show-previous-image')
						.click();
				}
				break;

			case 39: // right
				if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
					$('#show-next-image')
						.click();
				}
				break;

			default:
				return; // exit this handler for other keys
		}
		e.preventDefault(); // prevent the default action (scroll / move caret)
	});
