const navToggle = document.querySelector(".nav-toggle");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll("main section[id]");
const panels = document.querySelectorAll(".slide-section");
const year = document.querySelector("[data-year]");

const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

if (year) {
  year.textContent = new Date().getFullYear();
}

if (navToggle && navLinks) {
  navToggle.addEventListener("click", () => {
    const isOpen = navLinks.classList.toggle("open");
    navToggle.setAttribute("aria-expanded", String(isOpen));
  });
}

links.forEach((link) => {
  link.addEventListener("click", () => {
    navLinks?.classList.remove("open");
    navToggle?.setAttribute("aria-expanded", "false");
  });
});

if ("IntersectionObserver" in window) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;

        links.forEach((link) => {
          link.classList.toggle(
            "active",
            link.getAttribute("href") === `#${entry.target.id}`,
          );
        });
      });
    },
    { rootMargin: "-35% 0px -55% 0px" },
  );

  sections.forEach((section) => observer.observe(section));
}

const updateSideMotion = () => {
  const viewportCenter = window.innerHeight / 2;

  panels.forEach((section) => {
    const panel = section.querySelector(".slide-panel");
    if (!panel) return;

    const rect = section.getBoundingClientRect();
    const sectionCenter = rect.top + rect.height / 2;
    const distance = (sectionCenter - viewportCenter) / window.innerHeight;
    const direction = section.dataset.direction === "right" ? 1 : -1;
    const x = clamp(distance * 220 * direction, -180, 180);
    const fade = clamp(1 - Math.abs(distance) * 0.34, 0.68, 1);
    const scale = clamp(1 - Math.abs(distance) * 0.05, 0.96, 1);

    panel.style.setProperty("--x", `${x.toFixed(2)}px`);
    panel.style.setProperty("--fade", fade.toFixed(2));
    panel.style.setProperty("--scale", scale.toFixed(3));
  });
};

let ticking = false;

const requestSideMotionUpdate = () => {
  if (ticking) return;

  ticking = true;
  window.requestAnimationFrame(() => {
    updateSideMotion();
    ticking = false;
  });
};

window.addEventListener("scroll", requestSideMotionUpdate, { passive: true });
window.addEventListener("resize", requestSideMotionUpdate);
updateSideMotion();
