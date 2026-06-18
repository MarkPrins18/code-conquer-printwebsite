//   Add password visibility toggle functionality on every password field.
//   Works automatically on all <input type="password"> elements
//   that are inside a .password-wrapper.

//  Requires Font Awesome (already loaded via the existing CDN link in the views).

document.addEventListener("DOMContentLoaded", () => {
  // Find all password fields that are inside a .password-wrapper
  const wrappers = document.querySelectorAll(".password-wrapper");

  wrappers.forEach((wrapper) => {
    const input = wrapper.querySelector('input[type="password"]');
    if (!input) return;

    // Make the toggle button
    const btn = document.createElement("button");
    btn.type = "button"; // prevents form-submit on click
    btn.className = "password-toggle";
    btn.setAttribute("aria-label", "Wachtwoord tonen of verbergen");

    // Eye icon — default closed (password hidden)
    const icon = document.createElement("i");
    icon.className = "fa-solid fa-eye-slash";
    btn.appendChild(icon);

    // Add the button to the wrapper
    wrapper.appendChild(btn);

    // Click: toggle between show and hide
    btn.addEventListener("click", () => {
      const zichtbaar = input.type === "text";

      input.type = zichtbaar ? "password" : "text";
      icon.className = zichtbaar ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";

      btn.setAttribute(
        "aria-label",
        zichtbaar ? "Wachtwoord tonen of verbergen" : "Wachtwoord verbergen",
      );

      // Put focus back on the input field,
      //  so the user can continue typing after clicking the eye icon
      input.focus();
    });
  });
});
