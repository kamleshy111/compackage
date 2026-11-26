jQuery(window).on('load', function (e) {
	if (jQuery('#teste-scroller').length > 0) {
		jQuery("#teste-scroller").simplyScroll({
			orientation: 'vertical',
			auto: true,
			frameRate: 20,
			pauseOnHover: true,
			speed: 2
		});
	}
	jQuery('#hamburger-menu').click(function (e) {
		jQuery('#mobile-menu').slideToggle();
	});
	jQuery('#sidebar ul li.hasChild').each(function (index, element) {
		jQuery(this).click(function (e) {
			jQuery(this).find('.dash-submenu').show();
			jQuery('.dash-submenu').not(jQuery(this).find('.dash-submenu')).hide();
		});
	});

	jQuery('#fullmenu1').mouseenter(function () {
		jQuery('#full-menu1').slideDown();
		jQuery('#full-menu2').hide();
		jQuery('#full-menu3').hide();

	});
	jQuery('#full-menu1').mouseleave(function () {
		jQuery(this).hide();

	});
	jQuery('#fullmenu2').mouseenter(function () {
		jQuery('#full-menu2').slideDown();
		jQuery('#full-menu1').hide();
		jQuery('#full-menu3').hide();
	});
	jQuery('#full-menu2').mouseleave(function () {
		jQuery(this).hide();

	});
	jQuery('#fullmenu3').mouseenter(function () {
		jQuery('#full-menu3').slideDown();
		jQuery('#full-menu1').hide();
		jQuery('#full-menu2').hide();

	});
	jQuery('#full-menu3').mouseleave(function () {
		jQuery(this).hide();

	});

	jQuery('.cphaschild-menu').mouseenter(function () {
		jQuery(this).find(".sub-menu").toggleClass('block hidden');

	}).mouseleave(function () {
		jQuery(this).find(".sub-menu").toggleClass('hidden block');

	});
});
jQuery(document).ready(function () {
    jQuery('.scroll-element').click(function (event) {
        event.preventDefault();
        jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top }, 1500);
    });

    jQuery('.vue-swatches__trigger').addClass('absolute top-0');
    jQuery('.vue-swatches__trigger').css('border-radius', '0.5rem', '!important');
    jQuery(this).addClass('active');
    if (jQuery(window).width() < 1024) {
        jQuery('.comdrop-down').addClass('absolute invisible opacity-0');
        jQuery('#sidebar-items .dash-submenu').addClass('shadow shadow-gray-300 w-44 top-3 z-10 left-11 absolute bg-gray-50');
        jQuery('#sidebar-items .dash-submenu li').addClass('hover:bg-gray-200');
        jQuery('#sidebar-items .dash-submenu li').removeClass('rounded-lg');
        jQuery('#sidebar-items li').find('.menu-txt').addClass('absolute invisible opacity-0');
        jQuery('#collps-menu').click(function (e) {
            jQuery(this).parents('.aside-bar').toggleClass('w-14 w-60');
            jQuery('#sidebar-items .dash-submenu li').toggleClass('rounded-lg');
            jQuery('#sidebar-items .dash-submenu li').toggleClass('hover:bg-gray-200');
            jQuery('#sidebar-items .dash-submenu').toggleClass('shadow shadow-gray-300 w-44 top-3 z-10 left-11 absolute bg-gray-50');
            jQuery('#sidebar-items li').find('.menu-txt').toggleClass('absolute invisible opacity-0');
        });
    } else {
        if (parseInt(localStorage.getItem("background"))) {
            jQuery('#sidebar-items .dash-submenu').addClass('shadow shadow-gray-300 w-44 top-3 z-10 left-11 absolute bg-gray-50');
            jQuery('#sidebar-items .dash-submenu li').addClass('hover:bg-gray-200');
            jQuery('#sidebar-items .dash-submenu li').removeClass('rounded-lg');
            jQuery('#collps-menu').parents('.aside-bar').addClass('lg:w-14 active').removeClass('lg:w-64');
            jQuery('#sidebar-items li').find('.comdrop-down').addClass('absolute invisible opacity-0');
            //subMenuList();
            jQuery('#sidebar-items li').find('a').removeClass('lg:px-4 lg:hover:bg-gray-200');
            jQuery('#sidebar-items li').find('a').addClass('px-0 lg:hover:bg-transparent ');
            jQuery('#sidebar-items li').find('.menu-txt').addClass('absolute invisible opacity-0');
        } else {
            jQuery('#sidebar-items .dash-submenu').removeClass('shadow shadow-gray-300 w-44 top-3 z-10 left-11 absolute bg-gray-50');
            jQuery('#sidebar-items .dash-submenu li').removeClass('hover:bg-gray-200');
            jQuery('#sidebar-items .dash-submenu li').addClass('rounded-lg');
            setTimeout(function () {
                jQuery('#sidebar .dash-submenu').each(function (e) {
                    if (jQuery(this).find('li').hasClass('active')) {
                        jQuery(this).css('display', 'block');
                    }
                });
            }, 1000);
            jQuery('#sidebar-items li').find('.menu-txt').removeClass('absolute invisible opacity-0');
            jQuery('#collps-menu').parents('.aside-bar').removeClass('lg:w-14 active').addClass('lg:w-64');
            jQuery('#sidebar-items li').find('.comdrop-down').addClass('absolute');
            jQuery('#sidebar-items li').find('a').addClass('lg:px-4 lg:hover:bg-gray-200');
            jQuery('#sidebar-items li').find('a').removeClass('lg:px-0 lg:hover:bg-transparent');

        }


        jQuery('#collps-menu').click(function () {
            jQuery('#sidebar-items .dash-submenu li').toggleClass('rounded-lg');
            jQuery('#sidebar-items .dash-submenu').toggleClass('shadow shadow-gray-300 w-44 top-3 z-10 left-11 absolute bg-gray-50');
            jQuery('#sidebar-items .dash-submenu li').toggleClass('hover:bg-gray-200');
            jQuery(this).parents('.aside-bar').toggleClass('lg:w-14 lg:w-64 active');
            jQuery('#sidebar-items li').find('.menu-txt').toggleClass('absolute invisible opacity-0');
            jQuery('#sidebar-items li').find('.comdrop-down').addClass('absolute');
            jQuery('#sidebar-items li').find('a').addClass('lg:px-4 lg:hover:bg-gray-200');
            jQuery('#sidebar-items li').find('a').removeClass('lg:px-0 lg:hover:bg-transparent ');
            if (jQuery(this).parents('.aside-bar').hasClass('lg:w-14 active')) {
                localStorage.setItem("background", 1);
                jQuery('#sidebar-items li').find('a').addClass('lg:px-0 lg:hover:bg-transparent');
                jQuery('#sidebar-items li').find('.dash-submenu').css('display', 'none');
            } else {
                localStorage.setItem("background", 0);
                //jQuery('#sidebar-items li').find('.submenu').removeAttr('style');
            }
        });
    }
    /* showErrorMessage('Dynamic error');
    showSuccessMessage('Dynamic Success'); */


});

var player, player1, seconds = 0, seconds1 = 0;

function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		events: {
			'onReady': onPlayerReady
		}
	});
	player1 = new YT.Player('player1', {
		events: {
			'onReady': onPlayerReady
		}
	});
}

function onPlayerReady(event) {
	event.target.playVideo();
}

function seek(sec){
	if(player){
		seconds = sec;
		player.seekTo(seconds, true);
	}
}

function seek1(sec) {
	if(player1){
		seconds1 = sec;
		player1.seekTo(seconds1, true);
	}
}

/**
 * Remove comma from the number and remove values two decimal
 */
function nf( number ) {

	if( number && typeof number != 'number' ) {

        if( number.includes(",") ) {
            number = parseFloat(number.split(',').join(''));
        } else {
            number = parseFloat(number);
        }
	}
	
	if( number ) {
		return number.toFixed(2);
	} else {
		return 0.00;
	}
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

Object.defineProperty(Array.prototype, "chunk", {
    value: function (chunkSize) {
        var array = this;
        return [].concat.apply(
            [],
            array.map(function (elem, i) {
                return i % chunkSize ? [] : [array.slice(i, i + chunkSize)];
            })
        );
    },
});

function showErrorMessage(msg) {
    jQuery('.comalert-error').css('right', '0');
    jQuery('.comalert-error').html(msg);
    setTimeout(function () {
        jQuery('.comalert-error').css('right', '-100%');
    }, 5000);
}

function showSuccessMessage(msg) {
    jQuery('.comalert-success').html(msg);
    jQuery('.comalert-success').css('right', '0');
    setTimeout(function () {
        jQuery('.comalert-success').css('right', '-100%');
    }, 5000);
}

jQuery(document).ready(function() {
    jQuery(document).on("click", ".accordion_img", function() {
		if(jQuery(this).hasClass('open'))
		{
			jQuery(this).removeClass('open');
			jQuery(this).next('div.faq_answer').slideUp(200);
		}
		else
		{
			jQuery(this).addClass('open');
			jQuery(this).next('div.faq_answer').slideDown(500);
		}
    });
});


































































































































/** Calculate JS from the Live site to calculate the benefits */
// function body_onload()
// {
// 	showCalcImages();
	
// 	checkId();
// }

// function checkId()
// {
// 	if (document.COMP_strLastId)
// 	{
// 		if (document.COMP_strLastId != document.aspnetForm.Var_CalcForm_ID.value)
// 		{
// 			refreshCalculators();
// 			document.COMP_strLastId = document.aspnetForm.Var_CalcForm_ID.value;
// 		}
// 	}
// 	else
// 	{
// 		document.COMP_strLastId = document.aspnetForm.Var_CalcForm_ID.value;
// 	}
	
// 	if (window.setTimeout)
// 	{
// 		window.setTimeout('checkId();', 200);
// 	}
// }

// function refreshCalculators()
// {
// 	// Refresh any visible calculator pop-ups
// 	if (document.COMP_strLastCalc)
// 	{
// 		var lastCalc = document.COMP_strLastCalc;
// 		showCalc('');
// 		showCalc(lastCalc);
// 	}
// }

// function showCalcImages()
// {
// 	// Show calculator images
// 	assignAutoCalc('07');
// 	assignAutoCalc('08');
// 	assignPopupCalc('09');
// 	assignAutoCalc('11');
// 	assignPopupCalc('12');
// 	assignPopupCalc('13');
	
// 	assignPopupCalc('14'); // Holiday Time Off Calculator
// 	assignPopupCalc('15'); // Sick Time Off Calculator
// 	assignPopupCalc('16'); // Vacation Time Off Calculator
	
// 	assignPopupCalc('45'); // Bereavement Time Off Added Calculator 6-19-2007

// 	assignPopupCalc('17'); // Health Insurance Calculator
// 	assignPopupCalc('18'); // Dental Insurance Added Calculator Beta
// 	assignPopupCalc('19'); // Vision Insurance Added Calculator Beta

	
// 	for (var i=0; i<document.COMP_arrCustomTimeOffBenefitsReverseLookup.length; i++)
// 	{
// 		assignPopupCalc(document.COMP_arrCustomTimeOffBenefitsReverseLookup[i]);
// 	}
// }

// function assignAutoCalc(id)
// {
// 	if (document.getElementById)
// 	{
// 		var obj = document.getElementById(id + '_CalcImage');
		
// 		if (obj && obj.innerHTML != null)
// 		{
// 			obj.innerHTML = "<img alt='Auto-Calculate' src='../images/calc.gif' width='18' height='19' border='0' style='cursor:pointer;' />";
// 		}
// 	}
// }

// function assignPopupCalc(id)
// {
// 	if (document.getElementById)
// 	{
// 		var obj = document.getElementById(id + '_CalcImage');
		
// 		if (obj && obj.innerHTML != null)
// 		{
// 			obj.innerHTML = "<img alt='Show Calculator' src='../images/calc.gif' width='18' height='19' border='0' style='cursor:pointer;' />";
// 		}
// 	}
// }


// function getWages()
// {
// 	var wages = 0;
// 	var tempNum = 0;
// 	var tempStr = '';
// 	var tempObj = null;
// 	tempObj = document.getElementById('Var_wages');
// 	if (tempObj)
// 	{
// 	    tempStr = tempObj.value;
// 		tempNum = parseFloat(tempStr);
// 		if (!isNaN(tempNum))
// 			wages += tempNum;
// 	}
// 	return wages;
// }

// function getPay()
// {
// 	var pay = 0;
// 	var tempNum = 0;
// 	var tempStr = '';
// 	var tempObj = null;
// 	tempObj = document.getElementById('Var_pay')
// 	if (tempObj)
// 	{
// 	    tempStr = tempObj.value;
// 		tempNum = parseFloat(tempStr);
// 		if (!isNaN(tempNum))
// 			pay += tempNum;
// 	}
// 	return pay;
// }


// function calculate(id, employer_id, employee_id)
// {
// 	//alert(id);
// 	if (document.aspnetForm.Var_CalcForm_Notify_NoAutoRecalc.value != 'N')
// 	{
// 		alert('IMPORTANT: After using the COMPackage calculators, please note\n' +
// 			  'that the values will NOT be automatically recalculated if you\n' +
// 			  'change the data in any of the Base Pay or Other Income fields.\n');
// 		document.aspnetForm.Var_CalcForm_Notify_NoAutoRecalc.value = 'N';
// 	}
	
// 	if (document.getElementById)
// 	{
// 		var wages = getWages();
		
// 		switch (id + '')
// 		{
// 			/* Social Security */
// 		    case '07':
// 		        var tempSS_wages = wages;
// 		    	//var tempSS_year = 106800;
// 		    	//var tempSS_rate_employee = 0.042;
// 		    	//var tempSS_rate_employer = 0.062;
// 		        var tempSS_year = 132900;
// 		        var tempSS_rate_employee = 0.062;
// 		        var tempSS_rate_employer = 0.062;

// 		        if (document.aspnetForm.Var_CalcForm_Year[0].checked == true) {
// 		            tempSS_year = document.getElementById('Var_CalcForm_SS_ThisYear').value;
// 		            tempSS_rate_employee = document.getElementById('Var_CalcForm_SS_ThisYear_rate_employee').value;
// 		            tempSS_rate_employer = document.getElementById('Var_CalcForm_SS_ThisYear_rate_employer').value;
// 		        }
// 		        else {
// 		            tempSS_year = document.getElementById('Var_CalcForm_SS_LastYear').value;
// 		            tempSS_rate_employee = document.getElementById('Var_CalcForm_SS_LastYear_rate_employee').value;
// 		            tempSS_rate_employer = document.getElementById('Var_CalcForm_SS_LastYear_rate_employer').value;
// 		        }

// 		        if (tempSS_wages > tempSS_year) tempSS_wages = tempSS_year;
// 		        document.getElementById(employer_id).value = formatCurrency(tempSS_wages * tempSS_rate_employer);
// 		        document.getElementById(employee_id).value = formatCurrency(tempSS_wages * tempSS_rate_employee);
// 		        break;
			
// 			/* Medicare */
// 			case '08':
// 				document.getElementById(employer_id).value = formatCurrency(wages * 0.0145);
// 				document.getElementById(employee_id).value = formatCurrency(wages * 0.0145);
// 			break;
			
// 			/* Federal Unemployment */
// 			case '11':
// 				var tempFUTA_wages = wages;
// 				if (tempFUTA_wages > 7000) tempFUTA_wages = 7000;
// 				document.getElementById(employer_id).value = formatCurrency(tempFUTA_wages * 0.006);
// 			break;
			
// 			default:
// 				// Pass on to showCalc()
// 			    showCalc(id, employer_id, employee_id);
// 			break;
// 		}
		
// 	}
// }


// function showCalc(id, employer_id, employee_id)
// {
// 	if (document.getElementById)
// 	{
// 		var wages = getWages();
// 		var lastCalc = null;
		
// 		if (document.COMP_strLastCalc)
// 		{
// 			lastCalc = document.COMP_strLastCalc;
// 			document.getElementById(lastCalc + '_Calc').style.visibility = 'hidden';
// 			if (lastCalc == '13')
// 				document.getElementById('13_CalcForm_Help').style.visibility = 'hidden';
// 			// Hide Health Insurance Calculator
// 			if (lastCalc == '17')
// 				document.getElementById('17_CalcForm_Help').style.visibility = 'hidden';
// 			// Hide Dental Insurance Calculator
// 			if (lastCalc == '18')
// 				document.getElementById('18_CalcForm_Help').style.visibility = 'hidden';
// 			// Hide Vision Insurance Calculator
// 			if (lastCalc == '19')
// 				document.getElementById('19_CalcForm_Help').style.visibility = 'hidden';
// 			// Hide Life Insurance Calculator
// 			if (lastCalc == '22')
// 				document.getElementById('22_CalcForm_Help').style.visibility = 'hidden';
			
// 			document.COMP_strLastCalc = '';
// 		}
		
		
// 		var objCalcLoc = document.getElementById(id + '_Calc');
		
// 		switch (id + '')
// 		{
// 			/* 401K */
// 		    case '09':
// 		        if (lastCalc != id && objCalcLoc && objCalcLoc.style != null) {
// 		            objCalcLoc.style.visibility = 'visible';

// 		            document.getElementById(id + '_CalcForm_Pay').value = formatCurrency(getPay());
// 		            document.getElementById(id + '_CalcForm_EmployeeContrib').value = formatCurrency(document.getElementById(employee_id).value);
// 		            document.getElementById(id + '_CalcForm_Result').value = '';
// 		            document.getElementById(id + '_CalcForm_MatchLimit').value = document.aspnetForm.Var_CalcForm_401K_MatchLimit.value;
// 		            document.getElementById(id + '_CalcForm_Rate').value = document.aspnetForm.Var_CalcForm_401K_MatchRate.value;

// 		            document.COMP_strLastCalc = id;
// 		        }
// 		        break;
			
// 			/* State Unemployment */
// 			case '12':
// 				if (lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Wages').value = formatCurrency(wages);
// 					document.getElementById(id + '_CalcForm_Result').value = '';
// 					document.getElementById(id + '_CalcForm_WageLimit').value = formatCurrency(document.aspnetForm.Var_CalcForm_SUTA_WageLimit.value);
// 					document.getElementById(id + '_CalcForm_Rate').value = document.aspnetForm.Var_CalcForm_SUTA_Rate.value;
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;
			
// 			/* Worker's Compensation */
// 			case '13':
// 				if (lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Wages').value = formatCurrency(wages);
// 					document.getElementById(id + '_CalcForm_WageLimit').value = formatCurrency(document.aspnetForm.Var_CalcForm_WC_WageLimit.value);
// 					document.getElementById(id + '_CalcForm_Result').value = '';
// 					document.getElementById(id + '_CalcForm_EstimatedPremium').value = formatCurrency(document.aspnetForm.Var_CalcForm_WC_EstimatedPremium.value);
// 					document.getElementById(id + '_CalcForm_ManualPremium').value = formatCurrency(document.aspnetForm.Var_CalcForm_WC_ManualPremium.value);
// 					document.getElementById(id + '_CalcForm_JobClass').value = document.aspnetForm.S_13_JobClass.value;
// 					document.getElementById(id + '_CalcForm_Rate').value = document.aspnetForm.S_13_Rate.value;
					
// 					var arrTemp = document.aspnetForm.Var_CalcForm_WC_JobClasses.value.split('|');
// 					document.getElementById('13_CalcForm_JobClassSelect').options.length = 0;
// 					document.getElementById('13_CalcForm_JobClassSelect').options[0] = new Option('', '');
// 					var splitTemp;
// 					for (var i=0; i < arrTemp.length; i++)
// 					{
// 						if (arrTemp[i] != '')
// 						{
// 							splitTemp = arrTemp[i].split(';');
// 							document.getElementById('13_CalcForm_JobClassSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + '%', splitTemp[0] + ' | ' + splitTemp[1] + '%');
// 						}
// 					}
// 					if (document.getElementById('13_CalcForm_JobClassSelect').options.length == 1)
// 					{
// 						document.getElementById('13_CalcForm_JobClassSelect').options[i] = new Option('No presets available.', '');
// 					}
					
// 					if (document.aspnetForm.Var_CalcForm_WC_HideHelp.value == '1')
// 						document.getElementById('13_CalcForm_Help').style.visibility = 'hidden';
// 					else
// 						document.getElementById('13_CalcForm_Help').style.visibility = 'visible';
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;
			
// 			/* Time Off */
// 			case '14':
// 			case '15':
// 			case '16':
// 			case '45':
// 				if (lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Pay').value = formatCurrency(getPay());
// 					document.getElementById(id + '_CalcForm_Result').value = '';
// 					document.getElementById(id + '_CalcForm_WorkDays').value = document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value;
// 					if (id == '14') document.getElementById(id + '_CalcForm_DaysOff').value = document.aspnetForm.Var_CalcForm_TimeOff_PaidHolidays.value;
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;

//             // --------------------- Setup values for display  10-23-2006

// 			/* Health Insurance */
// 			case '17':
// 				if (lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Payrolls').value = document.aspnetForm.S_17_Payrolls.value;
						
// 					document.getElementById(id + '_CalcForm_PerPayCost').value = formatCurrency(document.aspnetForm.S_17_PerPayCost.value);
					
// 					document.getElementById(id + '_CalcForm_EmployeePPC').value = formatCurrency(document.aspnetForm.S_17_EmployeePPC.value);
						
// 					document.getElementById(id + '_CalcForm_Census').value = document.aspnetForm.S_17_Census.value;
						
// 					document.getElementById(id + '_CalcForm_Result').value = '';
					
// 					document.getElementById(id + '_CalcForm_Result2').value = '';

// 					var arrTemp = document.aspnetForm.Var_CalcForm_HI_Census.value.split('|');
// 					document.getElementById('17_CalcForm_CensusSelect').options.length = 0;
// 					document.getElementById('17_CalcForm_CensusSelect').options[0] = new Option('Select Census', '');
// 					var splitTemp;
// 					for (var i=0; i < arrTemp.length; i++)
// 					{
// 						if (arrTemp[i] != '')
// 						{
// 							splitTemp = arrTemp[i].split(';');
// 							document.getElementById('17_CalcForm_CensusSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '', splitTemp[0] + ' | ' +  splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '');
// 						}
// 					}
// 					if (document.getElementById('17_CalcForm_CensusSelect').options.length == 1)
// 					{
// 						document.getElementById('17_CalcForm_CensusSelect').options[i] = new Option('No presets available.', '');
// 					}
					
// 					if (document.getElementById(employer_id).disabled == true)
// 					{
// 						document.getElementById('17_CalcForm_PerPayCost').disabled = true;
// 						document.getElementById('17_CalcForm_Result').disabled = true;
// 						document.getElementById('17_CalcForm_PerPayCost').style.backgroundColor = '#CCCCCC';
// 						document.getElementById('17_CalcForm_Result').style.backgroundColor = '#CCCCCC';
// 					}
// 					else
// 					{
// 						document.getElementById('17_CalcForm_PerPayCost').disabled = false;
// 						document.getElementById('17_CalcForm_Result').disabled = false;
// 					}
						
// 					if (document.getElementById(employee_id).disabled == true)
// 					{
// 						document.getElementById('17_CalcForm_EmployeePPC').disabled = true;
// 						document.getElementById('17_CalcForm_Result2').disabled = true;
// 						document.getElementById('17_CalcForm_EmployeePPC').style.backgroundColor = '#CCCCCC';
// 						document.getElementById('17_CalcForm_Result2').style.backgroundColor = '#CCCCCC';
// 					}
// 					else
// 					{
// 						document.getElementById('17_CalcForm_EmployeePPC').disabled = false;
// 						document.getElementById('17_CalcForm_Result2').disabled = false;
// 					}
					
// 					if (document.aspnetForm.Var_CalcForm_HI_HideHelp.value == '1')
// 						document.getElementById('17_CalcForm_Help').style.visibility = 'hidden';
// 					else
// 						document.getElementById('17_CalcForm_Help').style.visibility = 'visible';
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;
			
// 			/* Dental Insurance */
// 			case '18':
// 				if (lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Payrolls').value = document.aspnetForm.S_17_Payrolls.value;
						
// 					document.getElementById(id + '_CalcForm_PerPayCost').value = formatCurrency(document.aspnetForm.S_18_PerPayCost.value);
					
// 					document.getElementById(id + '_CalcForm_EmployeePPC').value = formatCurrency(document.aspnetForm.S_18_EmployeePPC.value);
						
// 					document.getElementById(id + '_CalcForm_Census').value = document.aspnetForm.S_17_Census.value;
						
// 					document.getElementById(id + '_CalcForm_Result').value = '';
					
// 					document.getElementById(id + '_CalcForm_Result2').value = '';

// 					var arrTemp = document.aspnetForm.Var_CalcForm_DI_Census.value.split('|');
// 					document.getElementById('18_CalcForm_CensusSelect').options.length = 0;
// 					document.getElementById('18_CalcForm_CensusSelect').options[0] = new Option('Select Census', '');
// 					var splitTemp;
// 					for (var i=0; i < arrTemp.length; i++)
// 					{
// 						if (arrTemp[i] != '')
// 						{
// 							splitTemp = arrTemp[i].split(';');
// 							document.getElementById('18_CalcForm_CensusSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '', splitTemp[0] + ' | ' +  splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '');
// 						}
// 					}
// 					if (document.getElementById('18_CalcForm_CensusSelect').options.length == 1)
// 					{
// 						document.getElementById('18_CalcForm_CensusSelect').options[i] = new Option('No presets available.', '');
// 					}
					
// 					if (document.getElementById(employer_id).disabled == true)
// 					{
// 						document.getElementById('18_CalcForm_PerPayCost').disabled = true;
// 						document.getElementById('18_CalcForm_Result').disabled = true;
// 						document.getElementById('18_CalcForm_PerPayCost').style.backgroundColor = '#CCCCCC';
// 						document.getElementById('18_CalcForm_Result').style.backgroundColor = '#CCCCCC';
// 					}
// 					else
// 					{
// 						document.getElementById('18_CalcForm_PerPayCost').disabled = false;
// 						document.getElementById('18_CalcForm_Result').disabled = false;
// 					}
						
// 					if (document.getElementById(employee_id).disabled == true)
// 					{
// 						document.getElementById('18_CalcForm_EmployeePPC').disabled = true;
// 						document.getElementById('18_CalcForm_Result2').disabled = true;
// 						document.getElementById('18_CalcForm_EmployeePPC').style.backgroundColor = '#CCCCCC';
// 						document.getElementById('18_CalcForm_Result2').style.backgroundColor = '#CCCCCC';
// 					}
// 					else
// 					{
// 						document.getElementById('18_CalcForm_EmployeePPC').disabled = false;
// 						document.getElementById('18_CalcForm_Result2').disabled = false;
// 					}
					
// 					if (document.aspnetForm.Var_CalcForm_DI_HideHelp.value == '1')
// 						document.getElementById('18_CalcForm_Help').style.visibility = 'hidden';
// 					else
// 						document.getElementById('18_CalcForm_Help').style.visibility = 'visible';
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;

// 			/* Vision Insurance */
// 			case '19':
// 				if (lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Payrolls').value = document.aspnetForm.S_17_Payrolls.value;
						
// 					document.getElementById(id + '_CalcForm_PerPayCost').value = formatCurrency(document.aspnetForm.S_19_PerPayCost.value);
					
// 					document.getElementById(id + '_CalcForm_EmployeePPC').value = formatCurrency(document.aspnetForm.S_19_EmployeePPC.value);
						
// 					document.getElementById(id + '_CalcForm_Census').value = document.aspnetForm.S_17_Census.value;
						
// 					document.getElementById(id + '_CalcForm_Result').value = '';
					
// 					document.getElementById(id + '_CalcForm_Result2').value = '';

// 					var arrTemp = document.aspnetForm.Var_CalcForm_VI_Census.value.split('|');
// 					document.getElementById('19_CalcForm_CensusSelect').options.length = 0;
// 					document.getElementById('19_CalcForm_CensusSelect').options[0] = new Option('Select Census', '');
// 					var splitTemp;
// 					for (var i=0; i < arrTemp.length; i++)
// 					{
// 						if (arrTemp[i] != '')
// 						{
// 							splitTemp = arrTemp[i].split(';');
// 							document.getElementById('19_CalcForm_CensusSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '', splitTemp[0] + ' | ' +  splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '');
// 						}
// 					}
// 					if (document.getElementById('19_CalcForm_CensusSelect').options.length == 1)
// 					{
// 						document.getElementById('19_CalcForm_CensusSelect').options[i] = new Option('No presets available.', '');
// 					}
					
// 					if (document.getElementById(employer_id).disabled == true)
// 					{
// 						document.getElementById('19_CalcForm_PerPayCost').disabled = true;
// 						document.getElementById('19_CalcForm_Result').disabled = true;
// 						document.getElementById('19_CalcForm_PerPayCost').style.backgroundColor = '#CCCCCC';
// 						document.getElementById('19_CalcForm_Result').style.backgroundColor = '#CCCCCC';
// 					}
// 					else
// 					{
// 						document.getElementById('19_CalcForm_PerPayCost').disabled = false;
// 						document.getElementById('19_CalcForm_Result').disabled = false;
// 					}
						
// 					if (document.getElementById(employee_id).disabled == true)
// 					{
// 						document.getElementById('19_CalcForm_EmployeePPC').disabled = true;
// 						document.getElementById('19_CalcForm_Result2').disabled = true;
// 						document.getElementById('19_CalcForm_EmployeePPC').style.backgroundColor = '#CCCCCC';
// 						document.getElementById('19_CalcForm_Result2').style.backgroundColor = '#CCCCCC';
// 					}
// 					else
// 					{
// 						document.getElementById('19_CalcForm_EmployeePPC').disabled = false;
// 						document.getElementById('19_CalcForm_Result2').disabled = false;
// 					}
					
// 					if (document.aspnetForm.Var_CalcForm_VI_HideHelp.value == '1')
// 						document.getElementById('19_CalcForm_Help').style.visibility = 'hidden';
// 					else
// 						document.getElementById('19_CalcForm_Help').style.visibility = 'visible';
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;
					
// 			default:
// 				// Check for custom Time Off Calculator
// 				if (document.COMP_arrCustomTimeOffBenefits[id] && lastCalc != id && objCalcLoc && objCalcLoc.style != null)
// 				{
// 					objCalcLoc.style.visibility = 'visible';
					
// 					document.getElementById(id + '_CalcForm_Pay').value = formatCurrency(getPay());
// 					document.getElementById(id + '_CalcForm_Result').value = '';
// 					document.getElementById(id + '_CalcForm_WorkDays').value = document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value;
// 					if (id == '14') document.getElementById(id + '_CalcForm_DaysOff').value = document.aspnetForm.Var_CalcForm_TimeOff_PaidHolidays.value;
					
// 					document.COMP_strLastCalc = id;
// 				}
// 			break;
// 		}
		
// 	}
// }


// function calculateFromCalc(id, employer_id, employee_id)
// {
// 	if (document.getElementById)
// 	{
// 		var matchLimit, employeeContrib;
// 		var wages, tempWages, wageLimit, rate, result;
// 		var pay, workDays, daysOff;
// 		var errMsg = '';
		
// 		switch (id + '')
// 		{
// 			/* 401K */
// 			case '09':
// 				// Validate
				
// 				pay = document.getElementById(id+'_CalcForm_Pay').value;
// 				pay = pay.replace('$', '');
// 				pay = pay.replace(',', '');
// 				pay = parseFloat(pay);
// 				if (isNaN(pay) || pay < 0)
// 					errMsg += '- The Pay Field must contain a number and it cannot be negative.\n';
				
// 				matchLimit = document.getElementById(id+'_CalcForm_MatchLimit').value;
// 				matchLimit = matchLimit.replace('$', '');
// 				matchLimit = matchLimit.replace(',', '');
// 				matchLimit = parseFloat(matchLimit);
// 				if (isNaN(matchLimit) || matchLimit < 0)
// 					errMsg += '- The Match Limit Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById(id+'_CalcForm_MatchLimit').value = matchLimit;
				
// 				rate = document.getElementById(id+'_CalcForm_Rate').value;
// 				rate = rate.replace('$', '');
// 				rate = rate.replace(',', '');
// 				rate = parseFloat(rate);
// 				if (isNaN(rate) || rate < 0)
// 					errMsg += '- The Match Rate Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById(id+'_CalcForm_Rate').value = rate;
				
// 				employeeContrib = document.getElementById(id+'_CalcForm_EmployeeContrib').value;
// 				employeeContrib = employeeContrib.replace('$', '');
// 				employeeContrib = employeeContrib.replace(',', '');
// 				employeeContrib = parseFloat(employeeContrib);
// 				if (isNaN(employeeContrib) || employeeContrib < 0)
// 					errMsg += '- The Employee Contribution Field must contain a number and it cannot be negative.\n';
				
				
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					result = employeeContrib * (rate/100);
// 					if ( result > pay * (matchLimit/100) ) result = pay * (matchLimit/100);
// 					document.getElementById(id+'_CalcForm_Result').value = formatCurrency(result);
// 					document.getElementById(employer_id).value = formatCurrency(result);
// 					document.getElementById(employee_id).value = formatCurrency(employeeContrib);
// 					document.aspnetForm.Var_CalcForm_401K_MatchLimit.value = matchLimit;
// 					document.aspnetForm.Var_CalcForm_401K_MatchRate.value = rate;
					
// 				}
// 			break;
			
// 			/* State Unemployment */
// 			case '12':
				
// 				// Validate
				
// 				wages = document.getElementById('12_CalcForm_Wages').value;
// 				wages = wages.replace('$', '');
// 				wages = wages.replace(',', '');
// 				wages = parseFloat(wages);
// 				if (isNaN(wages) || wages < 0)
// 					errMsg += '- The Wages Field must contain a number and it cannot be negative.\n';
				
// 				wageLimit = document.getElementById('12_CalcForm_WageLimit').value;
// 				wageLimit = wageLimit.replace('$', '');
// 				wageLimit = wageLimit.replace(',', '');
// 				wageLimit = parseFloat(wageLimit);
// 				if (isNaN(wageLimit) || wageLimit < 0)
// 					errMsg += '- The Wage Limit Field must contain a number and it cannot be negative.\n';
				
// 				rate = document.getElementById('12_CalcForm_Rate').value;
// 				rate = rate.replace('$', '');
// 				rate = rate.replace(',', '');
// 				rate = parseFloat(rate);
// 				if (isNaN(rate) || rate < 0)
// 					errMsg += '- The Rate Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById('12_CalcForm_Rate').value = rate;
				
				
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					tempWages = wages;
// 					if (tempWages > wageLimit) tempWages = wageLimit;
// 					result = tempWages * (rate/100);
// 					document.getElementById('12_CalcForm_Result').value = formatCurrency(result);
// 					document.getElementById(employer_id).value = formatCurrency(result);
// 					document.aspnetForm.Var_CalcForm_SUTA_WageLimit.value = wageLimit;
// 					document.aspnetForm.Var_CalcForm_SUTA_Rate.value = rate;
					
// 				}
// 			break;
			
// 			/* Worker's Compensation */
// 			case '13':
				
// 				// Validate
				
// 				wages = document.getElementById('13_CalcForm_Wages').value;
// 				wages = wages.replace('$', '');
// 				wages = wages.replace(',', '');
// 				wages = parseFloat(wages);
// 				if (isNaN(wages) || wages < 0)
// 					errMsg += '- The Wages Field must contain a number and it cannot be negative.\n';
				
// 				wageLimit = document.getElementById('13_CalcForm_WageLimit').value;
				
// 				if (wageLimit != '')
// 				{
// 					wageLimit = wageLimit.replace('$', '');
// 					wageLimit = wageLimit.replace(',', '');
// 					wageLimit = parseFloat(wageLimit);

// 					// WageLimit Not Required  10-23-2006
// 					if (isNaN(wageLimit) || wageLimit < 0)
// 						errMsg += '- The Wage Limit Field must contain a number and it cannot be negative or the Field must be blank.\n';
// 				}
				
// 				var estimatedPremium = 0;
// 				estimatedPremium = document.getElementById('13_CalcForm_EstimatedPremium').value;
// 				estimatedPremium = estimatedPremium.replace('$', '');
// 				estimatedPremium = estimatedPremium.replace(',', '');
// 				estimatedPremium = parseFloat(estimatedPremium);
// 				if (isNaN(estimatedPremium) || estimatedPremium < 0)
// 					errMsg += '- The Estimated Premium Field must contain a number and it cannot be negative.\n';
				
// 				var manualPremium = 0;
// 				manualPremium = document.getElementById('13_CalcForm_ManualPremium').value;
// 				manualPremium = manualPremium.replace('$', '');
// 				manualPremium = manualPremium.replace(',', '');
// 				manualPremium = parseFloat(manualPremium);
// 				if (isNaN(manualPremium) || manualPremium <= 0)
// 					errMsg += '- The Manual Premium Field must contain a number and it must be greater than zero.\n';
				
// 				var jobClass = '';
// 				jobClass = document.getElementById('13_CalcForm_JobClass').value;
// 				jobClass = jobClass.replace('|', '');
// 				jobClass = jobClass.replace(';', '');
// 				if (jobClass == '')
// 					errMsg += '- The Job Class Field is required and must not be blank.\n';
				
// 				rate = document.getElementById('13_CalcForm_Rate').value;
// 				rate = rate.replace('$', '');
// 				rate = rate.replace(',', '');
// 				rate = parseFloat(rate);
// 				if (isNaN(rate) || rate < 0)
// 					errMsg += '- The Rate Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById('13_CalcForm_Rate').value = rate;
				
				
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					tempWages = wages;

// 					// tempWages is WageLimit If WageLimit is Blank 10-23-2006
// 					if ((tempWages > wageLimit) && (wageLimit != '')) tempWages = wageLimit;

// 					result = ((estimatedPremium / manualPremium) * rate) * (tempWages / 100);
// 					document.getElementById('13_CalcForm_Result').value = formatCurrency(result);
// 					document.getElementById(employer_id).value = formatCurrency(result);
// 					document.aspnetForm.S_13_JobClass.value = jobClass;
// 					document.aspnetForm.S_13_Rate.value = rate;
// 					document.aspnetForm.Var_CalcForm_WC_WageLimit.value = wageLimit;
// 					document.aspnetForm.Var_CalcForm_WC_EstimatedPremium.value = estimatedPremium;
// 					document.aspnetForm.Var_CalcForm_WC_ManualPremium.value = manualPremium;
					
// 				}
// 			break;
			
// 			/* Time Off */
// 			case '14':
// 			case '15':
// 			case '16':
// 			case '45':
				
// 				// Validate
				
// 				pay = document.getElementById(id+'_CalcForm_Pay').value;
// 				pay = pay.replace('$', '');
// 				pay = pay.replace(',', '');
// 				pay = parseFloat(pay);
// 				if (isNaN(pay) || pay < 0)
// 					errMsg += '- The Pay Field must contain a number and it cannot be negative.\n';
				
// 				workDays = document.getElementById(id+'_CalcForm_WorkDays').value;
// 				workDays = workDays.replace('$', '');
// 				workDays = workDays.replace(',', '');
// 				workDays = parseFloat(workDays);
// 				if (isNaN(workDays) || workDays < 0)
// 					errMsg += '- The Work Days Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById(id+'_CalcForm_WorkDays').value = workDays;
				
// 				daysOff = document.getElementById(id+'_CalcForm_DaysOff').value;
// 				daysOff = daysOff.replace('$', '');
// 				daysOff = daysOff.replace(',', '');
// 				daysOff = parseFloat(daysOff);
// 				if (isNaN(daysOff) || daysOff < 0)
// 					errMsg += '- The Days Off Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById(id+'_CalcForm_DaysOff').value = daysOff;
				
				
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					result = daysOff * (pay/workDays);
// 					document.getElementById(id+'_CalcForm_Result').value = formatCurrency(result);
// 					document.getElementById(employer_id).value = formatCurrency(result);
// 					document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
// 					if (id == '14') document.aspnetForm.Var_CalcForm_TimeOff_PaidHolidays.value = daysOff;
					
// 				}
// 			break;

//             // --------------------- Calculations  10-23-2006

// 			/* Health Insurance */
// 			case '17':

// 				// Validate
				

// 				payperyr = document.getElementById(id+'_CalcForm_Payrolls').value;
// 				payperyr = parseFloat(payperyr);
// 				if (isNaN(payperyr) || payperyr < 0)
// 					errMsg += '- The N of Payrolls in a Year Field must contain a number and it cannot be negative.\n';

// 				perpaycost = document.getElementById(id+'_CalcForm_PerPayCost').value;
// 				perpaycost = perpaycost.replace('$', '');
// 				perpaycost = perpaycost.replace(',', '');
// 				perpaycost = parseFloat(perpaycost);
					
// 				if (document.getElementById(employer_id).disabled == false)
// 				{
// 					if (isNaN(perpaycost) || perpaycost < 0)
// 						errMsg += '- The Employer Per-Pay Cost Field must contain a number and it cannot be negative.\n';
// 				}
					
// 				employeeppc = document.getElementById(id+'_CalcForm_EmployeePPC').value;
// 				employeeppc = employeeppc.replace('$', '');
// 				employeeppc = employeeppc.replace(',', '');
// 				employeeppc = parseFloat(employeeppc);
						
// 				if (document.getElementById(employee_id).disabled == false)
// 				{
// 					if (isNaN(employeeppc) || employeeppc < 0)
// 						errMsg += '- The Employee Per-Pay Cost Field must contain a number and it cannot be negative.\n';
// 				}

// 				var Census = '';
// 				Census = document.getElementById('17_CalcForm_Census').value;
// 				Census = Census.replace('|', '');
// 				Census = Census.replace(';', '');
// 				if (Census == '')
// 					errMsg += '- The Census Field is required and must not be blank.\n';
					
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					if (document.getElementById(employer_id).disabled == false)
// 					{
// 						result = payperyr * perpaycost;
// 						document.getElementById(id+'_CalcForm_Result').value = formatCurrency(result);
// 						document.getElementById(employer_id).value = formatCurrency(result);
// 					}
// 					if (document.getElementById(employee_id).disabled == false)
// 					{
// 						result2 = payperyr * employeeppc;
// 						document.getElementById(id+'_CalcForm_Result2').value = formatCurrency(result2);
// 						document.getElementById(employee_id).value = formatCurrency(result2);
// 					}

					
// 					//document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
// 					document.aspnetForm.S_17_Payrolls.value = payperyr;
// 					document.aspnetForm.S_17_PerPayCost.value = perpaycost;
// 					document.aspnetForm.S_17_EmployeePPC.value = employeeppc;
// 					document.aspnetForm.S_17_Census.value = Census;
					
// 				}
// 			break;
			
// 			/* Dental Insurance */
// 			case '18':

// 				// Validate
				

// 				payperyr = document.getElementById(id+'_CalcForm_Payrolls').value;
// 				payperyr = parseFloat(payperyr);
// 				if (isNaN(payperyr) || payperyr < 0)
// 					errMsg += '- The N of Payrolls in a Year Field must contain a number and it cannot be negative.\n';

// 				perpaycost = document.getElementById(id+'_CalcForm_PerPayCost').value;
// 				perpaycost = perpaycost.replace('$', '');
// 				perpaycost = perpaycost.replace(',', '');
// 				perpaycost = parseFloat(perpaycost);
					
// 				if (document.getElementById(employer_id).disabled == false)
// 				{
// 					if (isNaN(perpaycost) || perpaycost < 0)
// 						errMsg += '- The Employer Per-Pay Cost Field must contain a number and it cannot be negative.\n';
// 				}
					
// 				employeeppc = document.getElementById(id+'_CalcForm_EmployeePPC').value;
// 				employeeppc = employeeppc.replace('$', '');
// 				employeeppc = employeeppc.replace(',', '');
// 				employeeppc = parseFloat(employeeppc);
						
// 				if (document.getElementById(employee_id).disabled == false)
// 				{
// 					if (isNaN(employeeppc) || employeeppc < 0)
// 						errMsg += '- The Employee Per-Pay Cost Field must contain a number and it cannot be negative.\n';
// 				}

// 				var Census = '';
// 				Census = document.getElementById('18_CalcForm_Census').value;
// 				Census = Census.replace('|', '');
// 				Census = Census.replace(';', '');
// 				if (Census == '')
// 					errMsg += '- The Census Field is required and must not be blank.\n';
					
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					if (document.getElementById(employer_id).disabled == false)
// 					{
// 						result = payperyr * perpaycost;
// 						document.getElementById(id+'_CalcForm_Result').value = formatCurrency(result);
// 						document.getElementById(employer_id).value = formatCurrency(result);
// 					}
// 					if (document.getElementById(employee_id).disabled == false)
// 					{
// 						result2 = payperyr * employeeppc;
// 						document.getElementById(id+'_CalcForm_Result2').value = formatCurrency(result2);
// 						document.getElementById(employee_id).value = formatCurrency(result2);
// 					}

					
// 					//document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
// 					document.aspnetForm.S_17_Payrolls.value = payperyr;
// 					document.aspnetForm.S_18_PerPayCost.value = perpaycost;
// 					document.aspnetForm.S_18_EmployeePPC.value = employeeppc;
// 					document.aspnetForm.S_17_Census.value = Census;
					
// 				}
// 			break;

// 			/* Vision Insurance */
// 			case '19':

// 				// Validate
				

// 				payperyr = document.getElementById(id+'_CalcForm_Payrolls').value;
// 				payperyr = parseFloat(payperyr);
// 				if (isNaN(payperyr) || payperyr < 0)
// 					errMsg += '- The N of Payrolls in a Year Field must contain a number and it cannot be negative.\n';

// 				perpaycost = document.getElementById(id+'_CalcForm_PerPayCost').value;
// 				perpaycost = perpaycost.replace('$', '');
// 				perpaycost = perpaycost.replace(',', '');
// 				perpaycost = parseFloat(perpaycost);
					
// 				if (document.getElementById(employer_id).disabled == false)
// 				{
// 					if (isNaN(perpaycost) || perpaycost < 0)
// 						errMsg += '- The Employer Per-Pay Cost Field must contain a number and it cannot be negative.\n';
// 				}
					
// 				employeeppc = document.getElementById(id+'_CalcForm_EmployeePPC').value;
// 				employeeppc = employeeppc.replace('$', '');
// 				employeeppc = employeeppc.replace(',', '');
// 				employeeppc = parseFloat(employeeppc);
						
// 				if (document.getElementById(employee_id).disabled == false)
// 				{
// 					if (isNaN(employeeppc) || employeeppc < 0)
// 						errMsg += '- The Employee Per-Pay Cost Field must contain a number and it cannot be negative.\n';
// 				}

// 				var Census = '';
// 				Census = document.getElementById('19_CalcForm_Census').value;
// 				Census = Census.replace('|', '');
// 				Census = Census.replace(';', '');
// 				if (Census == '')
// 					errMsg += '- The Census Field is required and must not be blank.\n';
					
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					if (document.getElementById(employer_id).disabled == false)
// 					{
// 						result = payperyr * perpaycost;
// 						document.getElementById(id+'_CalcForm_Result').value = formatCurrency(result);
// 						document.getElementById(employer_id).value = formatCurrency(result);
// 					}
// 					if (document.getElementById(employee_id).disabled == false)
// 					{
// 						result2 = payperyr * employeeppc;
// 						document.getElementById(id+'_CalcForm_Result2').value = formatCurrency(result2);
// 						document.getElementById(employee_id).value = formatCurrency(result2);
// 					}

					
// 					//document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
// 					document.aspnetForm.S_17_Payrolls.value = payperyr;
// 					document.aspnetForm.S_19_PerPayCost.value = perpaycost;
// 					document.aspnetForm.S_19_EmployeePPC.value = employeeppc;
// 					document.aspnetForm.S_17_Census.value = Census;
					
// 				}
// 			break;
			
// 			default:
// 				// Check for custom Time Off Calculator
// 				if (document.COMP_arrCustomTimeOffBenefits[id])
// 				{
// 				// Validate
				
// 				pay = document.getElementById(id+'_CalcForm_Pay').value;
// 				pay = pay.replace('$', '');
// 				pay = pay.replace(',', '');
// 				pay = parseFloat(pay);
// 				if (isNaN(pay) || pay < 0)
// 					errMsg += '- The Pay Field must contain a number and it cannot be negative.\n';
				
// 				workDays = document.getElementById(id+'_CalcForm_WorkDays').value;
// 				workDays = workDays.replace('$', '');
// 				workDays = workDays.replace(',', '');
// 				workDays = parseFloat(workDays);
// 				if (isNaN(workDays) || workDays < 0)
// 					errMsg += '- The Work Days Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById(id+'_CalcForm_WorkDays').value = workDays;
				
// 				daysOff = document.getElementById(id+'_CalcForm_DaysOff').value;
// 				daysOff = daysOff.replace('$', '');
// 				daysOff = daysOff.replace(',', '');
// 				daysOff = parseFloat(daysOff);
// 				if (isNaN(daysOff) || daysOff < 0)
// 					errMsg += '- The Days Off Field must contain a number and it cannot be negative.\n';
// 				else
// 					document.getElementById(id+'_CalcForm_DaysOff').value = daysOff;
				
				
// 				// Calculate
// 				if (errMsg == '')
// 				{
// 					result = daysOff * (pay/workDays);
// 					document.getElementById(id+'_CalcForm_Result').value = formatCurrency(result);
// 					document.getElementById(employer_id).value = formatCurrency(result);
// 					document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
// 					if (id == '14') document.aspnetForm.Var_CalcForm_TimeOff_PaidHolidays.value = daysOff;
					
// 				}
// 				}
// 			break;
// 		}
		
// 		if (errMsg != '')
// 			alert('Please correct the following errors:\n\n' + errMsg);
		
// 	}
// }

// /* Worker's Compensation */
// function Function_13_CalcForm_JobClassSelect_onchange(value)
// {
// 	if (value != '')
// 	{
// 		var arrTemp = value.split(' | ');
// 		document.getElementById('13_CalcForm_JobClass').value = arrTemp[0];
// 		document.getElementById('13_CalcForm_Rate').value = arrTemp[1].replace('%', '');
		
// 		document.getElementById('13_CalcForm_JobClassSelect').selectedIndex = 0;
// 	}
// }

// /* Health Insurance */
// function Function_17_CalcForm_CensusSelect_onchange(value)
// {
// 	if ((value != '') && (value != 'Select Census'))
// 	{
// 		var arrTemp = value.split(' | ');
// 		document.getElementById('17_CalcForm_Census').value = arrTemp[0];
// 		if ((arrTemp[1] != '') && (arrTemp[2] != '$') && (arrTemp[3] != '$'))
// 		{
// 			document.getElementById('17_CalcForm_Payrolls').value = arrTemp[1];
// 			document.getElementById('17_CalcForm_PerPayCost').value = arrTemp[2];
// 			document.getElementById('17_CalcForm_EmployeePPC').value = arrTemp[3];
// 		}
		
// 		document.getElementById('17_CalcForm_CensusSelect').selectedIndex = 0;
// 	}
// }

// /* Dental Insurance */
// function Function_18_CalcForm_CensusSelect_onchange(value)
// {
// 	if ((value != '') && (value != 'Select Census'))
// 	{
// 		var arrTemp = value.split(' | ');
// 		document.getElementById('18_CalcForm_Census').value = arrTemp[0];
// 		if ((arrTemp[1] != '') && (arrTemp[2] != '$') && (arrTemp[3] != '$'))
// 		{
// 			document.getElementById('18_CalcForm_Payrolls').value = arrTemp[1];
// 			document.getElementById('18_CalcForm_PerPayCost').value = arrTemp[2];
// 			document.getElementById('18_CalcForm_EmployeePPC').value = arrTemp[3];
// 		}
		
// 		document.getElementById('18_CalcForm_CensusSelect').selectedIndex = 0;
// 	}
// }

// /* Vision Insurance */
// function Function_19_CalcForm_CensusSelect_onchange(value)
// {
// 	if ((value != '') && (value != 'Select Census'))
// 	{
// 		var arrTemp = value.split(' | ');
// 		document.getElementById('19_CalcForm_Census').value = arrTemp[0];
// 		if ((arrTemp[1] != '') && (arrTemp[2] != '$') && (arrTemp[3] != '$'))
// 		{
// 			document.getElementById('19_CalcForm_Payrolls').value = arrTemp[1];
// 			document.getElementById('19_CalcForm_PerPayCost').value = arrTemp[2];
// 			document.getElementById('19_CalcForm_EmployeePPC').value = arrTemp[3];
// 		}
		
// 		document.getElementById('19_CalcForm_CensusSelect').selectedIndex = 0;
// 	}
// }
/** Calculate JS from the Live site to calculate the benefits */