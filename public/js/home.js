
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    const badgeSlider = new BadgeSlider();
    badgeSlider.init();

    const servicesSection = new ServicesSection();
    servicesSection.init();

    const techSection = new TechSection();
    techSection.init();

    const servicesSlider = new ServicesSlider();
    servicesSlider.init();

    const contactSection = new ContactSection();
    contactSection.init();

    const footer = new Footer();
    footer.init();
});
