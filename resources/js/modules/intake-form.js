// Imports
import Swal from 'sweetalert2';
import tippy from 'tippy.js';

// Constants
const INTAKE_FORM_REST_API_URL = templateObj.intakeFormRestApiUrl;
const IS_USER_LOGGED_IN = Boolean(templateObj.isUserLoggedIn);
const LOGGED_USER_ROLE = templateObj.loggedUserRole;
const doc = document;
const intakeFormStatus = doc.querySelector('.intake-form-container') ? doc.querySelector('.intake-form-container').getAttribute('data-post-status') : null;

doc.addEventListener("DOMContentLoaded", () => {
	showSiteMapByIntakeForm();
	disableIntakeFormFields();
	validateUnlockFieldsBtn();
	validateSubmitBtnForSingleIntakeForm();
	tooltipInit();
	backToTopBtnEventInit();
});

function showSiteMapByIntakeForm() {
	const showSitemapBtn = document.getElementById('showSitemapBtn');

	if(showSitemapBtn) {
		const intakeFormId = showSitemapBtn.getAttribute('data-intake-form-id');
		const intakeFormType = ($('#acf-new-intake-form').length > 0) ? 'new-intake-form' : 'intake-form';
		showSitemapBtn.addEventListener('click', function() {
			getIntakeFormData(intakeFormId, intakeFormType);
		});
	}
}

async function getIntakeFormData(intakeFormId = null, intakeFormType) {
	if (!intakeFormId || intakeFormType === 'new-intake-form') {
		var _siteMap = '';

		if($("#acf-new-intake-form").length !== 0) {
			let formattedData, isAnEliteClient, servicesList, extraServicesList, gallerySiteMap, testimonialSiteMap, addNonSeoPageList, nonSeoPagesList, getServicesPagesFn;
			let _formEL = $("#acf-new-intake-form")

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
		}

		Swal.fire({
			title: `<h4>Client's site map</h4>`,
			html: _siteMap
		});

		return;
	};

	const intakeFormData = await fetch(`${INTAKE_FORM_REST_API_URL}/${intakeFormId}`);
	const intakeFormDataJson = await intakeFormData.json();
	const isAnEliteClient = intakeFormDataJson?.acf?.account_details_group_field?.account_details_is_this_an_elite_client;
	const contentNotesData = intakeFormDataJson.acf.content_notes_group_field;
	const designData = intakeFormDataJson.acf.design_group;
	const isTestimonialPageAvailable = intakeFormDataJson?.acf?.plugins_other_tools_group?.plugin_tools_reviews_showcasing_on_the_site;
	const {
		content_notes_any_other_non_seo_pages,
		content_notes_non_seo_pages_data, 
		content_notes_elite_services_data,
		content_notes_services_data,
		content_notes_add_more_services,
		content_notes_extra_services 
	} = contentNotesData;
	const { design_group_building_out_a_gallery_page } = designData;

	Swal.fire({
		title: `<h4>Client's site map</h4>`,
		html: `
		<ul class="sitemap-wrapper scroll">
			<li class="sitemap-wrapper__item">Home</li>
			<li class="sitemap-wrapper__item">About Us</li>
			${ isArrayDataNotEmpty(content_notes_services_data) 
			|| isArrayDataNotEmpty(content_notes_extra_services)
			|| isArrayDataNotEmpty(content_notes_elite_services_data) ? '<li class="sitemap-wrapper__item">Services</li>' : ''}
			${ isAnEliteClient !== 'Yes' && isArrayDataNotEmpty(content_notes_services_data) ? getServicesPages(content_notes_services_data) : getServicesPages(content_notes_elite_services_data)}
			${content_notes_add_more_services != 'No' && isArrayDataNotEmpty(content_notes_extra_services) ? getServicesPages(content_notes_extra_services) : ''}
			${content_notes_any_other_non_seo_pages != 'No' && isArrayDataNotEmpty(content_notes_non_seo_pages_data) ? getNonSeoPages(content_notes_non_seo_pages_data) : ''}
			<li class="sitemap-wrapper__item">Areas We Serve</li>
			${ isTestimonialPageAvailable === 'Yes, on the homepage + a Testimonials page' ? '<li class="sitemap-wrapper__item">Testimonials</li>' : '' }
			${ design_group_building_out_a_gallery_page === 'Yes' || design_group_building_out_a_gallery_page ===  'Yes, but we do not have images yet' ? '<li class="sitemap-wrapper__item">Gallery</li>' : '' }
			<li class="sitemap-wrapper__item">Contact Us</li>
		</ul>`
	});
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

function getNewNonSeoPages(nonSeoPagesData) {
	var _keys = Object.keys(nonSeoPagesData);
	var _length = _keys.length;
	var html = '';

	for(var i=0; i < _length; i++) {
		if (nonSeoPagesData[_keys[i]].field_6818e613803cf !== '') {
			html += `<li class="sitemap-wrapper__item">${nonSeoPagesData[_keys[i]].field_6818e613803cf}</li>`;
		};
	}
	return html;
}

function getServicesPages(servicesData) {

	if (servicesData === null) {
		return '';
	}

	if (servicesData.length === 0) {
		return '';
	}

	let servicesString = '';
	
	servicesData.forEach(service => {
		if (service.title !== '') {
			if (service.is_this_a_header) {
				servicesString += `<li class="sitemap-wrapper__item sitemap-wrapper__service-item">${service.title}${getServicesSubPages(service.sub_services)}</li>`;
			} else {
				servicesString += `<li class="sitemap-wrapper__item sitemap-wrapper__service-item">${service.title}</li>`;
			}
		}
	});

	return `<ul class="sitemap-wrapper sitemap-wrapper--services-list-wrapper">${servicesString}</ul>`;
}

function getServicesSubPages(subServicesData) {

	if (subServicesData === null) {
		return '';
	}

	if (subServicesData.length === 0) {
		return '';
	}

	let subServicesString = '';
	
	subServicesData.forEach(subService => {
		if (subService.sub_services_title !== '') {
			subServicesString += `<li class="sitemap-wrapper__item sitemap-wrapper__service-item">${subService.sub_services_title}</li>`;
		}
	});

	return `<ul class="sitemap-wrapper sitemap-wrapper--services-list-wrapper sitemap-wrapper--sub-services-list-wrapper">${subServicesString}</ul>`;
}

function getNonSeoPages(nonSeoPagesData) {

	if (nonSeoPagesData === null) {
		return;
	}

	if (nonSeoPagesData.length === 0) {
		return;
	}

	let nonSeoPagesString = '';
	
	nonSeoPagesData.forEach(nonSeo => {
		nonSeoPagesString += `<li class="sitemap-wrapper__item">${nonSeo.page_title}</li>`;
	});

	return nonSeoPagesString;
}

function disableIntakeFormFields() {	
	if((IS_USER_LOGGED_IN && LOGGED_USER_ROLE === 'viewer') 
	|| (IS_USER_LOGGED_IN && LOGGED_USER_ROLE === 'onboarding_specialist' && intakeFormStatus === 'submitted') ) {
		if (doc.querySelector('.intake-form-box--content')) {
			doc.querySelectorAll('.acf-repeater.-table.-empty').forEach(htmlInput => htmlInput.parentElement.parentElement.remove());
			doc.querySelectorAll('.acfe-repeater-stylised-button').forEach(htmlInput => htmlInput.remove());
			doc.querySelectorAll('.acf-input input[type="text"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[id^="acf-field"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('select').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('textarea').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="radio"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="checkbox"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="file"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="submit"]').forEach(htmlInput => (htmlInput).parentElement.remove());
			doc.querySelectorAll('.acf-row-handle').forEach(htmlInput => {
				htmlInput.style.background = "#f4f4f4";
				htmlInput.style.color = "#aaa";
				htmlInput.classList.remove('order');
				htmlInput.classList.remove('ui-sortable-handle');
			});
			doc.querySelectorAll('.acf-row-handle.remove a.acf-icon').forEach(htmlInput => htmlInput.remove());


			if(doc.getElementById('save-btn')) doc.getElementById('save-btn').remove();
		}
	}

	if ( IS_USER_LOGGED_IN 
	&& LOGGED_USER_ROLE === 'administrator' 
	&& intakeFormStatus === 'submitted' ) {
		if (doc.querySelector('.intake-form-box--content')) {
			doc.querySelectorAll('.acf-repeater.-table.-empty').forEach(htmlInput => (htmlInput.parentElement.parentElement).style.display = 'none');
			doc.querySelectorAll('.acfe-repeater-stylised-button').forEach(htmlInput => htmlInput.style.display = 'none');
			doc.querySelectorAll('.acf-input input[type="text"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[id^="acf-field"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('select').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('textarea').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="radio"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="checkbox"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="file"]').forEach(htmlInput => htmlInput.setAttribute('disabled', 'true'));
			doc.querySelectorAll('input[type="submit"]').forEach(htmlInput => (htmlInput.parentElement).style.display = 'none');
			doc.querySelectorAll('.acf-row-handle').forEach(htmlInput => {
				htmlInput.style.background = "#f4f4f4";
				htmlInput.style.color = "#aaa";
				htmlInput.classList.remove('order');
				htmlInput.classList.remove('ui-sortable-handle');
			});
			doc.querySelectorAll('.acf-row-handle.remove a.acf-icon').forEach(htmlInput => htmlInput.style.display = 'none');

			if(doc.getElementById('save-btn')) doc.getElementById('save-btn').remove();
		}
	}
}

function validateUnlockFieldsBtn() {
	const unlockFormBtn = doc.getElementById('unlockFormBtn');

	if(unlockFormBtn) {
		const intakeFormId = unlockFormBtn.getAttribute('data-intake-form-id');

		unlockFormBtn.addEventListener('click', e => {
			e.preventDefault();
			e.stopPropagation();

			Swal.fire({
				title: 'Are you sure you want to unlock the form?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#473d83',
				cancelButtonColor: '#F54D40',
				confirmButtonText: 'Yes, unlock it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: templateObj.ajax_url,
						method: 'POST',
						data: {
							action: 'unlock_submitted_form',
							intakeFormId
						},
						success: function(response) {
							if(response.status_code === 403) {
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: `${response.message} Please, try again in a few moments.`,
								});
							}

							if(response.status_code === 404) {
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: `${response.message}`,
								});
							}

							if(response.status_code === 200) {
								Swal.fire({
									title: 'Unlocked!',
									text: 'The intake form has been unlocked.',
									showConfirmButton: false,
									icon: 'success'
								});
								setTimeout(() => {
									location.reload();
								}, 1500);
							}
						},
						error: function(xhr, status, error) {
							console.log('Ajax request failed: ' + error);
						}
					});
				}
			})
		});
	}	
}

function validateSubmitBtnForSingleIntakeForm() {
	if(doc.querySelector('.intake-form-box--content') ) {
		if ( (IS_USER_LOGGED_IN 
		&& LOGGED_USER_ROLE === 'administrator' 
		&& intakeFormStatus !== 'submitted') || IS_USER_LOGGED_IN 
		&& LOGGED_USER_ROLE === 'onboarding_specialist' 
		&& intakeFormStatus !== 'submitted' ) {
			if(doc.getElementById('submit-btn')) doc.getElementById('submit-btn').setAttribute('value',"SUBMIT");
		}
	}
}

function tooltipInit() {
	const saveBtn = doc.getElementById('save-btn');
	const showSitemapBtn = doc.getElementById('showSitemapBtn');
	const scrollToTopBtn = doc.getElementById('scrollToTopBtn');
	const unlockFormBtn = doc.getElementById('unlockFormBtn');

	if(saveBtn) {
		if(intakeFormStatus === 'in-progress') {		
			tippy(saveBtn, {
				content: 'Update Form',
				placement: 'left'
			});
		} else {
			tippy(saveBtn, {
				content: 'Save Form',
				placement: 'left'
			});
		}
	}

	if(showSitemapBtn) {
		tippy(showSitemapBtn, {
			content: "Show Client's Sitemap",
			placement: 'left'
		});
	}

	if(scrollToTopBtn) {
		tippy(scrollToTopBtn, {
			content: "Back To Top",
			placement: 'left'
		});
	}

	if(unlockFormBtn) {
		tippy(unlockFormBtn, {
			content: "Unlock Form",
			placement: 'left'
		});
	}
}

function backToTopBtnEventInit() {
	const scrollToTopBtn = doc.getElementById('scrollToTopBtn');

	if(scrollToTopBtn) {

		$(window).scroll(function() {
			if ($(window).scrollTop() > 0) {
				scrollToTopBtn.classList.add('show');
			} else {
				scrollToTopBtn.classList.remove('show');
			}
		});

		scrollToTopBtn.addEventListener('click', function(e) {
			e.stopImmediatePropagation();

			$('html, body').animate({scrollTop: $('div.main').offset().top - 150}, 800);
		});
	}
}

function isArrayDataNotEmpty(arrayData) {

	if (!Array.isArray(arrayData)) {
		return false;
	}

	if (arrayData === null || arrayData.length === 0) {
		return false;
	}

	let boolResult = false;
	let i = 0;

	for (i; i < arrayData.length; i++) {
		if ('title' in arrayData[i] && arrayData[i].title !== '') {
			boolResult = true;
			break;
		} else if('page_title' in arrayData[i] && arrayData[i].page_title !== '') {
			boolResult = true;
			break;
		}
	}

	return boolResult;
}
