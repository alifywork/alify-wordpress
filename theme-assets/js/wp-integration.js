"use strict";

/** Replace static-site paths with the active theme asset and WordPress URLs. */
window.alifyFixThemeMarkup = function (root) {
  const config = window.AlifyTheme || {};
  const assetsBase = String(config.assetsBase || "").replace(/\/$/, "");
  const homeUrl = String(config.homeUrl || "/").replace(/\/$/, "");

  const insertMenu = (selector, markup, className) => {
    if (!markup) return;
    const existing = root.querySelector(selector);
    if (!existing) return;
    const holder = document.createElement("div");
    holder.innerHTML = markup;
    const menu = holder.querySelector("ul");
    if (!menu) return;
    menu.className = className;
    menu.querySelectorAll("a").forEach((link) => link.classList.add("header__nav-link"));
    existing.replaceWith(menu);
  };
  insertMenu(".header__nav-list", config.primaryMenuHtml, "header__nav-list");
  insertMenu(".header__mobile-list", config.primaryMenuHtml, "header__mobile-list");

  if (config.footerMenuHtml) {
    const footerList = root.querySelector('.footer__column[aria-label="Footer navigation"] ul');
    if (footerList) {
      const holder = document.createElement("div");
      holder.innerHTML = config.footerMenuHtml;
      const menu = holder.querySelector("ul");
      if (menu) footerList.replaceWith(menu);
    }
  }

  root.querySelectorAll("[src^='assets/']").forEach((element) => {
    const source = element.getAttribute("src");
    element.setAttribute("src", `${assetsBase}/${source.slice("assets/".length)}`);
  });

  root.querySelectorAll("a[href]").forEach((link) => {
    const original = link.getAttribute("href");
    if (!original || !/\.html(?:[?#]|$)/i.test(original)) return;

    const match = original.match(/^([^?#]+\.html)([?#].*)?$/i);
    if (!match) return;
    const mapped = config.routes && config.routes[match[1]];
    const slug = match[1].split("/").pop().replace(/\.html$/i, "");
    const destination = mapped || `${homeUrl}/${slug}/`;
    link.setAttribute("href", `${destination}${match[2] || ""}`);
  });

  if (config.logoUrl) {
    root.querySelectorAll(".header__logo--light, .header__logo--sticky, .navigation-drawer__top img, .footer__logo img").forEach((logo) => {
      logo.setAttribute("src", config.logoUrl);
    });
  }

  if (config.headerCtaUrl) {
    root.querySelectorAll(".header__cta").forEach((link) => link.setAttribute("href", config.headerCtaUrl));
  }
  if (config.headerCtaLabel) {
    root.querySelectorAll(".header__cta").forEach((link) => {
      const icon = link.querySelector("i");
      link.textContent = `${config.headerCtaLabel} `;
      if (icon) link.append(icon);
    });
  }

  if (config.contactEmail) {
    root.querySelectorAll(".footer__brand-email").forEach((link) => {
      const icon = link.querySelector("i");
      link.href = `mailto:${config.contactEmail}`;
      link.textContent = `${config.contactEmail} `;
      if (icon) link.append(icon);
    });
  }
  if (config.footerCopyright) {
    root.querySelectorAll(".footer__bottom [data-current-year]").forEach((year) => {
      const parent = year.parentElement;
      const pieces = config.footerCopyright.split("%year%");
      parent.replaceChildren(
        document.createTextNode(pieces[0] || ""),
        year,
        document.createTextNode(pieces.slice(1).join("%year%"))
      );
    });
  }
};
