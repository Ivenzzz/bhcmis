<div class="col-md-6 mx-auto mb-4 shadow p-3">
    <div class="card text-center shadow bg-sky-100 position-relative member-card">
        <div class="card-body">
            <h5 class="card-title text-primary">Head of Family</h5>
            <div class="card-text">
                <p class="poppins-medium"><?php echo htmlspecialchars($head['firstname'] . ' ' . $head['lastname']); ?></p>
                <p>Age: <?php echo htmlspecialchars($head['age']); ?></p>
                <p>Occupation: <span class="text-muted"><?php echo htmlspecialchars($head['occupation'] ?? 'None'); ?></span></p>
            </div>
        </div>
        <div class="card-actions position-absolute d-none">
            <button class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#updateHeadModal">Update</button>
            <button class="btn btn-sm btn-danger mb-2 delete-member-btn" data-id="<?php echo htmlspecialchars($head['fmember_id']); ?>">Delete</button>
            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#headInfoModal">View Info</button>
        </div>
    </div>
</div>