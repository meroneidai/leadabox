/**
 * Leadabox front-end. No framework — just the small amount of behaviour the
 * design needs, kept dependency-free so the first paint stays fast.
 */

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ---------- scroll reveal ---------- */

function initReveal() {
  const items = document.querySelectorAll('.reveal');
  if (!items.length) return;

  if (reduceMotion || !('IntersectionObserver' in window)) {
    items.forEach((el) => el.classList.add('is-visible'));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const delay = Number(entry.target.dataset.revealDelay || 0);
        window.setTimeout(() => entry.target.classList.add('is-visible'), delay);
        observer.unobserve(entry.target);
      });
    },
    { rootMargin: '0px 0px -10% 0px', threshold: 0.08 }
  );

  items.forEach((el) => observer.observe(el));
}

/* ---------- 3D hero parallax ---------- */

function initStage() {
  const stage = document.querySelector('[data-stage]');
  if (!stage || reduceMotion) return;

  const layers = Array.from(stage.querySelectorAll('[data-depth]'));
  if (!layers.length) return;

  let raf = null;
  let targetX = 0;
  let targetY = 0;
  let currentX = 0;
  let currentY = 0;

  const render = () => {
    currentX += (targetX - currentX) * 0.08;
    currentY += (targetY - currentY) * 0.08;

    layers.forEach((layer) => {
      const depth = Number(layer.dataset.depth || 1);
      const z = Number(layer.dataset.z || 0);
      const x = currentX * depth * 26;
      const y = currentY * depth * 20;
      const rotX = (-currentY * depth * 7).toFixed(2);
      const rotY = (currentX * depth * 9).toFixed(2);

      layer.style.transform = `translate3d(${x.toFixed(2)}px, ${y.toFixed(2)}px, ${z}px) rotateX(${rotX}deg) rotateY(${rotY}deg)`;
    });

    if (Math.abs(targetX - currentX) > 0.001 || Math.abs(targetY - currentY) > 0.001) {
      raf = requestAnimationFrame(render);
    } else {
      raf = null;
    }
  };

  const queue = () => {
    if (raf === null) raf = requestAnimationFrame(render);
  };

  stage.addEventListener('pointermove', (event) => {
    const rect = stage.getBoundingClientRect();
    targetX = (event.clientX - rect.left) / rect.width - 0.5;
    targetY = (event.clientY - rect.top) / rect.height - 0.5;
    queue();
  });

  stage.addEventListener('pointerleave', () => {
    targetX = 0;
    targetY = 0;
    queue();
  });

  // Gyroscope parallax on phones, which is where the depth reads best.
  if (window.DeviceOrientationEvent && 'ontouchstart' in window) {
    window.addEventListener(
      'deviceorientation',
      (event) => {
        if (event.gamma === null || event.beta === null) return;
        targetX = Math.max(-0.5, Math.min(0.5, event.gamma / 45));
        targetY = Math.max(-0.5, Math.min(0.5, (event.beta - 45) / 45));
        queue();
      },
      { passive: true }
    );
  }
}

/* ---------- header ---------- */

function initHeader() {
  const header = document.querySelector('[data-header]');
  if (!header) return;

  const onScroll = () => {
    header.classList.toggle('is-scrolled', window.scrollY > 12);
  };

  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  const toggle = document.querySelector('[data-menu-toggle]');
  const panel = document.querySelector('[data-menu-panel]');

  if (toggle && panel) {
    toggle.addEventListener('click', () => {
      const open = panel.hasAttribute('hidden');
      if (open) {
        panel.removeAttribute('hidden');
        document.body.style.overflow = 'hidden';
      } else {
        panel.setAttribute('hidden', '');
        document.body.style.overflow = '';
      }
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    panel.addEventListener('click', (event) => {
      if (event.target.closest('a')) {
        panel.setAttribute('hidden', '');
        document.body.style.overflow = '';
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }
}

/* ---------- disclosure groups (FAQ) ---------- */

function initFaq() {
  document.querySelectorAll('[data-faq]').forEach((group) => {
    group.addEventListener('toggle', (event) => {
      const opened = event.target;
      if (!opened.open) return;
      group.querySelectorAll('details[open]').forEach((other) => {
        if (other !== opened) other.open = false;
      });
    });
  });
}

/* ---------- language switcher ---------- */

function initLangSwitcher() {
  document.querySelectorAll('[data-lang-switch]').forEach((wrap) => {
    const button = wrap.querySelector('[data-lang-button]');
    const list = wrap.querySelector('[data-lang-list]');
    if (!button || !list) return;

    button.addEventListener('click', (event) => {
      event.stopPropagation();
      const open = list.hasAttribute('hidden');
      document.querySelectorAll('[data-lang-list]').forEach((l) => l.setAttribute('hidden', ''));
      if (open) list.removeAttribute('hidden');
      button.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });

  document.addEventListener('click', () => {
    document.querySelectorAll('[data-lang-list]').forEach((l) => l.setAttribute('hidden', ''));
    document.querySelectorAll('[data-lang-button]').forEach((b) => b.setAttribute('aria-expanded', 'false'));
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initReveal();
  initStage();
  initHeader();
  initFaq();
  initLangSwitcher();
});

