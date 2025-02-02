<div class="col-md-6 mx-auto mb-4 shadow p-3">
    <div class="card text-center shadow bg-pink-100 position-relative member-card">
        <div class="card-body">
            <h5 class="card-title text-pink-500">Wife</h5>
            <div class="card-text">
                <p class="poppins-medium"><?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></p>
                <p>Age: <?php echo htmlspecialchars($wife['age']);?></p>
                <p>Occupation: <span class="text-muted"><?php echo htmlspecialchars($wife['occupation'] ?? 'None'); ?></span></p>
            </div>
        </div>
        <div class="card-actions position-absolute d-none">
            <button class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#updateWifeModal">Update</button>
            <button class="btn btn-sm btn-danger mb-2 delete-member-btn" data-id="<?php echo htmlspecialchars($wife['fmember_id']); ?>">Delete</button>
            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#wifeInfoModal">View Info</button>
        </div>
    </div>
</div>