// document.addEventListener("DOMContentLoaded", function () {
const contactForm = document.getElementById("contact-form");

contactForm.addEventListener("submit", function (e) {
  e.preventDefault();

  // Korte for-loop voor alle velden
  const velden = ["naam", "email", "onderwerp", "bericht"];
  let bericht = "Bedankt voor uw bericht! U heeft ingevuld:\n";

  for (let i = 0; i < velden.length; i++) {
    const waarde = document.getElementById(velden[i]).value;
    bericht += `${velden[i]}: ${waarde}\n`;
    document.getElementById(velden[i]).value = ""; // Reset veld
  }

  alert(bericht);
});
// });
