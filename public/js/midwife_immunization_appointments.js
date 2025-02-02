handleImmunizationComplete();

function handleImmunizationComplete() {
    document.addEventListener("DOMContentLoaded", function() {
        // Attach submit event listener to each form dynamically
        const forms = document.querySelectorAll('[id^="immunizationForm_"]');
    
        forms.forEach(function(form) {
            form.addEventListener("submit", async function (e) {
                e.preventDefault(); // Prevent default form submission
    
                const appointmentId = form.getAttribute('data-appointment-id');
                const formData = new FormData(form);
    
                try {
                    const response = await fetch("../controllers/midwife_immunization_mark_completed.php", {
                        method: "POST",
                        body: formData
                    });
    
                    const result = await response.json(); // Parse JSON response
    
                    if (result.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: result.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Close the modal
                            const modal = document.getElementById(`immunizationModal_${appointmentId}`);
                            if (modal) {
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();
                            }
    
                            // Reset the form
                            form.reset();
    
                            // Reload page to reflect changes
                            location.reload(); // Optional: Reload the page to refresh the data
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: result.message
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An error occurred. Please try again."
                    });
                }
            });
        });
    
        // Optional: Open the correct modal based on the data-appointment-id attribute
        const modalButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        modalButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                const appointmentId = button.getAttribute("data-appointment-id");
                const modal = document.getElementById(`immunizationModal_${appointmentId}`);
                if (modal) {
                    const modalInstance = new bootstrap.Modal(modal);
                    modalInstance.show();
                }
            });
        });
    });
    
}