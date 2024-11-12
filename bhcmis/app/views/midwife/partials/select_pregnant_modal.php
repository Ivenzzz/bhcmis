<div class="modal fade" id="residentModal" tabindex="-1" aria-labelledby="residentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="residentModalLabel">Select Current Pregnant Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchResident" class="form-control mb-3" placeholder="Search...">
                <ul class="list-group" id="residentList">
                    <?php foreach ($pregnantResidents as $resident): ?>
                        <li class="list-group-item resident-item" data-id="<?= $resident['pregnancy_id'] ?>">
                            <?= htmlspecialchars($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>