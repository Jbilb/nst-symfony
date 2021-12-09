import '../sass/app.scss';
//require('slick-carousel');

(function ($) {
    $(function () {
        $(window).ready(function () {
            windowWidth = $(window).width();
            windowHeight = $(window).height();
            scrollPos = $(window).scrollTop();
            add100Vh();
            sliders();
            dropdown();
            smoothScroll();
            menu();
            animation();
            modal();
            navMasked(scrollPos);
            parallax();
            inputFile();
            navMasked();
        });
        $(window).load(function () {
            woow();
        });

        $(window).resize(function () {
            windowWidth = $(window).width();
            windowHeight = $(window).height();
            add100Vh();
        });

        $(window).scroll(function () {
            scrollPos = $(window).scrollTop();
            navMasked(scrollPos);
        });

        ///////////////////////////////////////////////////////
        /* Real 100 vh */
        ///////////////////////////////////////////////////////

        // En css var(--heightJs) pour récupérer la valeur
        function add100Vh() {
            var height = windowHeight + "px";
            $('.heightJs').each(function () {
                $(this).get(0).style.setProperty("--heightJs", height);
            });
        };


        ///////////////////////////////////////////////////////
        /* NAV */
        ///////////////////////////////////////////////////////
        function navMasked(scrollPosition) {
            var headerHeight = $('#header').height();
            var headerHeightBy2 = headerHeight - (headerHeight - 100); // Régle la distance à laquelle la nav passe en compact

            if (scrollPosition > headerHeightBy2) {
                $('.p-btnMenu').removeClass('masked');
            } else {
                $('.p-btnMenu').addClass('masked');
            }
        }

        ///////////////////////////////////////////////////////
        /* SMOOTHSCROLL */
        ///////////////////////////////////////////////////////

        function smoothScroll() {
            $(".scroll").on('click', function (event) {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900);
            });
        };

        ///////////////////////////////////////////////////////
        /* GESTION OUVERTURE / FERMETURE MENU */
        ///////////////////////////////////////////////////////

        function menu() {
            $('.js-menu').on('click', function (event) {
                event.stopPropagation();
                var elemNav = $('.p-nav');
                var elemMenu = $('.p-menu');
                var elemHtml = $('html');
                if (elemNav.hasClass('ouvert')) {
                    elemNav.removeClass('ouvert');
                    elemMenu.removeClass('ouvert');
                    elemHtml.removeClass('noscroll');
                } else {
                    elemNav.addClass('ouvert');
                    elemMenu.addClass('ouvert');
                    elemHtml.addClass('noscroll');
                }
            });
        };

        ///////////////////////////////////////////////////////
        /* EFFET DE PARALLAXE */
        ///////////////////////////////////////////////////////

        function parallax() {
            $('.parallax').each(function () {
                var elem = $(this);
                var property = $(this).data('css').toString().split(",");
                var startVal = $(this).data('start').toString().split(",");
                var endVal = $(this).data('end').toString().split(",");
                var elemTop = $(this).offset().top;
                var elemHeight = $(this).outerHeight(),
                    startOffset = 0,
                    endOffset = 100,
                    anchor = false;

                if ($(this).attr('off-start') != undefined) {
                    startOffset = $(this).attr('off-start');
                }
                if ($(this).attr('off-end') != undefined) {
                    endOffset = $(this).attr('off-end');
                }
                if ($(this).data('anchor') != undefined) {
                    anchor = $(this).data('anchor');
                    elemTop = $(anchor).offset().top;
                    elemHeight = $(anchor).outerHeight();
                }

                if ($(this).data('stop') != undefined) {
                    var stopBpValue = $(this).data('stop');
                }
                if (stopBpValue) {
                    if (window.matchMedia("(min-width:" + stopBpValue + "px)").matches) {
                        parallaxScroll(elem, elemHeight, elemTop, property, startVal, endVal, startOffset, endOffset, anchor);
                    }
                } else {
                    parallaxScroll(elem, elemHeight, elemTop, property, startVal, endVal, startOffset, endOffset, anchor);
                }
            });
        }

        function parallaxScroll(element, elementHeight, elementTop, cssProperty, startValues, endValues, offStart, offEnd, anchorElement) {
            var windowHeight = $(window).height(),
                valuesTab = new Array(),
                regex = /[+-]?\d+(\.\d+)?/g,
                i;
            for (i = 0; i < cssProperty.length; i++) {
                var property = cssProperty[i],
                    startFull = startValues[i],
                    endFull = endValues[i],
                    splitUnits = endFull.split(regex),
                    units = splitUnits[splitUnits.length - 1],
                    chaine_start = splitUnits[0],
                    startVal = startFull.match(regex).map(function (v) {
                        return parseFloat(v);
                    }),
                    endVal = endFull.match(regex).map(function (v) {
                        return parseFloat(v);
                    }),
                    anchor = anchorElement;
                var object = {
                    chaine0: chaine_start,
                    start: startVal[0],
                    end: endVal[0],
                    css: property,
                    units: units,
                    delta: (endVal - startVal) / (offEnd - offStart)
                };
                valuesTab.push(object);
            }
            if (elementTop < windowHeight) {
                var startScroll = offStart * elementHeight / 100;
                var endScroll = elementTop + offEnd * elementHeight / 100;
            } else {
                var init = elementTop - windowHeight;
                var end = elementTop + elementHeight;
                var startScroll = elementTop - windowHeight + offStart * (end - init) / 100;
                var endScroll = elementTop - windowHeight + offEnd * (end - init) / 100;
            }
            $(window).scroll(function () {
                var scrollPos = $(window).scrollTop();
                if (elementTop < windowHeight) {
                    var percent = (scrollPos) / (elementHeight) * 100;
                } else {
                    var percent = (scrollPos - elementTop + windowHeight) / (elementHeight + windowHeight) * 100;
                }
                if (scrollPos > startScroll && scrollPos < endScroll) {
                    for (i = 0; i < valuesTab.length; i++) {
                        element.css(
                            valuesTab[i].css, (valuesTab[i].chaine0 + (valuesTab[i].start + percent * valuesTab[i].delta - valuesTab[i].delta * offStart) + valuesTab[i].units)
                        )
                    }
                }
                if (scrollPos < startScroll) {
                    for (i = 0; i < valuesTab.length; i++) {
                        element.css(
                            valuesTab[i].css, (valuesTab[i].chaine0 + valuesTab[i].start + valuesTab[i].units)
                        )
                    }
                }
                if (scrollPos > endScroll) {
                    for (i = 0; i < valuesTab.length; i++) {
                        element.css(
                            valuesTab[i].css, (valuesTab[i].chaine0 + valuesTab[i].end + valuesTab[i].units)
                        )
                    }
                }
            });
        };

        ///////////////////////////////////////////////////////
        /* FUNCTION WOW.JS MAISON */
        ///////////////////////////////////////////////////////

        function woow() {
            var woow = $('.woow');
            var scrollPosition = $(window).scrollTop();
            var vh = $(window).outerHeight();
            woow.each(function () {
                // Initialisation des Paramètres
                var paramToggle = false;
                var paramOffset = 80;
                var elPosition = $(this).offset().top;
                // Paramètre Offset
                if ($(this).data('woow-offset')) {
                    paramOffset = $(this).data('woow-offset');
                }

                paramOffset = ((vh * paramOffset) / 100);
                elPosition = elPosition - paramOffset;

                // Paramètre Toggle
                if ($(this).data('woow-toggle')) {
                    paramToggle = true;
                }
                // Scroll prevent reload or goback
                if (scrollPosition > elPosition) {
                    $(this).addClass("animated");
                } else if (paramToggle) {
                    if (scrollPosition < elPosition) {
                        $(this).removeClass("animated");
                    }
                }
                // Scroll event
                woowScroll($(this), elPosition, paramToggle);
            });
        };

        function woowScroll(element, elementPosition, paramToggle) {
            var verifScroll = false;
            $(window).scroll(function () {
                var scrollPosition = $(window).scrollTop();
                if (scrollPosition > 1 && verifScroll === false) {
                    verifScroll = true;
                    element.addClass("masked");
                }
                if (scrollPosition > elementPosition) {
                    element.removeClass("masked");
                } else if (paramToggle) {
                    if (scrollPosition < elementPosition) {
                        element.addClass("masked");
                    }
                }
            });
        };

        ///////////////////////////////////////////////////////
        /* MODAL APRES FORMULAIRE */
        ///////////////////////////////////////////////////////

        function modal() {
            $(document).on('click', '.c-formulaire_overlay', function () {
                $(this).addClass('close');
                setTimeout(function () {
                    $('.c-formulaire_overlay').remove();
                }, 1000);
            });
        };

        ///////////////////////////////////////////////////////
        /* ANIMATION AU CHARGEMENT DU SITE */
        ///////////////////////////////////////////////////////

        function animation() {

            // ========================================
            // *****  CHARGEMENT DU SITE 
            // ========================================

            if ($(".c-transition.first").length) {
                $.post("animation.php", {
                    animation: "none"
                });
                setTimeout(function () {
                    $(".c-transition").addClass('anim');
                }, 200);
                setTimeout(function () {
                    $(".c-transition").addClass('remove');
                }, 1200);
                setTimeout(function () {
                    $("#wrapper").removeClass('first');
                    $(".c-transition").addClass('under');
                }, 2100);
                setTimeout(function () {
                    $(".c-transition").removeClass('first anim remove');
                }, 2500);
            }
            return false;
        }


        ///////////////////////////////////////////////////////
        /* INITIALISATION DES SLIDERS */
        ///////////////////////////////////////////////////////

        function sliders() {
            var slider = $('.slider'),
                settings = {
                    infinite: true,
                    arrows: true,
                    dots: false,
                    autoplay: false,
                    speed: 1000,
                    fade: false,
                    draggable: false,
                    swipeToSlide: true,
                };
            $(slider).slick(settings);
        }

        ///////////////////////////////////////////////////////
        /* CREATION SELECT PERSONNALISE (DROPDOWN) */
        ///////////////////////////////////////////////////////

        function dropdown() {
            $(document).on('click', '.dropdown-toggle-btn', function (event) {
                event.preventDefault();
                $('.dropdown-toggle').removeClass('open');
                $(this).closest('.dropdown-toggle').toggleClass('open');
                $(document).on('click', function (event) {
                    if (!$(event.target).closest('.dropdown-toggle').length) {
                        if ($('.dropdown-toggle').hasClass('open')) {
                            $('.dropdown-toggle').removeClass('open');
                        }
                    }
                });
            });

            $(document).on('click', 'ul.dropdown button', function (event) {
                event.preventDefault();
                var valeur = $(this).attr('data-value');
                var texte = $(this).text();
                $(this).closest('.dropdown-toggle').find('input').val(valeur);
                $(this).closest('.dropdown-toggle').toggleClass('open');
                $(this).closest('.dropdown-toggle').find('.dropdown-toggle-btn').find('span.txt').text(texte);
                $(this).closest('.dropdown-toggle').find('.dropdown-toggle-btn').addClass('focus');
                $(this).closest('.dropdown-toggle').find('input').trigger("change");
            });
        }

        ///////////////////////////////////////////////////////
        /* INPUT FILE PERSONNALISE */
        ///////////////////////////////////////////////////////

        function inputFile() {
            $('.c-formulaire_file').each(function () {
                var element = $(this),
                    fileName = element.find('label'),
                    inputElement = element.find('input[type=file]');
                if (element.hasClass('multiple')) {
                    inputElement.on('change', function () {
                        var filesNumber = inputElement[0].files.length;
                        if (filesNumber > 1) {
                            fileName.html(filesNumber + ' éléments sélectionnés.');
                        } else {
                            fileName.html(filesNumber + ' élément sélectionné.');
                        }
                    });
                } else {
                    inputElement.on('change', function () {
                        fileName.html(inputElement.get(0).files[0].name);
                    });
                }

            });
        }
    });
})(jQuery);