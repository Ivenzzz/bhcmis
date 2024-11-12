export async function confirmDelete(bhwId) {
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: 'You won’t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    });

    if (result.isConfirmed) {
        // Call the delete function
        deleteBHW(bhwId);
    }
}

export async function deleteBHW(bhwId) {
    try {
        const response = await fetch('./app/controllers/admin-bhw/delete_bhw.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ bhw_id: bhwId }),
        });

        if (response.ok) {
            const data = await response.json();
            if (data.success) {
                // Remove the card from the DOM
                document.querySelector(`#bhw-card-${bhwId}`).remove();
                Swal.fire('Deleted!', 'The BHW has been deleted.', 'success');
            } else {
                Swal.fire('Error!', data.message, 'error');
            }
        } else {
            Swal.fire('Error!', 'Failed to delete the BHW.', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire('Error!', 'An unexpected error occurred.', 'error');
    }
}