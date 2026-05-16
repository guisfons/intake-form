<?php 
/**
 * Services Repeater Field
 *
 * PHP version 8
 *
 * @category Themes
 * @package  Theme_Acf
 * @author   Product Developers <productdev@ollyolly.com>
 * @license  GPL-2.0-or-later http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
 
/**
 * Enabling Add More Services Button Func
 *
 * @param array $field Services Repeater Field
 *
 * @return $field Array
 */
function Enable_Add_Btn_Services_repeater($field)
{
    $current_user = wp_get_current_user();
    $current_roles = ( array ) $current_user->roles;
    $current_user_rol = $current_roles[0];
    
    if ((is_user_logged_in() 
        && $current_user_rol === 'administrator'
        && is_page('new-intake-form'))
        || (is_user_logged_in() 
        && $current_user_rol === 'administrator'
        && is_singular('intake-form'))
        || (is_user_logged_in()
        && $current_user_rol === 'onboarding_specialist'
        && is_page('new-intake-form'))
        || (is_user_logged_in() 
        && $current_user_rol === 'onboarding_specialist'
        && is_singular('intake-form'))
    ) {
        ?>
            <script type='text/javascript'> 
                const doc = document;

                doc.addEventListener("DOMContentLoaded", () => {
                    acf.addAction('append', function($el) {
                        const servicesRepeaterFieldStylisedButton = $el[0].parentElement.parentElement.nextElementSibling;

                        if (getCurrentServicesRows() === 5) {
                            const addServiceBtn = servicesRepeaterFieldStylisedButton.querySelector('a.acf-button');
                            
							if(addServiceBtn) {
								if (addServiceBtn.textContent === 'Add Service') {
									servicesRepeaterFieldStylisedButton.style.display = 'none';
									enableAddMoreServicesField();
								}
							}
                        }
                    });
                    
                    acf.addAction('remove', function($el) {
                        const servicesRepeaterFieldStylisedButton = $el[0].parentElement.parentElement.nextElementSibling;

                        if (getCurrentServicesRows() <= 5) {
                            const addServiceBtn = servicesRepeaterFieldStylisedButton.querySelector('a.acf-button');

							if(addServiceBtn) {
								if (addServiceBtn.textContent === 'Add Service'){                        
									servicesRepeaterFieldStylisedButton.style.display = 'block';
									doc.querySelector('div[data-name="content_notes_add_more_services"]').style.display = 'none';
								}
							}
                        }
                    });

                    function enableAddMoreServicesField() {
                        doc.querySelector('div[data-name="content_notes_add_more_services"]').style.display = 'block';
                    }

                    function getCurrentServicesRows() {
                        const servicesRepeaterFieldTableBodyRows = doc.querySelector('div[data-name="content_notes_services_data"] div.acf-input div.acf-repeater table.acf-table tbody.ui-sortable');
                        let servicesRepeaterFieldFilteredRows = [];
                        let i = 0;

                        if (servicesRepeaterFieldTableBodyRows) {
                            const servicesRepeaterFieldTableBodyRowsChildren = servicesRepeaterFieldTableBodyRows.children;
                            
                            for(i; i < servicesRepeaterFieldTableBodyRowsChildren.length; i++) {
                                if (!servicesRepeaterFieldTableBodyRowsChildren[i].classList.contains('acf-clone')
                                && !servicesRepeaterFieldTableBodyRowsChildren[i].classList.contains('-hover')) {
                                    servicesRepeaterFieldFilteredRows.push(servicesRepeaterFieldTableBodyRowsChildren[i]);
                                }
                            }

                            return servicesRepeaterFieldFilteredRows.length;
                        }
                    }
                });
            </script>
        <?php
    }
    return $field;
}
add_filter(
    'acf/load_field/name=content_notes_services_data', 
    'Enable_Add_Btn_Services_repeater'
);
