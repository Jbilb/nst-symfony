tarteaucitron.init({
    "privacyUrl": "",
    /* Privacy policy url */

    "hashtag": "#tarteaucitron",
    /* Open the panel with this hashtag */
    "cookieName": "tarteaucitron",
    /* Cookie name */

    "orientation": "popup",
    /* Banner position (top - bottom - middle - popup) */

    "groupServices": false,
    /* Group services by category */

    "showAlertSmall": false,
    /* Show the small banner on bottom right */
    "cookieslist": false,
    /* Show the cookie list */

    "showIcon": false,
    /* Show cookie icon to manage cookies */
    // "iconSrc": "", /* Optionnal: URL or base64 encoded image */
    "iconPosition": "TopRight",
    /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */

    "adblocker": false,
    /* Show a Warning if an adblocker is detected */

    "DenyAllCta": true,
    /* Show the deny all button */
    "AcceptAllCta": true,
    /* Show the accept all button when highPrivacy on */
    "highPrivacy": true,
    /* HIGHLY RECOMMANDED Disable auto consent */

    "handleBrowserDNTRequest": false,
    /* If Do Not Track == 1, disallow all */

    "removeCredit": true,
    /* Remove credit link */
    "moreInfoLink": true,
    /* Show more info link */
    "useExternalCss": true,
    /* If false, the tarteaucitron.css file will be loaded */

    //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */

    "readmoreLink": "",
    /* Change the default readmore link pointing to tarteaucitron.io */

    "mandatory": true /* Show a message about mandatory cookies */
});

// **********************************************************
// *** Google Analytics 
// *** Remplacer "YOUR-ID" par l'identifiant Google Analytics et décommenter le code ci-dessous
// **********************************************************

tarteaucitron.user.gtagUa = 'G-ID';
(tarteaucitron.job = tarteaucitron.job || []).push('gtag');

// **********************************************************
// *** Pixel Facebook 
// *** Remplacer "YOUR-ID" par l'identifiant du Pixel Facebook et décommenter le code ci-dessous
// **********************************************************

//tarteaucitron.user.facebookpixelId = 'ID';
//(tarteaucitron.job = tarteaucitron.job || []).push('facebookpixel');

// **********************************************************
// *** Google Tag Manager
// *** Remplacer "YOUR-ID" par l'identifiant du TagManager et décommenter le code ci-dessous
// **********************************************************

//tarteaucitron.user.googletagmanagerId = 'YOUR-ID';
//(tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');

// **********************************************************
// *** Pixel Linkedin
// *** Remplacer "YOUR-ID" par l'identifiant du TagManager et décommenter le code ci-dessous
// **********************************************************

//tarteaucitron.user.linkedininsighttag = 'YOUR-ID';
//(tarteaucitron.job = tarteaucitron.job || []).push('linkedininsighttag');


(function ($) {
    $(function () {
        $(window).ready(function () {
            checkCookies();
        });

        function checkCookies() {
            var banner = $('.u-banner-cookies');

            if (!isCookieSet()) {
                if ($('transition.first').length) {
                    setTimeout(function () {
                        banner.addClass('active');
                    }, 3000);
                } else {
                    banner.addClass('active');
                }
            }

            $('[data-accept-cookies]').on('click', function () {
                banner.removeClass('active');
            });
        }

        function isCookieSet() {
            if (document.cookie.length == 0) {
                return false;
            }
            var checker = false;
            var regSepCookie = new RegExp('(; )', 'g');
            var cookies = document.cookie.split(regSepCookie);

            for (var i = 0; i < cookies.length; i++) {
                var regInfo = new RegExp('=', 'g');
                var infos = cookies[i].split(regInfo);
                if (infos[0] == 'tarteaucitron' && infos[2].includes('wait')) {
                    return false;
                }
                if (infos[0] == "tarteaucitron") {
                    checker = true;
                }
            }
            return checker;
        }
    });
})(jQuery);