(function () {
  "use strict";

  function initializeBuilder(builder) {
    const list = builder.querySelector("[data-alify-fields]");
    const template = builder.querySelector("[data-alify-field-template]");
    const addButton = builder.querySelector("[data-alify-add-field]");
    const limitNotice = builder.querySelector("[data-alify-limit]");
    if (!list || !template || !addButton) return;

    const updateLimit = () => {
      const atLimit = list.querySelectorAll("[data-alify-field]").length >= 40;
      addButton.disabled = atLimit;
      if (limitNotice) limitNotice.hidden = !atLimit;
    };

    const renumber = () => {
      [...list.querySelectorAll("[data-alify-field]")].forEach((card, index, cards) => {
        card.querySelectorAll("[name]").forEach((input) => {
          input.name = input.name.replace(/alify_form_fields\[[^\]]+\]/, `alify_form_fields[${index}]`);
        });
        const up = card.querySelector("[data-alify-move-up]");
        const down = card.querySelector("[data-alify-move-down]");
        if (up) up.disabled = index === 0;
        if (down) down.disabled = index === cards.length - 1;
      });
    };

    const updateCard = (card) => {
      const type = card.querySelector("[data-alify-type]");
      const title = card.querySelector("[data-alify-field-title]");
      const label = card.querySelector("[data-alify-label]");
      const choices = card.querySelector("[data-alify-choices]");
      const options = card.querySelector("[data-alify-options]");
      const usesChoices = type && ["select", "radio", "checkbox"].includes(type.value);
      if (choices) choices.hidden = !usesChoices;
      if (options) options.required = Boolean(usesChoices);
      if (title) title.textContent = label && label.value.trim() ? label.value.trim() : "New field";
    };

    list.addEventListener("input", (event) => {
      const card = event.target.closest("[data-alify-field]");
      if (card && event.target.matches("[data-alify-label]")) updateCard(card);
    });
    list.addEventListener("change", (event) => {
      const card = event.target.closest("[data-alify-field]");
      if (card && event.target.matches("[data-alify-type]")) updateCard(card);
    });
    list.addEventListener("click", (event) => {
      const card = event.target.closest("[data-alify-field]");
      if (!card) return;
      if (event.target.closest("[data-alify-remove-field]")) {
        card.remove();
        renumber();
        updateLimit();
      } else if (event.target.closest("[data-alify-move-up]") && card.previousElementSibling) {
        list.insertBefore(card, card.previousElementSibling);
        renumber();
      } else if (event.target.closest("[data-alify-move-down]") && card.nextElementSibling) {
        list.insertBefore(card.nextElementSibling, card);
        renumber();
      }
    });
    addButton.addEventListener("click", () => {
      const index = list.querySelectorAll("[data-alify-field]").length;
      if (index >= 40) {
        updateLimit();
        return;
      }
      const markup = template.innerHTML.replace(/__INDEX__/g, String(index));
      const wrapper = document.createElement("div");
      wrapper.innerHTML = markup.trim();
      const card = wrapper.firstElementChild;
      if (!card) return;
      list.append(card);
      updateCard(card);
      renumber();
      const label = card.querySelector("[data-alify-label]");
      if (label) label.focus();
      updateLimit();
    });

    list.querySelectorAll("[data-alify-field]").forEach(updateCard);
    renumber();
    updateLimit();

    const editForm = builder.closest("form#post");
    if (editForm) {
      editForm.addEventListener("submit", (event) => {
        const seen = new Set();
        let invalid = null;
        list.querySelectorAll("[data-alify-name]").forEach((input) => {
          input.setCustomValidity("");
          const name = input.value.trim().toLowerCase();
          if (name && seen.has(name)) {
            input.setCustomValidity("Each field name must be unique.");
            invalid = invalid || input;
          }
          if (name) seen.add(name);
        });
        if (invalid) {
          event.preventDefault();
          invalid.reportValidity();
        }
      });
    }
  }

  document.querySelectorAll("[data-alify-form-builder]").forEach(initializeBuilder);
})();
