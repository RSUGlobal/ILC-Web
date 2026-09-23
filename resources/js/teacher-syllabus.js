const form = document.getElementById("syllabus-form");

if (form) {
    let dirty = false;
    const status = form.querySelector("[data-save-status]");
    const markDirty = () => {
        dirty = true;
        status.textContent = "You have unsaved changes.";
    };
    const updateTotal = () => {
        const total = [...form.querySelectorAll("[data-weight]")].reduce(
            (sum, input) => sum + (Number(input.value) || 0),
            0,
        );
        form.querySelector("[data-assessment-total]").textContent =
            form.querySelectorAll("[data-weight]").length
                ? `Total: ${Number(total.toFixed(2))}% — must equal 100%.`
                : "If you add assessments, weights must add up to 100%.";
    };
    form.addEventListener("input", () => {
        markDirty();
        updateTotal();
    });
    form.addEventListener("change", markDirty);
    form.addEventListener("submit", () => {
        dirty = false;
    });
    window.addEventListener("beforeunload", (event) => {
        if (dirty) {
            event.preventDefault();
            event.returnValue = "";
        }
    });

    form.querySelectorAll("[data-repeater]").forEach((repeater) => {
        const rows = repeater.querySelector("[data-rows]");
        const add = repeater.querySelector("[data-add-row]");
        const indices = [...rows.querySelectorAll("[name]")].map((input) =>
            Number(input.name.match(/\[(\d+)\]/)?.[1] ?? 0),
        );
        let index = Math.max(-1, ...indices) + 1;
        const refreshControls = () => {
            rows.querySelectorAll("[data-remove-row]").forEach((button) => {
                button.disabled = false;
            });
        };
        add.addEventListener("click", () => {
            if (add.disabled) return;
            const template = repeater
                .querySelector("[data-template]")
                .innerHTML.replaceAll("__INDEX__", String(index++));
            const nextWeek =
                Math.max(
                    0,
                    ...[...rows.querySelectorAll("[data-week]")].map(
                        (input) => Number(input.value) || 0,
                    ),
                ) + 1;
            rows.insertAdjacentHTML("beforeend", template);
            const row = rows.lastElementChild;
            const week = row.querySelector("[data-week]");
            if (week) week.value = nextWeek;
            row.querySelector("input")?.focus();
            markDirty();
            refreshControls();
            updateTotal();
        });
        rows.addEventListener("click", (event) => {
            const button = event.target.closest("[data-remove-row]");
            if (!button) return;
            button.closest("[data-row]").remove();
            markDirty();
            refreshControls();
            updateTotal();
        });
        refreshControls();
    });
    updateTotal();
}

document.querySelectorAll("[data-pdf-upload]").forEach((uploadForm) => {
    const file = uploadForm.querySelector('input[type="file"]');
    file.addEventListener("change", () => {
        file.setCustomValidity(
            file.files[0]?.size > 10 * 1024 * 1024
                ? "Please choose a PDF smaller than 10 MB."
                : "",
        );
    });
    uploadForm.addEventListener("submit", () => {
        const button = uploadForm.querySelector('button[type="submit"]');
        button.disabled = true;
        button.textContent = file.files.length ? "Uploading…" : "Saving…";
    });
});
