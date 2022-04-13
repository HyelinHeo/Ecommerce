/*!
* Start Bootstrap - Agency v7.0.6 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 

//add_hyerin_20211021
var userDevice = "";
var device = "win16|win32|win64|mac|macintel";

if ( navigator.platform ) {
    if ( device.indexOf(navigator.platform.toLowerCase()) < 0 ) {
        userDevice = "MOBILE";
    } else {
        userDevice = "PC";
    }
}

window.addEventListener('DOMContentLoaded', event => {

    //add_hyerin_20211021
    if(userDevice=="MOBILE"){
        document.getElementById( 'btn_google' ).setAttribute( 'href', 'market://details?id=com.shipney.maprex' );
        //document.getElementById( 'btn_ios' ).setAttribute( 'href', 'market://details?id=com.shipney.maprex' );
    }
    else if(userDevice=="PC"){
        document.getElementById( 'btn_google' ).setAttribute( 'href', 'https://play.google.com/store/apps/details?id=com.shipney.maprex' );
        //document.getElementById( 'btn_ios' ).setAttribute( 'href', 'https://play.google.com/store/apps/details?id=com.shipney.maprex' );
    }

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});
