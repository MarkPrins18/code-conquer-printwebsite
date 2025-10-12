contactForm.addEventListener("submit", function (e) {
  e.preventDefault();

  // Array met alle formulier velden
  const velden = [
    { id: "naam", label: "Naam" },
    { id: "email", label: "Email" },
    { id: "onderwerp", label: "Onderwerp" },
    { id: "bericht", label: "Bericht" },
  ];

  // For-loop om alle velden te verwerken
  let formulierData = {};

  for (let i = 0; i < velden.length; i++) {
    const veld = velden[i];
    const waarde = document.getElementById(veld.id).value;
    formulierData[veld.label] = waarde;
  }

  // Toon succes bericht met for-loop
  let bericht = "Bedankt voor uw bericht!\n\nU heeft ingevuld:\n";

  for (let i = 0; i < velden.length; i++) {
    const veld = velden[i];
    bericht += `${veld.label}: ${formulierData[veld.label]}\n`;
  }

  alert(bericht);

  // Reset formulier met for-loop
  for (let i = 0; i < velden.length; i++) {
    document.getElementById(velden[i].id).value = "";
  }
});
