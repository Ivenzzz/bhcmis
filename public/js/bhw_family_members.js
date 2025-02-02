toggleDeceasedDateInput();
handleFamilyMemberDeletion();

function toggleDeceasedDateInput() {
    // JavaScript to toggle visibility of deceased date input based on the checkbox
    document.getElementById('isDeceased').addEventListener('change', function() {
        var deceasedDateDiv = document.getElementById('deceased_date_div');
        if (this.checked) {
            deceasedDateDiv.style.display = 'block';
        } else {
            deceasedDateDiv.style.display = 'none';
        }
    });
}

function handleFamilyMemberDeletion() {
    // Add event listener to delete buttons
    document.querySelectorAll('.delete-member-btn').forEach(button => {
        button.addEventListener('click', function () {
            const fmemberId = this.getAttribute('data-id');

            // Show SweetAlert confirmation modal
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this family member?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: ' #3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send fetch request to archive the family member
                    fetch('../controllers/bhw_delete_family_member.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ fmember_id: fmemberId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Archived!',
                                    'The family member has been archived.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload the page to reflect changes
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an error archiving the family member.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        });
                }
            });
        });
    });
}