 // Simpele reveal-animatie: elementen glijden zacht in beeld.
(function () {
  const targets = document.querySelectorAll(
    '.kpi-card, .pillar-card, .team-card, .cta-inner, .hero-media img'
  );

  targets.forEach(el => el.classList.add('reveal'));

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('is-visible');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.15 });

  targets.forEach(el => io.observe(el));
})();
