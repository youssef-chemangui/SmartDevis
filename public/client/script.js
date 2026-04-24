    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });
    reveals.forEach(el => observer.observe(el));

    // Active nav on scroll
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 120) current = s.id;
      });
      navLinks.forEach(a => {
        a.style.color = a.getAttribute('href') === '#' + current ? 'var(--orange)' : '';
      });
    });

    // Simple form handler
    function handleSubmit(e) {
      e.preventDefault();
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const msg = document.getElementById('message').value.trim();
      const captcha = document.getElementById('captcha-a').value.trim();
      const formMsg = document.getElementById('form-msg');

      if (!name || !email || !msg) {
        formMsg.style.display = 'block';
        formMsg.textContent = 'Veuillez remplir tous les champs.';
        return;
      }
      if (captcha !== '13') {
        formMsg.style.display = 'block';
        formMsg.textContent = 'Captcha incorrect.';
        return;
      }
      formMsg.style.color = '#4caf50';
      formMsg.style.display = 'block';
      formMsg.textContent = 'Message envoyé ! Je vous répondrai rapidement.';
      e.target.reset();
    }