<?php
// Enquiry form: posts to admin-post (see ajm_handle_enquiry in functions.php), which emails alex@alexmunrogolf.com
// and redirects back here with ?enquiry=sent or ?enquiry=error
$status = sanitize_key($_GET['enquiry'] ?? '');
?>
<div class="form-wrapper <?php echo $status === 'sent' ? 'form-wrapper--sent' : ''; ?>">
    <form class="enquiry-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php', 'relative')); ?>">
        <input type="hidden" name="action" value="ajm_enquiry">
        <input type="hidden" name="redirect_to" value="<?php echo esc_url(get_permalink() ?: home_url('/')); ?>">
        <div aria-hidden="true" style="position:absolute;left:-9999px;">
            <label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <input type="text" name="first_name" placeholder="First name" aria-label="First name" autocomplete="given-name" required>
            <input type="text" name="last_name" placeholder="Last name" aria-label="Last name" autocomplete="family-name">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <input type="email" name="email" placeholder="Email address" aria-label="Email address" autocomplete="email" required>
            <input type="tel" name="phone" placeholder="Phone number" aria-label="Phone number" autocomplete="tel">
        </div>
        <textarea name="message" placeholder="Your message" aria-label="Your message" class="mb-4" required></textarea>
        <?php if ($status === 'error') : ?>
            <p class="text-white mb-3" role="alert">Sorry, your message could not be sent. Please check your details or email alex@alexmunrogolf.com instead.</p>
        <?php endif; ?>
        <button type="submit" class="enquiry-form__submit">Send enquiry</button>
    </form>
</div>
