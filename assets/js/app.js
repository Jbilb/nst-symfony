import '../sass/app.scss';
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'slick-carousel'

(function ($) {
    $(function () {
        $(window).ready(function () {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var scrollPos = $(window).scrollTop();
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
            sliderCollapse();
            commandVideo();
            collapseBtn();
            addFavoriteRestaurant();
            smoothScrollRecrutement();
            formEtapeModule();
            if (window.matchMedia("(min-width:993px)").matches) {
                fixedElem();
            }
        });
        $(window).on('load', function () {
            woow();
        });

        $(window).resize(function () {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            add100Vh();
        });

        $(window).scroll(function () {
            var scrollPos = $(window).scrollTop();
            navMasked(scrollPos);
        });



        ///////////////////////////////////////////////////////
        /* MODULE FORMULAIRE AVEC ETAPE */
        ///////////////////////////////////////////////////////

        function formEtapeModule() {

            // récupère le total des questions + ajouter texte dans data-total
            var totalEtape = $('[data-next-question]').length;
            $('[data-total]').html(totalEtape);

            // Initialise un compteur
            var countRow = 1;

            $('[data-next-question]').on('click', function () {

                // Récupère les éléments de la question proche du bouton
                var bouton = this;
                var item = $(bouton).closest('[data-row-form]');
                var nextItem = $(item).next('[data-row-form]');
                var inputItem = $('input', item);

                // Si une valeur est cochée ou remplie
                if (checkValueChecked(inputItem)) {
                    countRow++;
                    $('[data-number]').html(countRow);

                    if ($(bouton).hasClass("rappel")) {
                        var valueChecked = $('input:checked', item).val();
                        if (valueChecked === "Oui") {
                            animateFormEtape(nextItem, bouton)
                            $(bouton).removeClass('inactive')
                        } else {
                            var nextNextItem = $(nextItem).next('[data-row-form]');
                            animateFormEtape(nextNextItem, bouton)
                            $(bouton).removeClass('inactive')
                        }
                    } else {
                        animateFormEtape(nextItem, bouton)
                    }

                }
            });
        }

        // Fonction d'animation des étapes
        function animateFormEtape(item, bouton) {
            $(item).removeClass('inactive');
            $(item).addClass('active');
            $(bouton).addClass('inactive');
            $('html, body').animate({
                scrollTop: $(item).offset().top - 100
            }, 900);
        }

        // Fonction qui check si une valeur est cochée ou remplie
        function checkValueChecked(input) {
            var inputType = $(input).attr('type');
            if (inputType === "radio") {
                if ($(input).is(':checked')) {
                    return true;
                }
            } else {
                if ($(input).val()) {
                    return true;
                }
            }
        }

        ///////////////////////////////////////////////////////
        /* SMOOTHSCROLL RECRUTEMENT */
        ///////////////////////////////////////////////////////

        function smoothScrollRecrutement() {
            $(".goFormulaireWithName").on('click', function (event) {
                event.preventDefault();
                var hash = this.hash;
                var poste = $(this).data('name');
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900);
                $('#form-recrutement #application_annonce').val(poste);
                $('#form-recrutement .dropdown-toggle-btn .txt').text(poste);
            });
        };

        ///////////////////////////////////////////////////////
        /* fixedElem */
        ///////////////////////////////////////////////////////

        function fixedElem() {
            var container = $(".fixed-elem-wrapper");
            if (container.length) {
                var elem = $(".fixed-elem");
                var elemHeight = $(elem).outerHeight();
                var addFixed = $(container).offset().top;
                var containerBottom = addFixed + $(container).outerHeight();
                var stopFixed = containerBottom - elemHeight;

                $(window).scroll(function () {
                    var scrollPos = $(window).scrollTop();
                    var scroll = scrollPos;
                    console.log(scroll);
                    if (scroll > addFixed && scroll < stopFixed) {
                        elem.addClass("fixed");
                        elem.removeClass("absolute-end");
                    } else if (scroll > stopFixed) {
                        elem.addClass("absolute-end");
                    } else {
                        elem.removeClass("fixed");
                    }
                });
            }
        }

        ///////////////////////////////////////////////////////
        /* video commandes */
        ///////////////////////////////////////////////////////

        function commandVideo() {
            $('[video-js]').on('click touchstart', function (event) {
                var vid = $('[content-video-js]', this).get(0);
                event.preventDefault();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    setTimeout(function () {
                        vid.pause();
                    }, 200);
                } else {
                    $(this).addClass('active');
                    $('html, body').animate({
                        scrollTop: $("#ancreVideo").offset().top
                    }, 800);
                    setTimeout(function () {
                        vid.play();
                    }, 200);
                }
            });
        }

        ///////////////////////////////////////////////////////
        /* Real 100 vh */
        ///////////////////////////////////////////////////////

        // En css var(--heightJs) pour récupérer la valeur
        function add100Vh() {
            var windowHeight = $(window).height();
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
            var headerHeightBy2 = headerHeight - (headerHeight - 150); // Régle la distance à laquelle la nav passe en compact

            if (scrollPosition > headerHeightBy2) {
                $('.p-nav').removeClass('masked');
            } else {
                $('.p-nav').addClass('masked');
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
                    $(this).removeClass('ouvert');
                    elemNav.removeClass('ouvert');
                    elemMenu.removeClass('ouvert');
                    elemHtml.removeClass('noscroll');
                } else {
                    $(this).addClass('ouvert');
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
            var slider = $('.slider-annonces');
            $(slider).each(function () {
                var wrapper = $(this).closest('.c-carrousel-annonces');
                var id = $(this).data('slider');
                var containerArrows = $('.js-arrow-slider[data-slider="' + id + '"]', wrapper);
                var arrowLeft = $('.slider-bouton.slider-left', containerArrows);
                var arrowRight = $('.slider-bouton.slider-right', containerArrows);
                $(this).slick({
                    infinite: false,
                    arrows: true,
                    dots: false,
                    autoplay: false,
                    speed: 1000,
                    fade: false,
                    variableWidth: true,
                    draggable: true,
                    swipeToSlide: true,
                    prevArrow: arrowLeft,
                    nextArrow: arrowRight,
                });
            });
            var sliderBien = $('[data-slider-basique]');
            $(sliderBien).each(function () {
                var wrapper = $(this).closest('[data-slider-basique-wrap]');
                var arrowLeft = $('.arrow-left', wrapper);
                var arrowRight = $('.arrow-right', wrapper);
                $(this).slick({
                    infinite: false,
                    arrows: true,
                    dots: false,
                    autoplay: false,
                    speed: 1000,
                    fade: false,
                    adaptiveHeight: true,
                    draggable: true,
                    swipeToSlide: true,
                    prevArrow: arrowLeft,
                    nextArrow: arrowRight,
                });
            });
        }

        ///////////////////////////////////////////////////////
        /* bouton collapse */
        ///////////////////////////////////////////////////////
        function collapseBtn() {

            $('.js-collapse-content').each(function () {
                $(this).css("display", "none");
            });

            $('.js-collapse').on('click', function () {
                var bouton = this;
                var wrapper = bouton.closest('.js-collapse-wrapper');
                var blocTextId = $('.js-collapse-content', wrapper);

                $(bouton).toggleClass('open');
                if ($(this).hasClass('js-collapse-hidden')) {
                    $(bouton).css("pointer-events", "none");
                    $(bouton).animate({
                        opacity: 0,
                        height: 0,
                    }, 300);
                }
                $(blocTextId).slideToggle(300, function () {});
                $(wrapper).toggleClass('open');
                $(blocTextId).toggleClass('open');
            });
        }

        ///////////////////////////////////////////////////////
        /* slider collapse */
        ///////////////////////////////////////////////////////
        function sliderCollapse() {

            $('.js-sliderCollapse').on('click', function () {
                var btn = this;
                var wrapper = $(btn).closest('.c-carrousel-annonces');
                var btnId = $(btn).data("slider");
                var sliders = $('.slider-annonces', wrapper);
                var slider = $('.slider-annonces[data-slider="' + btnId + '"]', wrapper);
                var containerArrows = $('.js-arrow-slider[data-slider="' + btnId + '"]', wrapper);

                $(sliders).each(function () {
                    if ($(this).hasClass('open')) {
                        $(this).removeClass('open');
                        $('.js-sliderCollapse').removeClass('open');
                        $('.js-arrow-slider').removeClass('open');
                    }
                });
                containerArrows.addClass('open');
                setTimeout(function () {
                    $(slider).addClass('open');
                    $(btn).addClass('open');
                }, 400);
            });
        }

        ///////////////////////////////////////////////////////
        /* CREATION SELECT PERSONNALISE (DROPDOWN) */
        ///////////////////////////////////////////////////////

        function dropdown() {
            $(document).on('click', '.dropdown-toggle-btn', function (event) {
                event.preventDefault();
                if ($(this).closest('.dropdown-toggle').hasClass('open')) {
                    $(this).closest('.dropdown-toggle').removeClass('open');
                } else {
                    $('.dropdown-toggle').removeClass('open');
                    $(this).closest('.dropdown-toggle').addClass('open');
                }
            });

            $(document).on('click', 'ul.dropdown button', function (event) {
                event.preventDefault();
                var valeur = $(this).attr('data-value');
                var texte = $(this).text();
                if ($(this).hasClass('changeFilter')) {
                    var itemContainer = $(this).closest(".navFindHouse_nav_item");
                    var nextItemContainer = $(itemContainer).next(".navFindHouse_nav_item");
                    var allMenu = $('.dropdown', nextItemContainer);
                    var menuSelect = $('.dropdown[data-type="' + valeur + '"]', nextItemContainer);
                    $(allMenu).removeClass('actif');
                    $(menuSelect).addClass('actif');
                }
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
                    inputElement = element.find('input[type=file]'),
                    fileText = element.find('.c-formulaire_file_text');
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
                        fileText.html(inputElement.get(0).files[0].name);
                    });
                }

            });
        }

        ///////////////////////////////////////////////////////
        /* ADD FAVORITE RESTAURANT COOKIE */
        ///////////////////////////////////////////////////////
        function addFavoriteRestaurant() {
            var button = document.getElementById('restaurant-favori')
            button.onclick = function () {
                setCookie('favorite-restaurant', button.dataset.id, 90);
            }
        }

        function setCookie(cookieName, cookievValue, expireDays) {
            const date = new Date();
            date.setTime(date.getTime() + (expireDays*24*60*60*1000));
            
            document.cookie = cookieName + "=" + cookievValue + ";expires=" + date.toUTCString() + ";path=/;SameSite=Lax";
        }
    });
})(jQuery);