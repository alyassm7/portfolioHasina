/**
 * Portfolio Premium — Hasina Ralison
 * Particles, smooth scroll, GSAP, tilt, counters
 */
(function () {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

    /* ── Theme ── */
    function initTheme() {
        const html = document.documentElement;
        const toggle = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        const saved = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', saved);
        updateIcon(saved);

        toggle?.addEventListener('click', () => {
            const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            updateIcon(next);
        });

        function updateIcon(theme) {
            if (icon) icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }
    }

    /* ── Lenis smooth scroll ── */
    function initLenis() {
        if (prefersReducedMotion || typeof Lenis === 'undefined') return null;
        const lenis = new Lenis({ duration: 1.1, smoothWheel: true, touchMultiplier: 1.5 });
        lenis.on('scroll', ScrollTrigger?.update);
        gsap.ticker.add((time) => lenis.raf(time * 1000));
        gsap.ticker.lagSmoothing(0);
        return lenis;
    }

    /* ── AOS ── */
    function initAOS() {
        if (typeof AOS === 'undefined') return;
        AOS.init({ duration: 900, once: true, offset: 60, easing: 'ease-out-cubic' });
    }

    /* ── Typed.js hero ── */
    function initTyped() {
        const el = document.getElementById('typed-roles');
        const roles = window.portfolioHeroRoles || [];
        if (!el || typeof Typed === 'undefined' || !roles.length) return;
        new Typed('#typed-roles', {
            strings: roles,
            typeSpeed: 45,
            backSpeed: 28,
            backDelay: 2200,
            loop: true,
            showCursor: true,
            cursorChar: '|',
        });
    }

    /* ── Vanilla Tilt ── */
    function initTilt() {
        if (prefersReducedMotion || typeof VanillaTilt === 'undefined') return;
        VanillaTilt.init(document.querySelectorAll('[data-tilt]'), {
            max: 10,
            speed: 400,
            glare: true,
            'max-glare': 0.12,
            scale: 1.02,
        });
    }

    /* ── CountUp stats ── */
    function initCounters() {
        const els = document.querySelectorAll('.stat-number[data-count]');
        if (!els.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const target = parseInt(el.dataset.count, 10);
                const suffix = el.dataset.suffix || '';
                if (isNaN(target)) return;

                if (typeof countUp !== 'undefined' && countUp.CountUp) {
                    const counter = new countUp.CountUp(el, target, {
                        duration: 2.5,
                        suffix: suffix,
                        useGrouping: false,
                    });
                    if (!counter.error) counter.start();
                } else {
                    animateFallback(el, target, suffix);
                }
                observer.unobserve(el);
            });
        }, { threshold: 0.4 });

        els.forEach((el) => observer.observe(el));
    }

    function animateFallback(el, target, suffix) {
        let current = 0;
        const step = Math.max(1, Math.ceil(target / 80));
        const timer = setInterval(() => {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = current + suffix;
        }, 20);
    }

    /* ── Skill bars ── */
    function initSkillBars() {
        const bars = document.querySelectorAll('.skill-progress');
        if (!bars.length) return;
        const obs = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.style.width = e.target.dataset.width + '%';
                }
            });
        }, { threshold: 0.4 });
        bars.forEach((b) => obs.observe(b));
    }

    /* ── GSAP scroll animations ── */
    function initGSAP() {
        if (prefersReducedMotion || typeof gsap === 'undefined') return;

        gsap.from('.hero-greeting', { opacity: 0, y: 30, duration: 1, delay: 0.2, ease: 'power3.out' });
        gsap.from('.hero-title', { opacity: 0, y: 40, duration: 1, delay: 0.35, ease: 'power3.out' });
        gsap.from('.hero-typed', { opacity: 0, y: 30, duration: 1, delay: 0.5, ease: 'power3.out' });
        gsap.from('.hero-actions', { opacity: 0, y: 30, duration: 1, delay: 0.65, ease: 'power3.out' });
        gsap.from('.hero-photo-wrap', { opacity: 0, scale: 0.9, duration: 1.2, delay: 0.4, ease: 'power3.out' });

        document.querySelectorAll('.section-title').forEach((el) => {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 85%', toggleActions: 'play none none none' },
                opacity: 0, y: 50, filter: 'blur(8px)', duration: 1, ease: 'power3.out',
            });
        });

        document.querySelectorAll('.glass-card').forEach((el, i) => {
            if (el.closest('.hero-section')) return;
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' },
                opacity: 0, y: 40, rotateX: 8, duration: 0.8, delay: (i % 4) * 0.05, ease: 'power2.out',
            });
        });
    }

    /* ── Navbar scroll ── */
    function initNavbar() {
        const nav = document.querySelector('.portfolio-nav');
        if (!nav) return;
        const onScroll = () => nav.classList.toggle('nav-scrolled', window.scrollY > 40);
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ── Cursor glow ── */
    function initCursor() {
        if (isTouch || prefersReducedMotion) return;
        const glow = document.getElementById('cursorGlow');
        if (!glow) return;

        let mx = 0, my = 0, cx = 0, cy = 0;
        document.addEventListener('mousemove', (e) => { mx = e.clientX; my = e.clientY; }, { passive: true });

        function tick() {
            cx += (mx - cx) * 0.12;
            cy += (my - cy) * 0.12;
            glow.style.transform = `translate(${cx}px, ${cy}px)`;
            requestAnimationFrame(tick);
        }
        tick();
    }

    /* ── Particle canvas (120+ shapes) ── */
    function initParticles() {
        if (prefersReducedMotion) return;
        const canvas = document.getElementById('particleCanvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        let w, h, particles = [], mouse = { x: -9999, y: -9999 };
        const TYPES = ['circle', 'square', 'triangle', 'hex', 'ring', 'dot', 'line', 'diamond'];
        const COUNT = 130;

        function resize() {
            w = canvas.width = window.innerWidth;
            h = canvas.height = window.innerHeight;
        }

        function createParticle() {
            const type = TYPES[Math.floor(Math.random() * TYPES.length)];
            return {
                x: Math.random() * w,
                y: Math.random() * h,
                size: Math.random() * 4 + 1,
                type,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                rot: Math.random() * Math.PI * 2,
                rotSpeed: (Math.random() - 0.5) * 0.02,
                opacity: Math.random() * 0.35 + 0.05,
                parallax: Math.random() * 0.5 + 0.2,
                pulse: Math.random() * Math.PI * 2,
            };
        }

        function drawShape(p) {
            ctx.save();
            ctx.translate(p.x, p.y);
            ctx.rotate(p.rot);
            ctx.globalAlpha = p.opacity;
            ctx.strokeStyle = 'rgba(94, 234, 212, 0.6)';
            ctx.fillStyle = 'rgba(45, 212, 191, 0.15)';
            ctx.lineWidth = 0.8;
            const s = p.size * (1 + Math.sin(p.pulse) * 0.15);

            switch (p.type) {
                case 'circle':
                    ctx.beginPath(); ctx.arc(0, 0, s, 0, Math.PI * 2); ctx.fill(); break;
                case 'square':
                    ctx.fillRect(-s, -s, s * 2, s * 2); break;
                case 'triangle':
                    ctx.beginPath();
                    ctx.moveTo(0, -s); ctx.lineTo(s, s); ctx.lineTo(-s, s);
                    ctx.closePath(); ctx.fill(); break;
                case 'hex':
                    ctx.beginPath();
                    for (let i = 0; i < 6; i++) {
                        const a = (Math.PI / 3) * i;
                        const px = Math.cos(a) * s, py = Math.sin(a) * s;
                        i === 0 ? ctx.moveTo(px, py) : ctx.lineTo(px, py);
                    }
                    ctx.closePath(); ctx.stroke(); break;
                case 'ring':
                    ctx.beginPath(); ctx.arc(0, 0, s, 0, Math.PI * 2); ctx.stroke(); break;
                case 'dot':
                    ctx.beginPath(); ctx.arc(0, 0, s * 0.5, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(59, 130, 246, 0.5)'; ctx.fill(); break;
                case 'line':
                    ctx.beginPath(); ctx.moveTo(-s * 2, 0); ctx.lineTo(s * 2, 0); ctx.stroke(); break;
                case 'diamond':
                    ctx.beginPath();
                    ctx.moveTo(0, -s); ctx.lineTo(s, 0); ctx.lineTo(0, s); ctx.lineTo(-s, 0);
                    ctx.closePath(); ctx.fill(); break;
            }
            ctx.restore();
        }

        function update() {
            const scrollY = window.scrollY;
            particles.forEach((p) => {
                p.x += p.vx;
                p.y += p.vy + scrollY * p.parallax * 0.001;
                p.rot += p.rotSpeed;
                p.pulse += 0.02;

                const dx = p.x - mouse.x, dy = p.y - mouse.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 120) {
                    const force = (120 - dist) / 120;
                    p.x += (dx / dist) * force * 2.5;
                    p.y += (dy / dist) * force * 2.5;
                }

                if (p.x < -20) p.x = w + 20;
                if (p.x > w + 20) p.x = -20;
                if (p.y < -20) p.y = h + 20;
                if (p.y > h + 20) p.y = -20;
            });
        }

        function render() {
            ctx.clearRect(0, 0, w, h);
            particles.forEach(drawShape);
        }

        function loop() {
            update();
            render();
            requestAnimationFrame(loop);
        }

        resize();
        for (let i = 0; i < COUNT; i++) particles.push(createParticle());
        window.addEventListener('resize', resize);
        if (!isTouch) {
            window.addEventListener('mousemove', (e) => { mouse.x = e.clientX; mouse.y = e.clientY; }, { passive: true });
        }
        loop();
    }

    /* ── Project filter pills ── */
    function initProjectFilters() {
        const pills = document.querySelectorAll('.filter-pill');
        const cols = document.querySelectorAll('.project-col');
        const noMsg = document.getElementById('noProjectsMsg');
        if (!pills.length || !cols.length) return;

        const map = window.projectFilterMap || {};

        pills.forEach((pill) => {
            pill.addEventListener('click', () => {
                pills.forEach((p) => p.classList.remove('active'));
                pill.classList.add('active');
                const filter = pill.dataset.filter;
                let visible = 0;

                cols.forEach((col) => {
                    let techs = [];
                    try { techs = JSON.parse(col.dataset.techs || '[]'); } catch (_) {}
                    const techStr = techs.join(' ').toLowerCase();
                    const title = col.textContent.toLowerCase();
                    let show = filter === 'all';

                    if (!show && map[filter]) {
                        show = map[filter].some((k) => techStr.includes(k.toLowerCase()) || title.includes(k.toLowerCase()));
                    }

                    col.style.display = show ? '' : 'none';
                    if (show) visible++;
                });

                if (noMsg) noMsg.classList.toggle('d-none', visible > 0);
            });
        });
    }

    /* ── Init ── */
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }
        initTheme();
        initAOS();
        initLenis();
        initParticles();
        initCursor();
        initNavbar();
        initTyped();
        initTilt();
        initCounters();
        initSkillBars();
        initGSAP();
        initProjectFilters();
    });
})();
