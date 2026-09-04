document.addEventListener('DOMContentLoaded', () => {
  const translations = {
    es: {
      navStays: 'Estadías', navExperiences: 'Experiencias', navContact: 'Consultar', openMenu: 'Abrir menú',
      heroCopy: 'Refugios elegidos para reconectar con el paisaje, el descanso y lo que importa.',
      heroAction: 'Descubrir estadías', destination: 'Destino', checkIn: 'Llegada', checkOut: 'Salida', guests: 'Huéspedes',
      twoGuests: '2 huéspedes', fourGuests: '4 huéspedes', sixGuests: '6 huéspedes', search: 'Buscar',
      introTitle: 'Hospedajes con<br><em>intención.</em>', introCopy: 'No coleccionamos lugares. Elegimos espacios que respetan su entorno y transforman una estadía en una pausa verdadera.',
      philosophy: 'Conocé nuestra filosofía', staysTitle: 'Elegí tu próximo refugio.', seeAll: 'Ver todos', wholeRetreat: 'Refugio completo',
      essentialTitle: 'Lo esencial<br>se siente.', essentialCopy: 'Cada lugar combina arquitectura consciente, hospitalidad cercana y una relación auténtica con el paisaje.',
      valueOne: 'Diseño que acompaña el entorno', valueTwo: 'Anfitriones y experiencias locales', valueThree: 'Ritmos más lentos, recuerdos más claros',
      storiesTitle: 'Historias para viajar distinto.', journalLink: 'Ir al journal', storyOne: 'Un fin de semana lento en la cordillera', storyTwo: 'Materiales que envejecen bien',
      finalTitle: 'Hay lugares que<br>te devuelven a vos.', finalAction: 'Consultar una estadía',
      bookingTitle: 'Empezá por<br><em>una consulta.</em>', bookingCopy: 'Contanos qué refugio te interesa y cuándo querés viajar. La consulta quedará guardada en WordPress para que el equipo pueda responderla.',
      bookingNote: 'Sin pago ni confirmación automática. Primero revisamos disponibilidad.', formName: 'Nombre', formStay: 'Refugio', formChooseStay: 'Elegí una opción', formMessage: 'Mensaje opcional', formSubmit: 'Enviar consulta',
      formSuccess: 'Recibimos tu consulta. Te responderemos pronto.', formPastDate: 'Las fechas de la estadía no pueden estar en el pasado.', formError: 'Revisá los datos e intentá nuevamente.',
      footerIntro: 'Refugios con diseño, naturaleza y tiempo para estar.', footerExplore: 'Explorar', footerContact: 'Contacto', yourEmail: 'Tu email', conceptCredit: 'Proyecto conceptual por Matías Speroni',
      archiveTitle: 'Refugios para<br><em>quedarse un poco más.</em>', archiveCopy: 'Una colección pequeña de lugares con diseño, calma y naturaleza cerca.',
      theStay: 'LA ESTADÍA', availability: 'Consultar disponibilidad', darkMode: 'Activar tema oscuro', lightMode: 'Activar tema claro', switchLanguage: 'Switch to English'
    },
    en: {
      navStays: 'Stays', navExperiences: 'Experiences', navContact: 'Inquire', openMenu: 'Open menu',
      heroCopy: 'Handpicked retreats to reconnect with the landscape, rest, and what truly matters.',
      heroAction: 'Discover stays', destination: 'Destination', checkIn: 'Check-in', checkOut: 'Check-out', guests: 'Guests',
      twoGuests: '2 guests', fourGuests: '4 guests', sixGuests: '6 guests', search: 'Search',
      introTitle: 'Stays with<br><em>intention.</em>', introCopy: 'We do not collect places. We choose spaces that respect their surroundings and turn a stay into a genuine pause.',
      philosophy: 'Discover our philosophy', staysTitle: 'Choose your next retreat.', seeAll: 'View all', wholeRetreat: 'Entire retreat',
      essentialTitle: 'The essential<br>can be felt.', essentialCopy: 'Every place combines thoughtful architecture, warm hospitality, and an authentic connection with the landscape.',
      valueOne: 'Design that belongs to its surroundings', valueTwo: 'Local hosts and experiences', valueThree: 'Slower rhythms, clearer memories',
      storiesTitle: 'Stories for a different way to travel.', journalLink: 'Visit the journal', storyOne: 'A slow weekend in the mountains', storyTwo: 'Materials that age beautifully',
      finalTitle: 'Some places<br>bring you back to yourself.', finalAction: 'Inquire about a stay',
      bookingTitle: 'Start with<br><em>an inquiry.</em>', bookingCopy: 'Tell us which retreat interests you and when you would like to travel. Your inquiry will be saved in WordPress so the team can respond.',
      bookingNote: 'No payment or automatic confirmation. We review availability first.', formName: 'Name', formStay: 'Retreat', formChooseStay: 'Choose an option', formMessage: 'Optional message', formSubmit: 'Send inquiry',
      formSuccess: 'We received your inquiry. We will be in touch soon.', formPastDate: 'Stay dates cannot be in the past.', formError: 'Please review the details and try again.',
      footerIntro: 'Design-led retreats, nature, and time to simply be.', footerExplore: 'Explore', footerContact: 'Contact', yourEmail: 'Your email', conceptCredit: 'Concept project by Matías Speroni',
      archiveTitle: 'Retreats worth<br><em>staying a little longer.</em>', archiveCopy: 'A small collection of places shaped by design, calm, and nearby nature.',
      theStay: 'THE STAY', availability: 'Check availability', darkMode: 'Enable dark theme', lightMode: 'Enable light theme', switchLanguage: 'Cambiar a español'
    }
  };

  const languageToggle = document.querySelector('[data-language-toggle]');
  const languageLabel = document.querySelector('[data-language-label]');
  const themeToggle = document.querySelector('[data-theme-toggle]');

  const applyLanguage = (language) => {
    const selected = translations[language] ? language : 'es';
    document.documentElement.lang = selected;
    document.documentElement.dataset.language = selected;

    document.querySelectorAll('[data-i18n]').forEach((element) => {
      const key = element.dataset.i18n;
      if (translations[selected][key]) element.textContent = translations[selected][key];
    });
    document.querySelectorAll('[data-i18n-html]').forEach((element) => {
      const key = element.dataset.i18nHtml;
      if (translations[selected][key]) element.innerHTML = translations[selected][key];
    });
    document.querySelectorAll('[data-i18n-placeholder]').forEach((element) => {
      const key = element.dataset.i18nPlaceholder;
      if (translations[selected][key]) element.placeholder = translations[selected][key];
    });
    document.querySelectorAll('[data-copy-es][data-copy-en]').forEach((element) => {
      element.textContent = selected === 'en' ? element.dataset.copyEn : element.dataset.copyEs;
    });

    if (languageToggle && languageLabel) {
      languageLabel.textContent = selected === 'es' ? 'EN' : 'ES';
      languageToggle.setAttribute('aria-label', translations[selected].switchLanguage);
    }
    localStorage.setItem('ladera-language', selected);
  };

  const applyTheme = (theme) => {
    const selected = theme === 'dark' ? 'dark' : 'light';
    document.documentElement.dataset.theme = selected;
    if (themeToggle) {
      const language = document.documentElement.dataset.language || 'es';
      const labelKey = selected === 'dark' ? 'lightMode' : 'darkMode';
      themeToggle.setAttribute('aria-label', translations[language][labelKey]);
      themeToggle.setAttribute('title', translations[language][labelKey]);
    }
    localStorage.setItem('ladera-theme', selected);
  };

  applyLanguage(localStorage.getItem('ladera-language') || 'es');
  applyTheme(document.documentElement.dataset.theme || 'light');

  languageToggle?.addEventListener('click', () => {
    const nextLanguage = document.documentElement.dataset.language === 'es' ? 'en' : 'es';
    applyLanguage(nextLanguage);
    applyTheme(document.documentElement.dataset.theme || 'light');
  });

  themeToggle?.addEventListener('click', () => {
    applyTheme(document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark');
  });

  const toggle = document.querySelector('[data-menu-toggle]');
  const menu = document.querySelector('[data-menu]');

  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!isOpen));
      menu.classList.toggle('is-open', !isOpen);
    });

    menu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        toggle.setAttribute('aria-expanded', 'false');
        menu.classList.remove('is-open');
      });
    });
  }

  const header = document.querySelector('[data-header]');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('is-scrolled', window.scrollY > 24);
    }, { passive: true });
  }
});

