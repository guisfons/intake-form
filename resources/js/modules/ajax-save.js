import Swal from 'sweetalert2';

jQuery(document).ready(function($) {
    $('#save-btn').unbind().bind('click', function(e) {
        e.preventDefault();

        var formData = $('#acf-intake-form').serialize();
        var _this = $(this);
        var _ifid = 0;
        var post_Id = $('#_acf_post_id').val();
        var _message = $(this).data('message');
        var action = ''
        var title = ''

        if($('#acf-intake-form').length > 0) {
            formData = $('#acf-intake-form').serialize();
            action = 'save_intake_form_data';
            formTitle = $('#acf-intake-form #acf-field_64a4329fea877')
            title = '#acf-field_64a4329fea877'
        } else if($('#acf-new-intake-form').length > 0) {
            formData = $('#acf-new-intake-form').serialize();
            action = 'save_new_intake_form_data';
            formTitle = $('#acf-new-intake-form #acf-field_6812442cb2949-field_6812442cb2904')
            title = '#acf-field_6812442cb2949-field_6812442cb2904'
        }


        _this.prop('disabled', true);

        if( _this.data('ifid') ) {
            _ifid = _this.data('ifid');
        }
        else {
            _ifid = post_Id;
        }

        if( formTitle.val().length !== 0 ) {
            $.ajax({
                url: templateObj.ajax_url,
                method: 'POST',
                data: {
                    action: action, // Use the action name specified in the PHP function
                    info: formData,
                    ifid: _ifid
                },
                beforeSend: function() {
                    Swal.fire({
                        'title': _message,
                        showConfirmButton: false,
                        width: '100%',
                        heightAuto: false,
                        color: '#FFFFFF',
                        backdrop: '#918d8d',
                        background: 'transparent',
                        'customClass': {
                            'container': 'acf-custom-loader'
                        }
                    });
                },
                success: function(response) {
                    if( response.success == true ) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            html: '',
                            showCloseButton: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            focusConfirm: false
                        }).then((result) => {
                            _this.attr('data-ifid', response.post_id);
                            _this.prop('disabled', false);
                            if( response.type === 'insert' ) {
                                $(window).off('beforeunload');
                                window.location.replace(response.link);
                            } else {
                                $(window).off('beforeunload');
								window.location.reload();
							}
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Ajax request failed: ' + status);
                }
            });
        } else {
            Swal.fire({
                title: 'Client Business Name is required!',
                icon: 'error',
                html: '',
                showCloseButton: false,
                showCancelButton: false,
                focusConfirm: false
            }).then((result) => {
                $('html, body').animate({
                    scrollTop: $('#acf-field_64a4329fea877').offset().top - 200
                }, 300);
            });

            _this.prop('disabled', false);
        }

        if( $('#acf-new-intake-form #acf-field_6812442cb2904').val().length !== 0 ) {
            $.ajax({
                url: templateObj.ajax_url,
                method: 'POST',
                data: {
                    action: 'save_new_intake_form_data', // Use the action name specified in the PHP function
                    info: formData,
                    ifid: _ifid
                },
                beforeSend: function() {
                    Swal.fire({
                        'title': _message,
                        showConfirmButton: false,
                        width: '100%',
                        heightAuto: false,
                        color: '#FFFFFF',
                        backdrop: '#918d8d',
                        background: 'transparent',
                        'customClass': {
                            'container': 'acf-custom-loader'
                        }
                    });
                },
                success: function(response) {
                    if( response.success == true ) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            html: '',
                            showCloseButton: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            focusConfirm: false
                        }).then((result) => {
                            _this.attr('data-ifid', response.post_id);
                            _this.prop('disabled', false);
                            if( response.type === 'insert' ) {
                                $(window).off('beforeunload');
                                window.location.replace(response.link);
                            } else {
                                $(window).off('beforeunload');
								window.location.reload();
							}
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Ajax request failed: ' + status);
                }
            });
        } else {
            Swal.fire({
                title: 'Client Business Name is required!',
                icon: 'error',
                html: '',
                showCloseButton: false,
                showCancelButton: false,
                focusConfirm: false
            }).then((result) => {
                $('html, body').animate({
                    scrollTop: $('#acf-field_6812442cb2949-field_6812442cb2904').offset().top - 200
                }, 300);
            });

            _this.prop('disabled', false);
        }
    });
});
