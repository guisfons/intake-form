import Swal from "sweetalert2";

function getServicesPages(isAnEliteClient, servicesList, extraServices) {	
	if (!servicesList || typeof servicesList !== 'object') return '';

	var _keys = Object.keys(servicesList);
	var _length = _keys.length;
	var _html = '';

	const serviceTitle = isAnEliteClient !== 'Yes' ? servicesList[_keys[0]].field_64947b557df7c : servicesList[_keys[0]].field_67046226b376b;

	if(serviceTitle) {
		_html += '<li class="sitemap-wrapper__item">Services</li>';
		_html += '<ul class="sitemap-wrapper sitemap-wrapper--services-list-wrapper">';
		for(var i=0; i < _length; i++) {
			const serviceLoopIsParent = isAnEliteClient !== 'Yes' ? servicesList[_keys[i]].field_64e6767c2eb2e : servicesList[_keys[i]].field_670464f4b376d;
			const serviceLoopTitle = isAnEliteClient !== 'Yes' ? servicesList[_keys[i]].field_64947b557df7c : servicesList[_keys[i]].field_67046226b376b; 
			const serviceLoopSubServices = isAnEliteClient !== 'Yes' ? servicesList[_keys[i]].field_64e676ae2eb2f : servicesList[_keys[i]].field_670467f2b376e;

			if( serviceLoopIsParent === "1" ) {
				_html += `<li class="sitemap-wrapper__item">${serviceLoopTitle}${getServiceSubPages(isAnEliteClient, serviceLoopSubServices)}</li>`;
			}
			else {
				_html += `<li class="sitemap-wrapper__item">${serviceLoopTitle}</li>`;
			}
		}

		if( extraServices && typeof extraServices === 'object' ) {
			var _keysExtra = Object.keys(extraServices);
			var _lengthExtra = _keysExtra.length;

			for(var i=0; i < _lengthExtra; i++) {
				if( extraServices[_keysExtra[i]].field_64e8d748bdb81 === "1" ) {
					_html += `<li class="sitemap-wrapper__item">${extraServices[_keysExtra[i]].field_64a2f74960f4c}${getServiceSubPages(extraServices[_keysExtra[i]].field_64e8d7c9d5e0a, 'extra')}</li>`;
				}
				else {
					_html += `<li class="sitemap-wrapper__item">${extraServices[_keysExtra[i]].field_64a2f74960f4c}</li>`;
				}
			}
		}

		_html += '</ul>';
	}

	return _html;
}

function getServicesPagesNew(isAnEliteClient, servicesList, extraServices) {	
	if (!servicesList || typeof servicesList !== 'object') return '';

	var _keys = Object.keys(servicesList);
	var _length = _keys.length;
	var _html = '';

	const serviceTitle = isAnEliteClient !== 'Yes' ? servicesList[_keys[0]].field_681408a573dde : servicesList[_keys[0]].field_681a24e8bc700;

	if(serviceTitle) {
		_html += '<li class="sitemap-wrapper__item">Services</li>';
		_html += '<ul class="sitemap-wrapper sitemap-wrapper--services-list-wrapper">';
		for(var i=0; i < _length; i++) {
			const serviceLoopIsParent = isAnEliteClient !== 'Yes' ? servicesList[_keys[i]].field_68190128ec409 : servicesList[_keys[i]].field_681a24e8bc701;
			const serviceLoopTitle = isAnEliteClient !== 'Yes' ? servicesList[_keys[i]].field_681408a573dde : servicesList[_keys[i]].field_681a24e8bc700; 
			const serviceLoopSubServices = isAnEliteClient !== 'Yes' ? servicesList[_keys[i]].field_681908a16f249 : servicesList[_keys[i]].field_681a24e8bc702;

			if( serviceLoopIsParent === "1" ) {
				_html += `<li class="sitemap-wrapper__item">${serviceLoopTitle}${getNewServiceSubPages(isAnEliteClient, serviceLoopSubServices)}</li>`;
			}
			else {
				_html += `<li class="sitemap-wrapper__item">${serviceLoopTitle}</li>`;
			}
		}

		if( extraServices && typeof extraServices === 'object' ) {
			var _keysExtra = Object.keys(extraServices);
			var _lengthExtra = _keysExtra.length;

			for(var i=0; i < _lengthExtra; i++) {
				if( extraServices[_keysExtra[i]].field_64e8d748bdb81 === "1" ) {
					_html += `<li class="sitemap-wrapper__item">${extraServices[_keysExtra[i]].field_64a2f74960f4c}${getServiceSubPages(extraServices[_keysExtra[i]].field_64e8d7c9d5e0a, 'extra')}</li>`;
				}
				else {
					_html += `<li class="sitemap-wrapper__item">${extraServices[_keysExtra[i]].field_64a2f74960f4c}</li>`;
				}
			}
		}

		_html += '</ul>';
	}

	return _html;
}

function getServiceSubPages(isAnEliteClient = 'No', subPageList, type = 'default') {
	if (!subPageList || typeof subPageList !== 'object') return '';

	var _keys = Object.keys(subPageList);
	var _length = _keys.length;
	var _html = '';

	for(var i=0; i < _length; i++) {
		if( type === 'extra' ) {
			_html += `<li class="sitemap-wrapper__item">${subPageList[_keys[i]].field_64e8d7ffd5e0b}</li>`;
		}
		else {
			if (isAnEliteClient !== 'Yes') {
				_html += `<li class="sitemap-wrapper__item">${subPageList[_keys[i]].field_64e676ce2eb30}</li>`;
			} else {
				_html += `<li class="sitemap-wrapper__item">${subPageList[_keys[i]].field_670468ab703f5}</li>`;
			}
		}
	}

	return `<ul class="sitemap-wrapper sitemap-wrapper--services-list-wrapper sitemap-wrapper--sub-services-list-wrapper">${_html}</ul>`;
}

function getNewServiceSubPages(isAnEliteClient = 'No', subPageList, type = 'default') {
	if (!subPageList || typeof subPageList !== 'object') return '';

	var _keys = Object.keys(subPageList);
	var _length = _keys.length;
	var _html = '';

	for(var i=0; i < _length; i++) {
		if( type === 'extra' ) {
			_html += `<li class="sitemap-wrapper__item">${subPageList[_keys[i]].field_68230fe642468}</li>`;
		}
		else {
			if (isAnEliteClient !== 'Yes') {
				_html += `<li class="sitemap-wrapper__item">${subPageList[_keys[i]].field_68230fe642468}</li>`;
			} else {
				_html += `<li class="sitemap-wrapper__item">${subPageList[_keys[i]].field_682310a7a28e7}</li>`;
			}
		}
	}

	return `<ul class="sitemap-wrapper sitemap-wrapper--services-list-wrapper sitemap-wrapper--sub-services-list-wrapper">${_html}</ul>`;
}

function getNonSeoPages(nonSeoPagesData) {
	var _keys = Object.keys(nonSeoPagesData);
	var _length = _keys.length;
	var html = '';

	for(var i=0; i < _length; i++) {
		html += `<li class="sitemap-wrapper__item">${nonSeoPagesData[_keys[i]].field_6494c1d94cc54}</li>`;
	}
	return html;
}

function getNewNonSeoPages(nonSeoPagesData) {
	var _keys = Object.keys(nonSeoPagesData);
	var _length = _keys.length;
	var html = '';

	for(var i=0; i < _length; i++) {
		html += `<li class="sitemap-wrapper__item">${nonSeoPagesData[_keys[i]].field_6818e613803cf}</li>`;
	}
	return html;
}

jQuery(document).ready(function ($) {
	if ( typeof acf !== 'undefined' ) {
		acf.addAction("validation_success", ($el, json) => {
			var _formEL = $($el);
	
			_formEL.on("submit", (e) => {
				e.preventDefault();
				// acf.lockForm(_formEL);

				var _data = ''
				var _ifid = ''
				var post_Id = ''
				var submit_container = ''
	
				//Final Sitemap
				var formattedData = ''
				var isAnEliteClient = ''
				var servicesList = ''
				var extraServicesList = ''
				var gallerySiteMap = ''
				var testimonialSiteMap = ''
				var addNonSeoPageList = ''
				var nonSeoPagesList = ''
				var getServicesPagesFn = ''

				var action = '';

				if($("#acf-intake-form").length !== 0) {
					_data = $("#acf-intake-form").serialize();
					_ifid = 0;
					post_Id = $('#_acf_post_id').val();
					submit_container = $('#acf-intake-form .acf-form-submit');
		
					//Final Sitemap
					formattedData = acf.serialize(_formEL);
					isAnEliteClient = formattedData.acf.field_649376c46650f.field_615b13008023b;
					servicesList = isAnEliteClient !== 'Yes' ? formattedData.acf.field_6493793f80bd0.field_64947ae07df7b : formattedData.acf.field_6493793f80bd0.field_67046083b376a;
					extraServicesList = formattedData.acf.field_6493793f80bd0.field_64a2f6ff60f4b;
					gallerySiteMap = formattedData.acf.field_6494c543f63ce.field_6495c65d2d73c;
					testimonialSiteMap = formattedData?.acf?.field_6495cd17c65f2?.field_6495d4fbee548;
					addNonSeoPageList = formattedData.acf.field_6493793f80bd0.field_6494bf7a96b57;
					nonSeoPagesList = formattedData.acf.field_6493793f80bd0.field_6494c1b24cc53;

					getServicesPagesFn = getServicesPages(isAnEliteClient, servicesList, extraServicesList);

					action = 'custom_submit_function';
				}

				if($("#acf-new-intake-form").length !== 0) {
					_data = $("#acf-new-intake-form").serialize();
					_ifid = 0;
					post_Id = $('#_acf_post_id').val();
					submit_container = $('#acf-new-intake-form .acf-form-submit');
		
					//Final Sitemap
					formattedData = acf.serialize(_formEL);
					isAnEliteClient = formattedData.acf.field_6812442cb2949.field_6818c6e8ab657;
					if(isAnEliteClient === 'Elite' || isAnEliteClient === 'Elite Expansion') {
						isAnEliteClient = 'Yes';
					} else {
						isAnEliteClient = 'No';
					}
					servicesList = isAnEliteClient !== 'Yes' ? formattedData.acf.field_6812442cb2a3e.field_6814089273ddd : formattedData.acf.field_6812442cb2a3e.field_681a24e7bc6ff;
					extraServicesList = formattedData.acf.field_6812442cb2a3e.field_6812442cd50df;
					gallerySiteMap = formattedData.acf.field_6812442cb2a3e.field_6812442d40c98;
					testimonialSiteMap = formattedData?.acf?.field_6812442cb2a7c?.field_6812442d57a25;
					addNonSeoPageList = formattedData.acf.field_6812442cb2a7c.field_6818e54f803cd;
					nonSeoPagesList = formattedData.acf.field_6812442cb2a7c.field_6818e5e0803ce;

					getServicesPagesFn = getServicesPagesNew(isAnEliteClient, servicesList, '');

					action = 'new_custom_submit_function';
				}

				var _siteMap = '';
	
				_siteMap += `
					<ul class="sitemap-wrapper scroll">
						<li class="sitemap-wrapper__item">Home</li>
						<li class="sitemap-wrapper__item">About Us</li>
						${getServicesPagesFn}
						${addNonSeoPageList != 'No' ? getNewNonSeoPages(nonSeoPagesList) : ''}
						<li class="sitemap-wrapper__item">Areas We Serve</li>
						${testimonialSiteMap === 'Yes, on the homepage + a Testimonials page' ? '<li class="sitemap-wrapper__item">Testimonials</li>' : ''}
						${gallerySiteMap != 'No' ? '<li class="sitemap-wrapper__item">Gallery</li>' : ''}
						<li class="sitemap-wrapper__item">Contact Us</li>
					</ul>`;
	
				if ($('#submit-btn').data("ifid")) {
					_ifid = $('#submit-btn').data("ifid");
				} else {
					_ifid = post_Id;
				}
	
				Swal.fire({
					title: "<h4 class='popup-title'>Do you approve of the sitemap? If there are any pages that need to be added or removed, please go back to the corresponding section and do so there. Drag and drop to change the page's order.</h4>",
					html: _siteMap,
					showDenyButton: true,
					confirmButtonText: "Yes",
					denyButtonText: "No",
				}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire({
							title: "<h4 class='popup-title'>Do you want to submit this form? Please note that once you submit the form you won't be able to make any more changes.</h4>",
							showDenyButton: true,
							confirmButtonText: "Yes",
							denyButtonText: "No",
						}).then((result2) => {
							if (result2.isConfirmed) {
								$.ajax({
									url: templateObj.ajax_url,
									method: "POST",
									data: {
										action: action,
										info: _data,
										ifid: _ifid,
									},
									success: function (response) {
										submit_container.find('.acf-spinner.is-active').hide();
										if( response.success === true ) {
											Swal.fire({
												title: '',
												icon: 'success',
												html: "<div class='popup-success-message'>Great news! The form was submitted successfully which means the information is now locked. If you'd like to make any edits please contact your manager to have the form unlocked.</div>",
												showCloseButton: false,
												showCancelButton: false,
												showConfirmButton: false,
												focusConfirm: false
											}).then((result) => {
												if( response.type === 'insert' ) {
													window.location.replace(response.link);
												}
												else {
													window.location.reload();
												}
											});
										}
									},
									error: function (xhr, status, error) {
										console.log(error);
										console.log(
											"Ajax request failed: " + status
										);
									},
								});
							}
							else {
								submit_container.find('.acf-spinner.is-active').hide();
								acf.unlockForm(_formEL);
							}
						});
					} else {
						submit_container.find('.acf-spinner.is-active').hide();
						acf.unlockForm(_formEL);
					}
				});
			});
	
			acf.unlockForm(_formEL);
		});
	}
	
});
