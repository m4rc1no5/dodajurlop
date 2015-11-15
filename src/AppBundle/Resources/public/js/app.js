/**
 * Created by marcinos on 15.11.15.
 */

;(function ($) {
    'use strict';

    $.fn.hasAttr = function (name) { return this.attr(name) !== undefined; };

    var defaults = {
        bootbox: function() {
            bootbox.setDefaults({
                onEscape: true
            });
        }
    };

    function confirm (obj, onOkCallback) {
        var $obj = $(obj);

        if ($obj.data('confirm')) {
            //alertify.confirm($obj.data('confirm'), onOkCallback);
            onOkCallback();
        } else {
            onOkCallback();
        }
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
                alert('Nieznany statusCode (' + data.statusCode + ')');
        }

        return true;
    }

    function redirect (url) {
        window.location.href = url;
    }

    function App() {
        this.init();
    }

    App.prototype = {
        constructor: App,
        initialized: false,
        init: function() {
            $(document).ready(function() {
                if(app.initialized === false) {
                    app.initialized = true;

                    defaults.bootbox();

                    //zabieg za pomocą którego możliwe jest wyświetlenie okienka bootbox po załadowaniu
                    $(this).ajaxStop(function () {
                        $('.modal-dialog').show();
                        app.init();
                    });

                    app.listener.bootbox();

                    app.init();
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
        }
    };

    App.prototype.listener = {

        /** [data-toggle=bootbox|bootbox-replace] Wczytuje response w modalu za pomocą bootboxa */
        bootbox: function() {
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
        }

    };

    App.prototype.modal = {
        /** Zamyka bootboxa i wyświetla komunikat z błędem */
        alert: function (message) {
            bootbox.hideAll();
            alert(message);
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

    var app = new App();

    if ( !window.App ) {
        window.App = app;
    }

})(jQuery);