// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/messages/>.

/**
 * Show a delete message modal instead of doing it on a separate page.
 *
 * @module     local_blog
 */
define(['jquery', 'core/modal_factory', 'core/str', 'core/modal_events', 'core/ajax', 'core/notification'], function($, ModalFactory, String, ModalEvents, Ajax, Notification) {
    var trigger = $('.local_blog_delete_button');
    ModalFactory.create({
        type: ModalFactory.types.SAVE_CANCEL,
        title: String.get_string('delete_news', 'local_blog'),
        body: String.get_string('delete_news_confirm', 'local_blog'),
        preShowCallback: function(triggerElement, modal) {
            // Do something before we show the delete modal.
            triggerElement = $(triggerElement);

            let classString = triggerElement[0].classList[0]; // local_newsid13
            let newsid = classString.substr(classString.lastIndexOf('local_newsid') + 'local_newsid'.length);
            // Set the message id in this modal.
            modal.params = {'newsid': newsid };

            modal.setSaveButtonText(String.get_string('delete_news', 'local_blog'));
        },
        large: true,
    }, trigger)
        .done(function(modal) {

            // Do what you want with your new modal.
            modal.getRoot().on(ModalEvents.save, function(e) {
                // Stop the default save button behaviour which is to close the modal.
                e.preventDefault();

                let footer = Y.one('.modal-footer');
                footer.setContent('Deleting...');
                let spinner = M.util.add_spinner(Y, footer);
                spinner.show();
                let request = {
                    methodname: 'local_blog_delete_news',
                    args: modal.params,
                };
                Ajax.call([request])[0].done(function(data) {
                    if (data === true) {
                        // Redirect to manage page.
                        window.location.reload();
                    } else {
                        Notification.addNotification({
                            message: String.get_string('delete_news_failed', 'local_blog'),
                            type: 'error',
                        });
                    }
                }).fail(Notification.exception);
            });
        });

});
