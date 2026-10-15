// After the enquiry form redirects back with ?enquiry=sent, show the thank-you popup and scroll to the form.
document.addEventListener('DOMContentLoaded', function () {
    var url = new URL(window.location.href);
    if (url.searchParams.get('enquiry') !== 'sent') {
        return;
    }
    window.dispatchEvent(new CustomEvent('enquiry-sent'));
    document.querySelector('.form-wrapper--sent')?.scrollIntoView({ block: 'center' });
    url.searchParams.delete('enquiry');
    window.history.replaceState({}, '', url.pathname + url.search + url.hash);
});
