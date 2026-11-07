"use strict";

/** Replace static-site paths with the active theme asset and WordPress URLs. */
window.alifyFixThemeMarkup = function (root) {
  const config = window.AlifyTheme || {};
  const assetsBase = String(config.assetsBase || "").replace(/\/$/, "");
  const homeUrl = String(config.homeUrl || "/").replace(/\/$/, "");

  const insertMenu = (selector, markup, className, specialItems) => {
    if (!markup) return;
    const existing = root.querySelector(selector);
    if (!existing) return;
    const holder = document.createElement("div");
    holder.innerHTML = markup;
    const menu = holder.querySelector("ul");
    if (!menu) return;
    menu.className = className;
    menu.querySelectorAll("a").forEach((link) => link.classList.add("header__nav-link"));

    // Keep the theme's accessible mega menus while allowing WordPress to control
    // top-level navigation labels and destinations.
    (specialItems || []).forEach((special) => {
      const original = [...existing.querySelectorAll(special.selector)].find((item) => Boolean(item.querySelector('.header__mobile-resources-toggle')) === Boolean(special.isResources));
      if (!original) return;
      const wpItem = [...menu.children].find((item) => {
        const link = item.querySelector(":scope > a");
        if (!link) return false;
        const label = link.textContent.trim().toLowerCase();
        const url = link.getAttribute("href") || "";
        return special.matches(label, url);
      });
      const sourceLink = original.querySelector(special.linkSelector);
      if (wpItem) {
        const wpLink = wpItem.querySelector(":scope > a");
        if (sourceLink && wpLink) {
          sourceLink.href = wpLink.href;
          sourceLink.textContent = wpLink.textContent.trim();
          if (special.relatedLinkSelector) {
            const relatedLink = original.querySelector(special.relatedLinkSelector);
            if (relatedLink) relatedLink.href = wpLink.href;
          }
        }
        wpItem.replaceWith(original);
      } else {
        menu.append(original);
      }
    });
    existing.replaceWith(menu);
  };
  insertMenu(".header__nav-list", config.primaryMenuHtml, "header__nav-list", [
    { selector: ".header__mega-item:not(.header__resources-item)", linkSelector: ".header__mega-trigger > a", relatedLinkSelector: ".mega-menu__header > a", isResources: false, matches: (label, url) => /service/i.test(label) || /\/services(?:[/?#]|$)/i.test(url) },
    { selector: ".header__resources-item", linkSelector: ".header__mega-trigger > a", isResources: false, matches: (label) => /^(explore|resources)$/i.test(label) },
  ]);
  insertMenu(".header__mobile-list", config.primaryMenuHtml, "header__mobile-list", [
    { selector: ".header__mobile-mega", linkSelector: ".header__mobile-mega-trigger > a", isResources: false, matches: (label, url) => /service/i.test(label) || /\/services(?:[/?#]|$)/i.test(url) },
    { selector: ".header__mobile-mega", linkSelector: ".header__mobile-mega-trigger > a", isResources: true, matches: (label) => /^(explore|resources)$/i.test(label) },
  ]);

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

  root.querySelectorAll(".footer__brand-email[data-site-email]").forEach((link) => {
    if (!config.contactEmail) {
      link.remove();
      return;
    }
    const icon = link.querySelector("i");
    link.href = `mailto:${config.contactEmail}`;
    link.textContent = `${config.contactEmail} `;
    link.hidden = false;
    if (icon) link.append(icon);
  });
  if (config.contactPhone) {
    root.querySelectorAll(".footer__contact-card").forEach((card) => {
      const phone = document.createElement("a");
      phone.className = "footer__contact-page";
      phone.href = `tel:${config.contactPhone.replace(/[^+0-9]/g, "")}`;
      phone.textContent = config.contactPhone;
      card.append(phone);
    });
  }
  if (config.businessAddress) {
    root.querySelectorAll(".footer__contact-card").forEach((card) => {
      const address = document.createElement("p");
      address.className = "footer__business-address";
      address.textContent = config.businessAddress;
      card.append(address);
    });
  }

  if (Array.isArray(config.socialLinks) && config.socialLinks.length) {
    root.querySelectorAll(".footer__brand").forEach((brand) => {
      const nav = document.createElement("nav");
      nav.className = "footer__social-links";
      nav.setAttribute("aria-label", "Social media links");
      config.socialLinks.forEach((item) => {
        if (!item || !item.label || !item.url) return;
        let url;
        try { url = new URL(item.url, window.location.href); } catch (_) { return; }
        if (!["https:", "http:"].includes(url.protocol)) return;
        const link = document.createElement("a");
        link.href = url.href;
        link.target = "_blank";
        link.rel = "noopener noreferrer";
        link.setAttribute("aria-label", item.label);
        const network = document.createElement("span");
        network.className = "footer__social-name";
        network.textContent = item.label;
        const iconName = item.label.toLowerCase().replace(/[^a-z0-9-]+/g, "-").replace(/^-|-$/g, "");
        if (iconName) {
          const icon = document.createElement("i");
          icon.className = `fa-brands fa-${iconName}`;
          icon.setAttribute("aria-hidden", "true");
          link.append(icon);
        }
        link.append(network);
        nav.append(link);
      });
      if (nav.childElementCount) brand.append(nav);
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
