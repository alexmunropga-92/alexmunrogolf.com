const sections = document.querySelectorAll('.transition-section');

sections.forEach(section => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('transition-section--visible');
            } else {
                entry.target.classList.remove('transition-section--visible');
            }
        });
    }, { threshold: 0.1 });

    observer.observe(section);
});