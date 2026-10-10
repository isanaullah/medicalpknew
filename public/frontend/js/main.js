// ==========================================================================
// Medical.pk — Shared JavaScript
// ==========================================================================

if (window.gsap && window.ScrollTrigger) {
  gsap.registerPlugin(ScrollTrigger);
}

document.addEventListener('DOMContentLoaded', () => {
  // Icons
  if (window.lucide) lucide.createIcons();

  // Navbar scroll state
  const navbar = document.getElementById('navbar');
  const onScroll = () => {
    if (!navbar) return;
    if (window.scrollY > 80) navbar.classList.add('glass');
    else navbar.classList.remove('glass');
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu toggle
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
      const isHidden = mobileMenu.classList.contains('hidden');
      if (isHidden) {
        mobileMenu.classList.remove('hidden');
        mobileMenu.classList.add('open');
        menuToggle.innerHTML = '<i data-lucide="x" class="w-6 h-6"></i>';
      } else {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('open');
        menuToggle.innerHTML = '<i data-lucide="menu" class="w-6 h-6"></i>';
      }
      if (window.lucide) lucide.createIcons();
    });
  }

  // Active nav link detection
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-link, #mobile-menu a').forEach((link) => {
    const href = link.getAttribute('href');
    if (!href) return;
    const hrefPage = href.split('/').pop();
    if (hrefPage === currentPage || (currentPage === '' && hrefPage === 'index.html')) {
      link.classList.add('active');
    }
  });

  // Smooth scroll for in-page anchors
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId.length <= 1) return;
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        window.scrollTo({ top: target.offsetTop - 90, behavior: 'smooth' });
      }
    });
  });

  // GSAP ScrollTrigger — fade-up
  if (window.gsap && window.ScrollTrigger) {
    document.querySelectorAll('.fade-up').forEach((el) => {
      gsap.fromTo(
        el,
        { opacity: 0, y: 40 },
        {
          opacity: 1,
          y: 0,
          duration: 0.7,
          ease: 'power2.out',
          scrollTrigger: { trigger: el, start: 'top 88%', once: true },
        }
      );
    });

    document.querySelectorAll('.fade-in').forEach((el) => {
      gsap.fromTo(
        el,
        { opacity: 0 },
        {
          opacity: 1,
          duration: 0.9,
          ease: 'power1.out',
          scrollTrigger: { trigger: el, start: 'top 90%', once: true },
        }
      );
    });

    document.querySelectorAll('.stagger-parent').forEach((parent) => {
      const items = parent.querySelectorAll('.stagger-item');
      if (!items.length) return;
      gsap.fromTo(
        items,
        { opacity: 0, y: 30 },
        {
          opacity: 1,
          y: 0,
          duration: 0.6,
          stagger: 0.1,
          ease: 'power2.out',
          scrollTrigger: { trigger: parent, start: 'top 80%', once: true },
        }
      );
    });
  } else {
    // Fallback: reveal without animation
    document.querySelectorAll('.fade-up, .fade-in, .stagger-item').forEach((el) => {
      el.style.opacity = '1';
    });
  }

  // Counter animation
  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const suffix = el.dataset.suffix || '';
    const duration = 2000;
    const startTime = performance.now();
    function update(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.floor(eased * target);
      el.textContent = current.toLocaleString() + suffix;
      if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  }

  const counterEls = document.querySelectorAll('[data-target]');
  if (counterEls.length) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.5 }
    );
    counterEls.forEach((el) => observer.observe(el));
  }

  // Marquee pause on hover
  document.querySelectorAll('.marquee-row').forEach((row) => {
    row.addEventListener('mouseenter', () => {
      const track = row.querySelector('.marquee-track');
      if (track) track.style.animationPlayState = 'paused';
    });
    row.addEventListener('mouseleave', () => {
      const track = row.querySelector('.marquee-track');
      if (track) track.style.animationPlayState = 'running';
    });
  });

  // FAQ accordion (generic, works on any page containing .faq-item)
  document.querySelectorAll('.faq-item').forEach((item) => {
    const question = item.querySelector('.faq-question');
    if (!question) return;
    question.addEventListener('click', () => {
      const answer = item.querySelector('.faq-answer');
      const chevron = item.querySelector('.faq-chevron');
      const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';

      document.querySelectorAll('.faq-answer').forEach((a) => (a.style.maxHeight = '0px'));
      document.querySelectorAll('.faq-chevron').forEach((c) => (c.style.transform = 'rotate(0deg)'));

      if (!isOpen) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        if (chevron) chevron.style.transform = 'rotate(180deg)';
      }
    });
  });

  // Filter pills (courses, notes, blog)
  document.querySelectorAll('.filter-bar').forEach((bar) => {
    const pills = bar.querySelectorAll('.filter-pill');
    const targetSelector = bar.dataset.target;
    if (!targetSelector) return;
    const cards = document.querySelectorAll(targetSelector);
    pills.forEach((pill) => {
      pill.addEventListener('click', () => {
        pills.forEach((p) => p.classList.remove('active'));
        pill.classList.add('active');
        const filter = pill.dataset.filter;
        cards.forEach((card) => {
          const match = filter === 'All' || card.dataset.subject === filter || card.dataset.category === filter;
          if (match) {
            card.style.display = '';
            requestAnimationFrame(() => {
              card.style.opacity = '1';
              card.style.transform = 'translateY(0)';
            });
          } else {
            card.style.opacity = '0';
            card.style.transform = 'translateY(8px)';
            setTimeout(() => {
              card.style.display = 'none';
            }, 200);
          }
        });
      });
    });
  });
});
