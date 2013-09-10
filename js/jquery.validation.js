/**
** Copyright ? Larry Wakeman - 2009
**
** All rights reserved. No part of this publication may be reproduced, stored in a retrieval system, 
** or transmitted in any form or by any means without the prior written permission of the copyright
** owner and must contain the avove copyright notice.
**
** This script is licensed nder the GPL license..
*/
/*
    This script can be used to validate a form or a control.
          
    This script requires jQuery.
    
    To load this script, use the following:

        <script language="JavaScript" src="validation.js"></script>
        <script language="JavaScript">
            var valid = new validate();
        </script>
    
    The form definitions should be as follows:
    
        <form method="POST" action="targetPage" name="FormName" id="FormName" onsubmit="return valid.validateForm(this);">
    
    Items to be validated should be described as follows:
        
        <label for="FacilityState">Facility State</label>
        <input type="text" name="FacilityState" id="FacilityState" class="a list of validations and other classes" size="3" onchange="javascript: valid.validateInput(this);">
        <div id="FacilityStateError" class="validationError" style="display:none;"></div>
    
You might be able to use onblur events but if you display a popup, that gets to be problematic and by default, this script creates a popup.

You can also put a div as follows on your page to display any validation errors from the form:

        <div id="ValidationError" class="validationError" style="display: none;"></div>

Valid validations are:
    
        required
        email
        date - in dd-mon-yyyy,  dd-mm-yyyy, yyyy-mon-dd or yyyy-mm-dd formats
        time
        currency
        numeric
        alphanumeric
        alpha
        phone
        state
        zipcode
        urlentry
        
*/

function validate() {

/**
 * Method to setup to validate an input
 */
    this.validateInput = function(ctrl) {
        var id = ($(ctrl).attr('id'));
        $('validationError').hide();
        $('validationError').html('');
        return this.checkInput(ctrl);
        return false;
    };
    
/**
 * Method to validate an input
 */
    this.checkInput = function (ctrl) {
        var valid =true;
        var id = ($(ctrl).attr('id'));
        $('#' + id + 'Error').hide();
        $('#' + id + 'Error').html('');
        var label = $('label[for="' + id + '"]').text();
        if ($(ctrl).hasClass('required')) {
            if (!this.isRequired(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'This field is required<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is required<br>');
                $('#validationError').show();
                return false;
            }
        }
        if ($(ctrl).hasClass('email')) {
            if (!this.isEmail(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid email address.<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' has an invalid email address.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('date')) {
            if (!this.isDate(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid date.<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is an invalid date.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('time')) {
            if (!this.isTime(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid time.<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is an invalid time.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('currency')) {
            if (!this.isCurrency(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid currency.<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is an invalid currency.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('numeric')) {
            if (!this.isNumeric(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Non numeric value<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is a non numeric value.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('alphanumeric')) {
            if (!this.isAlphaNumeric(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Non alpha-numeric value<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is a non alpha-numeric value.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('alpha')) {
            if (!this.isAlpha(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Non alphabetic value<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is a non alphabetic value.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('phone')) {
           if (!this.isPhone(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid phone number<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is as invalid phone number.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('state')) {
           if (!this.isState(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid State<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is as invalid State.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('zipcode')) {
           if (!this.isZipcode(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid Zip Code<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is as invalid Zip Code.<br>');
                valid = false;
            }
        }
        if ($(ctrl).hasClass('urlentry')) {
            if (!this.isInternetURL(ctrl)) {
                $('#' + id + 'Error').html($('#' + id + 'Error').html() + 'Invalid URL<br>');
                $('#' + id + 'Error').show();
                $('#validationError').html($('#validationError').html() + label + ' is as invalid URL.<br>');
                valid = false;
            }
        }
        if (!valid) $('#' + id + 'Error').show();
        return valid;
    };
    
/**
 * Method to find all the descendants of a form that can be validated
 */
    this.checkChild  = function (ctrl) {
        var children = $(ctrl).children();
        var valid =true;
        for (var i = 0; i < children.size(); i++) {
            if ($(children[i]).is('input') ||$(children[i]).is('textarea')) {
                valid = valid & this.checkInput($(children[i]));
            } else {
                valid = valid & this.checkChild(children[i]);
            }
        }
        return valid;
    };

/**
 * Method to validate a form
 */
    this.validateForm = function(ctrl) {
        $('.validationError').html('');
        if (this.checkChild(ctrl)) {
            return true;
        }
        $('.validationError').show();
        return false;
    };
    
/**
 * Method to check that required field is not empty
 */
    this.isRequired = function (ctrl) {
        if ($(ctrl).val().length == 0) return false;
        if ($(ctrl).val() == "") return false;
        return true;
	};

/**
 * Method to check that email field is formatted properly
 */
    this.isEmail = function (ctrl) {
        if ($(ctrl).val().length != 0) {
            if ($(ctrl).val().lastIndexOf(".") > 2) {
                if ($(ctrl).val().lastIndexOf("@") > 0) {
                    if ($(ctrl).val().lastIndexOf(".") > $(ctrl).val().indexOf("@")) {
                        return true;
                    }
                }
            }
        }else{
            return true;
        }
        return false;
    };
 
/**
 * Method to check that field is numeric
 */
	this.isNumeric = function (ctrl) {
        if (this.isRequired(ctrl)) {
    		if (isNaN($(ctrl).val())) {
    		    return false;
    		}
		}
        return true;
	};

/**
 * Method to check that field is a decimal value
 */
	this.isDecimal = function (number) {
        if (this.isRequired(value)) {
            var stripped = value.replace(/[\.]/g, '');
    		if (isNaN(number)) {
    		    return false;
    		}
		}
        return true;
	};

/**
 * Method to check that field is an unsigned number
 */
	this.isUnsignedNumber = function (number) {
        if (this.isRequired(value)) {
    		if (isNaN(number)) {
    		    return false;
    		}
    		if ((number.indexOf("-") != 0) || (number.indexOf("+") != 0)) {
    		    return false;
    		}
		}
        return true;
	};

/**
 * Method to check that field is Alpha numeric
 */
	this.isAlphaNumeric = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var reAlphanumeric = /^[a-zA-Z0-9]+$/
            return reAlphanumeric.test($(ctrl).val());
		}
        return true;
	};

/**
 * Method to check that required field is Alphabetic
 */
	this.isAlpha = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var reAlphabetic = /^[a-zA-Z]+$/
            return reAlphabetic.test($(ctrl).val());
		}
        return true;
	};

/**
 * Method to check that field is a date
 */
    this.isDate = function (ctrl) {        
        var value = $(ctrl).val();
        var leapYear = false;
        var days;
        var months = ',Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec,';
        var dateParts = new Array();
        dateParts = value.split('-');
        if (dateParts[0].length == 4) {
            var temp = dateParts[0];
            dateParts[0] = dateParts[2];
            dateParts[2] = temp;
        }
        if (!isNaN(dateParts[0])) {
            if (!isNaN(dateParts[2])) {
                if (!isNaN(dateParts[1])) {
                    dateParts[1] = months.substring(((dateParts[1] - 1) * 4 + 1), ((dateParts[1] - 1) * 4 + 4));
                }
                if (months.indexOf(dateParts[1])) {
                    if (dateParts[0].length == 2) {
                        if (dateParts[2].length == 4) {
                            if ((dateParts[2] % 4) == 0) {
                                if ((dateParts[2] % 100) != 0) {
                                    leapYear = true;
                                } else if ((dateParts[2] % 400) == 0) {
                                    leapYear = true;
                                } else {
                                    leapYear = true;
                                }
                            }
                            if (dateParts[2] > 1900) {
                                if (dateParts[2] < 2100){
                                    if (dateParts[0] > 0) {
                                        switch (months.indexOf(dateParts[1])) {
                                        case 1: //JAN
                                        case 9: //MAR
                                        case 17: //MAY
                                        case 25: //JUL
                                        case 29: //AUG
                                        case 37: //OCT
                                        case 45: //DEC
                                            if (dateParts[0] < 32) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                            break;
                                        case 13: //APR
                                        case 21: //JUN
                                        case 33: //SEP
                                        case 31: //NNOV
                                            if (dateParts[0] < 31) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                            break;
                                        case 5: //FEB
                                            if (leapYear) {
                                                days = 29;
                                            } else {
                                                days = 28;
                                            }
                                            if (dateParts[0] < days) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                            break;
                                        default:
                                            return false;
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return false;
    };

/**
 * Method to check that field is a valid state
 */
	this.isState = function (ctrl) {
	    var states =",AL,AK,AZ,AR,CA,CO,CT,DE,DC,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MD,MA,MI,MN,MS,MO,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY,";
        if (this.isRequired(ctrl)) {
    		if ($(ctrl).val().length != 2) {
    		    return false;
    		}
    		if (states.indexOf($(ctrl).val()+",") == -1) {
    		    return false;
    		}
		}
        return true;
	};

/**
 * Method to check that field is a URL
 */
	this.isInternetURL = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var temp = $(ctrl).val().toLowerCase();
            if (temp.substring(0,4) != 'http') return false;
            temp = temp.substring(4);
            if (temp.substring(0, 1) == 's') temp = temp.substring(1);
            if (temp.substring(0, 3) != '://') return false;
            temp = temp.substring(3);
            if (temp.indexOf('/') ==  -1) {
                if (temp.indexOf('.') ==  -1) return false;
            } else {
                if (temp.indexOf('.') >  temp.inindexOfdex('/')) return false;
            }
		}
		return true;
	};

/**
 * Method to check that field is a tme
 */
	this.isTime = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var timePat = /^(\d{1,2}):(\d{2})?(\s?(AM|am|PM|pm))?$/;
            var matchArray = $(ctrl).val().match(timePat);
            if (matchArray == null) {
                return false;
            }
            hour = matchArray[1];
            minute = matchArray[2];
            ampm = matchArray[4];
            
            if (ampm=="") { 
                return false; 
            }
            if (hour < 0  || hour > 12) {
                return false;
            }
            if (minute<0 || minute > 59) {
                return false;
            }
            return true;
        }
        return true;
	};
	
/**
 * Method to check that field is currency
 */
	this.isCurrency = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var value = $(ctrl).val();
            if (value.substring(0,1) == '$') value = value.substring(1);
            var parts = value.split('.');
    		if (!isNaN(parts[0]) && !isNaN(parts[1])) {
    		    return true;
    		} else {
    		    return false;
    		}
		}
	};
	
/**
 * Method to check that field is a sip code
 */
	this.isZipcode  = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var stripped = $(ctrl).val().replace(/[\-]/g, '');
            if (isNaN(stripped)) {
               return false;
            }
            if ((stripped.length == 5)) {
            	return true;
            }
            if ((stripped.length == 9)) {
            	return true;
            }
            return false;
        }
        return true;
	};

/**
 * Method to check that field is a phone number
 */
	this.isPhone  = function (ctrl) {
        if (this.isRequired(ctrl)) {
            var stripped = $(ctrl).val().replace(/[\-\ ]/g, '');
            if (isNaN(stripped)) {
               stripped = stripped.replace(/[ext]/g, '');
               if (isNaN(stripped)) {
                   return false;
               }
            } else {
                if (stripped.length != 10) {
            	    return false;
            	}
            }
        }
	    return true;
	};
}
