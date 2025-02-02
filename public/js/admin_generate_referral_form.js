toggleOthersInput();

function toggleOthersInput() {
    document.addEventListener("DOMContentLoaded", function () {
        const otherRadio = document.getElementById("purpose6");
        const otherInput = document.getElementById("purpose_others");

        function toggleOtherInput() {
            if (otherRadio.checked) {
                otherInput.classList.remove("d-none");
                otherInput.required = true;
            } else {
                otherInput.classList.add("d-none");
                otherInput.required = false;
                otherInput.value = "";
            }
        }

        document.querySelectorAll("input[name='purpose']").forEach(radio => {
            radio.addEventListener("change", toggleOtherInput);
        });

        toggleOtherInput(); // Initialize on page load
    });
}