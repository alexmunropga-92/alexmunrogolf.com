// Show the thank-you popup when the MailPoet contact form (#2) submits successfully.
// MailPoet adds "mailpoet_form_successfully_send" to the form on success, so we watch for that class.
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#mailpoet_form_2 form.mailpoet_form').forEach(function (form) {
        var observer = new MutationObserver(function () {
            if (!form.classList.contains('mailpoet_form_successfully_send')) {
                return;
            }
            observer.disconnect();
            form.closest('.form-wrapper')?.classList.add('form-wrapper--sent');
            window.dispatchEvent(new CustomEvent('enquiry-sent'));
        });
        observer.observe(form, { attributes: true, attributeFilter: ['class'] });
    });
});
