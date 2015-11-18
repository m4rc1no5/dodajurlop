;(function ($) {
    'use strict';

    $.fn.hasAttr = function (name) { return this.attr(name) !== undefined; };

    var defaults = {
        alertify: function () {

        },

        bootbox: function () {
            bootbox.setDefaults({
                animate: false,
                onEscape: true
            })
        }
    };

    function confirm (obj, onOkCallback) {
        var $obj = $(obj);

        if ($obj.data('confirm')) {
            alertify.confirm($obj.data('confirm'), onOkCallback);
        } else {
            onOkCallback();
        }
    }

    function icheck (input, color) {
        var $input = input;

        if (typeof color === 'undefined') {
            color = 'blue';
        }

        $input.iCheck({
            checkboxClass: 'icheckbox_square-' + color,
            radioClass: 'iradio_square-' + color
        });

        $input.on('ifChecked ifUnchecked', function () {
            $(this).trigger('click');
        });
    }

    function pacjentDropdown() {
        var $li = $('header #app-header-pacj-nav ul li.dropdown');
        var active = 'header #app-header-pacj-nav ul li.dropdown.active';

        $li.hover(function() {
            $(this).addClass('active');
        });

        $(document).on('click', function () {
            $(active).removeClass('active');
        });
    }

    function post (uri) {
        $.post(uri, function (data) {
            if ( ! processJSON(data)) {
                alertify.error('Wystąpił nieokreślony błąd');
            }
        });
    }

    function processJSON (data) {
        if (typeof data != 'object' ) {
            return false;
        }

        switch (data.statusCode) {
            case 201:case 301:case 302:case 303:case 307:case 308:
            redirect(data.targetUrl);
            break;

            default:
                alertify.error('Nieznany statusCode (' + data.statusCode + ')');
        }

        return true;
    }

    function redirect (url, force) {
        if (!force && (window.location.pathname == url || window.location.href == url)) {
            $.get(url, function (data) {
                bootbox.hideAll();
                $("div#page-wrapper").replaceWith($(data).find("div#page-wrapper"));
            });
        } else {
            window.location.href = url;
        }
    }

    function rememberSearchEngineStrategy () {
        $('select#search_engine_strategy').on('change', function () {
            $.cookie('APP_SEARCH_STRATEGY', $(this).val());
        });
    }

    function sessionCountdown () {

    }

    function slidebars () {

    }

    function toggleClass (onObj, toggleObj, toggleClass) {
        if (typeof onObj === 'undefined') {
            return;
        }

        var $toggleObj = $(toggleObj);

        if (typeof toggleClass === 'undefined') {
            toggleClass = 'hide';
        }

        $(onObj).on('click', function () {
            $toggleObj.toggleClass(toggleClass);
        });
    }

    function APP () {
        this.init();
    }

    APP.prototype = {
        constructor: APP,
        initialized: false,
        init: function () {
            $(document).ready(function() {
                if (app.initialized === false) {
                    app.initialized = true;

                    defaults.alertify();
                    defaults.bootbox();

                    //pacjentDropdown();
                    //sessionCountdown();
                    //slidebars();
                    //rememberSearchEngineStrategy();

                    $(this).ajaxStart(function () {
                        //$.preloader.show();
                    }).ajaxStop(function () {
                        $('.modal-dialog').show();
                        //$.preloader.hide();
                        app.init();
                    }).ajaxError(function (event, request) {
                        var response = $.parseJSON(request.responseText);
                        alertify.error(response.message);
                    });

                    app.listener.ajax();
                    app.listener.bootbox();
                    app.listener.row();
                    app.listener.uppercase();

                    app.init();
                } else {
                    app.listener.tooltip();
                    app.listener.chosen();
                    //app.listener.datepicker();
                    app.listener.icheck();
                    app.listener.toggleClass();
                    app.listener.slownik();
                }
            });
        },

        bootbox: function (uri, width, title) {
            function load(context, uri) {
                $.get(uri, function(response) {
                    if (!processJSON(response)) {
                        $(context).html(response);
                    } else {
                        $(context).detach();
                    }
                });
            }

            var modal = {
                message: function(title, uri) {
                    return bootbox.dialog({
                        title: title,
                        message: function () {
                            load(this, uri);
                        }
                    });
                },

                replace: function(uri) {
                    var $modal = bootbox.dialog({
                        message: ' '
                    });

                    var $dialog = $modal.find('.modal-dialog');
                    load($dialog, uri);

                    return $modal;
                }
            };


            $('html, body').addClass('no-scroll');

            if (typeof title === 'undefined') {
                /** Cały modal zostanie podmieniony zawartością z URI */
                var $modal = modal.replace(uri);
            } else {
                /** Zawartość z URI zostanie załadowane w miejsce modal-body  */
                var $modal = modal.message(title, uri);
            }

            $modal.on('hide.bs.modal', function() {
                $('html, body').removeClass('no-scroll');
            });

            var $dialog = $modal.find('.modal-dialog');

            $dialog.hide();
            $dialog.css('max-width', width);
            $dialog.attr('data-uri', uri);

            app.modal.submit();
        },

        /** Dodanie icheck do wszystkich elementów w parentSelector */
        icheck: function (parentSelector, color) {
            icheck($(parentSelector + " input[type=checkbox], " + parentSelector + " input[type=radio]"), color);
        },

        /** Wysłanie requesta POSTem, który wymaga response'a w formacie JSON */
        post: function (uri) {
            post(uri);
        },

        /** Opóźnienie - np. wykonanie akcji jak użytkownik przestanie pisać w inpucie */
        delay: (function () {
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            }
        })()
    };

    APP.prototype.listener = {
        /** [data-toggle=ajax] Wysyła requesta ajaxem, uri pobiera z atrubutu href lub data-uri */
        ajax: function () {
            $(document).on('click', 'button[data-toggle="ajax"], a[data-toggle="ajax"]', function () {
                var $button = $(this);
                var uri = $button.hasAttr('href') ? $button.attr('href') : $button.data('uri');

                if ( ! $button.hasClass('disabled')) {
                    $button.addClass('disabled');
                    post(uri);
                }
                return false;
            });
        },

        /** [data-toggle=bootbox|bootbox-replace] Wczytuje response w modalu za pomocą bootboxa */
        bootbox: function () {
            $(document).on('click', 'button[data-toggle^="bootbox"], a[data-toggle^="bootbox"]', function () {
                var $button = $(this);

                confirm($(this), function () {
                    var uri = $button.hasAttr('href') ? $button.attr('href') : $button.data('uri');

                    if ($button.data('toggle').indexOf('bootbox-replace') > -1) {
                        /** Cały modal zostanie podmieniony zawartością z URI */
                        app.bootbox(uri, $button.data('width'));
                    } else {
                        /** Zawartość z URI zostanie załadowane w miejsce modal-body  */
                        app.bootbox(uri, $button.data('width'), $button.data('title'));
                    }
                });

                return false;
            });
        },

        /** [class=chosen-select] Zamienia standardowego selecta w chosen-select */
        chosen: function () {
            $('select.chosen-select').each(function () {
                var placeholder = typeof $(this).attr('placeholder') === 'undefined' ? ' ' : $(this).attr('placeholder');

                $(this).chosen({
                    'placeholder_text_single': placeholder,
                    'placeholder_text_multiple': placeholder,
                    'allow_single_deselect': true
                });
            });
        },

        /** [data-toggle=datepicker][type=datetime|date|time] Dodaje datepickera do inputa */
        datepicker: function () {
            // kilkanie na ikonę również otwiera kalendarz
            $('input[data-toggle^="date"] + span.input-group-addon').on('click', function () {
                $(this).parent().find('input').trigger('focus');
            });


            $('input[data-toggle="datepicker"][type="datetime"]').datetimepicker({
                lang: 'pl',
                format:'Y-m-d H:i',
                mask: true
            });

            $('input[data-toggle="datepicker"][type="date"]').datetimepicker({
                lang: 'pl',
                timepicker: false,
                format:'Y-m-d',
                mask: true
            });

            $('input[data-toggle="datepicker_bez_maski"][type="date"]').datetimepicker({
                lang: 'pl',
                timepicker: false,
                format:'Y-m-d',
                mask: false
            });

            $('input[data-toggle="datepicker"][type="time"]').datetimepicker({
                lang: 'pl',
                datepicker: false,
                format:'H:i',
                mask: true
            });
        },

        /**
         * [data-toggle=icheck] Zamienia checkboxa na checkboxa-icheck i radio na radio-icheck
         *     [data-color] określenie koloru; domyślnie niebieski
         *     [data-checked-uri] request wysyłany ajaxem po zaznaczeniu
         *     [data-unchecked-uri] request wysyłany ajaxem po odznaczeniu
         */
        icheck: function() {
            $('input[type="checkbox"][data-toggle="icheck"], input[type="radio"][data-toggle="icheck"]').each(function (id, input) {
                var $input = $(input);
                var color = $input.data('color');

                icheck($input, color);

                var checkedUri   = $input.data('checked-uri');
                var uncheckedUri = $input.data('unchecked-uri');

                if (typeof checkedUri !== 'undefined') {
                    $input.on('ifChecked', function () {
                        $.post(checkedUri);
                    });
                }

                if (typeof uncheckedUri !== 'undefined') {
                    $input.on('ifUnchecked', function () {
                        $.post(uncheckedUri);
                    });
                }
            });
        },

        /** tr[data-href] Przemienia tr w klikającego tr - musy znajdować się w tbody i posaidać atrybut [data-href]  */
        row: function() {
            $(document).on('click', 'tbody tr[data-href]', function () {
                redirect($(this).data('href'));
            });
        },

        /** [data-toggle=slownik] Dodaje słownik do textarea */
        slownik: function() {
            $('textarea[data-slownik]').each(function (id, textarea) {
                var $textarea = $(textarea);
                var slownik = $textarea.data('slownik');
                $textarea.attr('data-slownik', null); // słownik wczytujemy tylko raz
                $textarea.addClass('ze-slownikiem'); // dodajemy klasę ze-slownikiem (min-height: 200px)

                $.get(Routing.generate("slownik", slownik), function (data) {
                    var $textareaWrapper = $textarea.wrap('<div class="col-xs-6"></div>').parent();
                    $textareaWrapper.wrap('<div class="row"></div>');
                    $textareaWrapper.before('<div class="col-xs-6">' + data + '</div>');
                    var $row = $($textareaWrapper).parent();

                    // Przekopiowanie toggle-on do całego rowa
                    if ($textarea.hasClass('hide')) {
                        $row.addClass('hide');
                    }
                    toggleClass($textarea.data('toggleOn'), $row, $textarea.data('toggleClass'));

                    // Przeniesienie po kliknięciu ze słownika do textarea
                    $row.on('click', 'ul.slownik li [data-name=tresc]', function () {
                        var newValue = $textarea.val() + $(this).text() + "\n";
                        $textarea.val(newValue.replace(/_/g, "\n"));
                    });

                    // Edycja słownika
                    $row.on('click', 'ul.slownik li [data-name=edytuj]', function() {
                        var $div = $(this).closest('li').find('[data-name=tresc]');

                        if ($div.find('input').size() > 0) {
                            // już włączony tryb edycji
                            $div.find('input').focus();
                            return;
                        }

                        var value = $div.text();
                        $div.html('<input value="__value__" data-value="__value__"/>'.replace(/__value__/g, value));
                        $div.find('input').focus();
                    });
                    $row.on('keypress', 'ul.slownik li [data-name=tresc] input', function (e) {
                        var $div = $(this).closest('div');
                        var code = e.keyCode || e.which;

                        if (code == 13) { // ENTER
                            e.preventDefault();
                            edytuj($(this).val(), $div);
                        }

                        if (code == 27) { // ESC
                            $div.text($(this).data('value'));
                        }
                    });

                    // Usuwanie ze słownika
                    $row.on('click', 'ul.slownik li [data-name=usun] i', function () {
                        usunZeSlownika($(this).closest('li'));
                    });

                    // Dodawanie nowego wyrażenia do słownika
                    $row.on('click', '.input-group.slownik button', function () {
                        var $input = $row.find('.input-group.slownik input');
                        dodajDoSlownika($input.val(), $row);
                        $input.val('');
                    });
                    $row.on('keypress', '.input-group.slownik input', function (e) {
                        var code = e.keyCode || e.which;

                        if (code == 13) { // ENTER
                            e.preventDefault();
                            dodajDoSlownika($(this).val(), $row);
                            $(this).val('');
                        }
                    });

                });

                function dodajDoSlownika(tresc, $row) {
                    if (typeof tresc === 'undefined' || tresc == '') {
                        return;
                    }

                    $.post(Routing.generate("slownik.dodaj"), { idfdm: slownik.idfdm, nazwa: slownik.nazwa, tresc: tresc }, function (data) {
                        var $ul = $row.find('ul.slownik');
                        var newLi = $ul.data('prototype')
                            .replace(/__id__/g, data.id)
                            .replace(/__tresc__/g, data.tresc);

                        if ($ul.find('li').size() == 0) {
                            $ul.html('');
                        }

                        $ul.append(newLi);
                        app.form.focus($row);
                    });
                }

                function edytuj(tresc, div) {
                    var id = $(div).closest('li').data('element-id');

                    $.post(Routing.generate("slownik.edytuj", { id: id }), { tresc: tresc }, function () {
                        $(div).text(tresc);
                    });
                }

                function usunZeSlownika(li) {
                    var id = $(li).data('element-id');

                    $.post(Routing.generate("slownik.usun", { id: id }), function () {
                        $(li).detach();
                    });
                }
            });
        },

        /** [data-toggle-on] Wywołuje 'toggleClass' na podstawie zdarzenia 'click' na elemencie, wskazanym przez atrybut [data-toggle-on] */
        toggleClass: function () {
            $('[data-toggle-on]').each(function () {
                toggleClass($(this).data('toggle-on'), this, $(this).data('toggle-class'));
                $(this).attr('data-toggle-on', null);
            });
        },

        /** [title] Dodaje tooltip dla każdego elementu posiadającego atrybut [title] */
        tooltip: function () {
            $('[title]').tooltip();

            $(document).on('chosen:ready', 'select.chosen-select[title]', function (event, obj) {
                var $div = $(obj.chosen.container);

                $div.tooltip({
                    title: $(obj.chosen.form_field).data('original-title')
                });
            });
        },

        /** [class=uppercase] Zamienia litery na drukowane */
        uppercase: function () {
            $(document).on('keyup', 'input.uppercase, textarea.uppercase', function () {
                $(this).val(($(this).val()).toUpperCase());
            });
        }
    };

    APP.prototype.form = {
        /** Focusuje pierwszy element formularza we wskaznym kontekście */
        focus: function (context) {
            $(context).find('form').first().find('input, select, textarea').first().focus();
        },

        /**
         * Dla eventu obj.change() wysyła request POSTem na uri z atrybutu [data-uri] elementu uriElement.
         * Jeżeli nie został określony to wyszukje element .modal-dialog[data-uri], jeżeli takowy nie istnieje
         * to brany jest adres z form[action]. Z responsa podmienia element wskazany przez replaceSelector.
         */
        onChange: function (obj, replaceSelector, uriElement) {
            var $obj = $(obj);

            if (typeof uriElement === 'undefined') {
                uriElement = '.modal-dialog[data-uri]';
            }

            $obj.change(function() {
                var $uriElement = $(uriElement);
                var uri = $uriElement.data('uri');

                if (typeof uri === 'undefined') {
                    uri = $obj.closest('form').attr('action');
                }

                var data = {};
                data[$obj.attr('name')] = $obj.val();

                $.post(uri, data, function (html) {
                    var $replace = $(replaceSelector);

                    $replace.replaceWith(
                        $(html).find(replaceSelector)
                    );

                    $(replaceSelector + '_chosen').detach();
                });
            });
        }
    };

    APP.prototype.modal = {
        /** Zamyka bootboxa i wyświetla komunikat z błędem */
        alert: function (message) {
            bootbox.hideAll();
            alertify.alert(message);
        },

        /** button[type=submit] Submituje formularz ajaxem  */
        submit: function () {
            var $dialog = $('.modal-dialog');
            $dialog.on('click', 'button[type=submit]', function () {
                var $form = $(this).closest('form');
                var action = $form.attr('action');

                if (action == '' || typeof action === 'undefined') {
                    action = $dialog.data('uri');
                }

                $.post(action, $form.serialize(), function (data) {
                    if ( ! processJSON(data)) {
                        var $content = $('.modal-content');
                        $content.replaceWith(data);
                    }
                });

                return false;
            });
        }
    };

    var app = new APP();

    if ( !window.APP ) {
        window.APP = app;
    }
})(jQuery);
