<div
    x-data="{ open: false }"
    @enquiry-sent.window="open = true; $nextTick(() => $refs.close.focus())"
    @keydown.escape.window="open = false"
    x-show="open"
    x-transition.opacity
    x-cloak
    style="display: none;"
    class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 px-4"
    @click.self="open = false"
    role="dialog"
    aria-modal="true"
    aria-labelledby="enquiry-thank-you-title"
    >
    <div class="bg-white rounded-md shadow-xl max-w-md w-full p-8 text-center text-[var(--blue)]">
        <svg class="mx-auto mb-4 text-green" aria-hidden="true" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/></svg>
        <h2 id="enquiry-thank-you-title" class="text-2xl md:text-3xl font-bold mb-3">Thank you!</h2>
        <p class="text-lg mb-6">Your enquiry has been sent. I'll be in touch as soon as possible.</p>
        <button
            type="button"
            x-ref="close"
            @click="open = false"
            class="sm:text-lg text-md rounded-[50px] sm:py-3 py-2 sm:px-8 px-6 inline-block transition duration-300 border bg-blue text-white hover:bg-white hover:text-[var(--blue)] border-[var(--blue)] cursor-pointer"
            >
            Close
        </button>
    </div>
</div>
