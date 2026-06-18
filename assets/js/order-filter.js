function initOrderFilter({
  statusSelectId,
  searchInputId = null,
  resetBtnId,
  statusColumnKey = "status",
  searchColumnKey = null,
}) {
  const table = document.querySelector("table");
  if (!table) return;

  const rows = Array.from(table.querySelectorAll("tbody tr"));
  const headers = Array.from(table.querySelectorAll("thead th"));
  const statusSelect = document.getElementById(statusSelectId);
  const searchInput = searchInputId
    ? document.getElementById(searchInputId)
    : null;
  const resetBtn = document.getElementById(resetBtnId);

  const statusCol = headers.findIndex(
    (th) => th.dataset.key === statusColumnKey,
  );
  const searchCol = searchColumnKey
    ? headers.findIndex((th) => th.dataset.key === searchColumnKey)
    : -1;

  const seen = new Set();
  rows.forEach((row) => {
    const val = row.cells[statusCol]?.textContent.trim();
    if (val) seen.add(val);
  });
  [...seen].sort().forEach((status) => {
    const opt = document.createElement("option");
    opt.value = opt.textContent = status;
    statusSelect.appendChild(opt);
  });

  function filter() {
    const term = searchInput?.value.trim().toLowerCase() ?? "";
    const status = statusSelect.value;

    rows.forEach((row) => {
      const matchStatus =
        !status || row.cells[statusCol]?.textContent.trim() === status;
      const matchSearch =
        !term ||
        row.cells[searchCol]?.textContent.trim().toLowerCase().includes(term);
      row.style.display = matchStatus && matchSearch ? "" : "none";
    });
  }

  searchInput?.addEventListener("input", filter);
  statusSelect.addEventListener("change", filter);
  resetBtn.addEventListener("click", () => {
    if (searchInput) searchInput.value = "";
    statusSelect.value = "";
    rows.forEach((row) => (row.style.display = ""));
  });
}
