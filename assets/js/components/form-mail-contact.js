(function ($) {
    $("form.js-form-checker").submit(function (event) {

        var formId = '#' + this.id,
            formState = true,
            form_Data = new FormData(this),
            form_name = $(formId + " input[name='form']").val();

        if (form_name === "demande") {
            $text_completed = "<p>Votre demande à bien été transmise.<img src='img/icons/close.png' class='icon'/></p>";
        } else {
            $text_completed = "<p>Votre message a été envoyé avec succès.<img src='img/icons/close.png' class='icon'/></p>";
        }

        $(formId).find('input,textarea').each(function () {
            var elem_input = $(this),
                name = elem_input.attr('name'),
                name_array = name.split('_');
            if (name_array[0] !== undefined) {
                switch (name_array[0]) {
                    case 'required':
                        var required_state = checkRequired(elem_input);
                        if (!required_state) {
                            formState = false;
                        }
                        break;
                    case 'alpha':
                    case 'alphanum':
                    case 'url':
                    case 'email':
                    case 'phone':
                    case 'checkbox':
                    case 'file':
                        var format_state = checkFormat(elem_input, name_array[0]);
                        if (!format_state) {
                            formState = false;
                        }
                        break;
                    default:
                        break;
                }
            }

            if (name_array[1] !== undefined && formState) {
                switch (name_array[1]) {
                    case 'alpha':
                    case 'alphanum':
                    case 'url':
                    case 'email':
                    case 'phone':
                    case 'file':
                        var format_state = checkFormat(elem_input, name_array[1]);
                        if (!format_state) {
                            formState = false;
                        }
                        break;
                    default:
                        break;
                }
            }
        });

        // Si toutes les conditions sont bien remplies on envoie le formulaire
        if (formState) {
            // Affichage du loader lors du submit
            function anim() {
                $(formId).animate({
                    opacity: 0,
                }, 600);
                setTimeout(function () {
                    $(formId).closest('div').append("<div class='c-formulaire_overlay close'><div class='c-formulaire_overlay_text'></div></div>");
                    setTimeout(function () {
                        $(formId).closest('div').children('.c-formulaire_overlay').removeClass('close');
                    }, 100);
                }, 800);
            }

            // Requete Ajax

            $.ajax({
                type: "POST",
                url: $(formId).attr("action"),
                data: form_Data,
                success: function () {
                    anim();
                    setTimeout(function () {
                        $('.c-formulaire_overlay_text').html($text_completed).addClass('active');
                    }, 1500);
                },
                error: function (data) {
                    anim();
                    setTimeout(function () {
                        $('.c-formulaire_overlay_text').html("<p>Une erreur est survenue,<br> merci de rafraichir la page</p>").addClass('active');
                    }, 1500);
                    console.log(data);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
        return false;
    });

    // Vérification des éléments requis
    function checkRequired(element) {
        var value = element.val(),
            message = element.data('required'),
            parent = element.closest('.c-formulaire_field');
        if (value == "") {
            parent.addClass('error').attr('data-message', message);
            return false;
        } else if (element.attr('type') == "checkbox") {
            if (!element.is(':checked')) {
                parent.addClass('error').attr('data-message', message);
                return false;
            } else {
                parent.removeClass('error');
                return true;
            }
        } else {
            parent.removeClass('error');
            return true;
        }
    }

    // Vérification des formats de données
    function checkFormat(element, format) {

        var value = element.val(),
            parent = element.closest('.c-formulaire_field'),

            PATTERN_num = /^[0-9 ]*$/,
            PATTERN_TITLE_num = "Seul les chiffres et les espaces sont autorisés",

            PATTERN_alpha = /^[A-Za-z' èéàùçâêûôîäüöïë,-.]*$/,
            PATTERN_TITLE_alpha = "Seul les lettres et les espaces sont autorisés",

            PATTERN_alphanum = /^[A-Za-z0-9' èéàùçâêûôîäüöïë,-.\/()!?:\";*+]*$/,
            PATTERN_TITLE_alphanum = "Seul les lettres, les chiffres et les espaces sont autorisés",

            PATTERN_phone = /^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$/,
            PATTERN_TITLE_phone = "Merci de renseigner un numéro de téléphone valide",

            PATTERN_email = /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$/,
            PATTERN_TITLE_email = "L\'email doit être écrit au format contact@exemple.com",

            PATTERN_url = /^http(s)?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=])*$/,
            PATTERN_TITLE_url = "Votre url doit être au format http(s)://www.votre-url.com",

            PATTERN_TITLE_file = "L'extension de votre fichier n'est pas supportée.";

        if (value == "" || value == undefined) {
            parent.removeClass('error');
            return true;
        }

        switch (format) {
            case 'alpha':
                if (!PATTERN_alpha.test(value)) {
                    parent.addClass('error').attr('data-message', PATTERN_TITLE_alpha);
                    return false;
                } else {
                    parent.removeClass('error');
                    return true;
                }
                break;
            case 'alphanum':
                if (!PATTERN_alphanum.test(value)) {
                    parent.addClass('error').attr('data-message', PATTERN_TITLE_alphanum);
                    return false;
                } else {
                    parent.removeClass('error');
                    return true;
                }
                break;
            case 'url':
                if (!PATTERN_url.test(value)) {
                    parent.addClass('error').attr('data-message', PATTERN_TITLE_url);
                    return false;
                } else {
                    parent.removeClass('error');
                    return true;
                }
                break;
            case 'email':
                if (!PATTERN_email.test(value)) {
                    parent.addClass('error').attr('data-message', PATTERN_TITLE_email);
                    return false;
                } else {
                    parent.removeClass('error');
                    return true;
                }
                break;
            case 'phone':
                if (!PATTERN_phone.test(value)) {
                    parent.addClass('error').attr('data-message', PATTERN_TITLE_phone);
                    return false;
                } else {
                    parent.removeClass('error');
                    return true;
                }
                break;
            case 'file':
                var extension = element.attr('accept');
                var extensions_array = extension.split(',');
                var split = value.split(".");
                var ext = "." + split[split.length - 1].toLowerCase();
                if ($.inArray(ext, extensions_array) !== -1) {
                    parent.removeClass('error');
                    return true;
                } else {
                    parent.addClass('error').attr('data-message', PATTERN_TITLE_file);
                    return false;
                }
                break;
            default:
                return true;
        }
    }
})(jQuery);