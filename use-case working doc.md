FR: Als een gebruiker op de product-pagina een zoekslag uitvoert met nul resultaten, dan wordt de zoekstring en timestamp opgeslagen in de database.

Happy path

Het systeem registreert dat er geen resultaten uit de zoekslag komen.
Het systeem verifieert en valideert de zoekslag op ‘malicious code’.
Het systeem slaat de zoekslag op.
Het systeem slaat de timestamp op.
Het systeem stuurt de data naar de failed_search_logs tabel in de database.
Het systeem verifieert of de data succesvol is verzonden.
Unhappy path

Het systeem kan geen verbinding maken met de database.
Het systeem toont een error melding.