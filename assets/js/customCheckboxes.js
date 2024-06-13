const customCheckboxes = document.querySelectorAll(".customCheckBox");

customCheckboxes.forEach(checkbox => {
    const target = checkbox.dataset.target;
    const targetElement = document.getElementById(target);

    checkbox.addEventListener("click", (el) => {
        targetElement.checked = !targetElement.checked;

        if(targetElement.checked) checkbox.classList.add("checked");
        else checkbox.classList.remove("checked");
    });

    targetElement.addEventListener("click", () => {
        if(targetElement.checked) checkbox.classList.add("checked");
        else checkbox.classList.remove("checked");
    });

    if(targetElement.checked) checkbox.classList.add("checked");
    else checkbox.classList.remove("checked");
});