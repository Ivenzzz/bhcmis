<div class="modal fade" id="updateFamilyModal<?php echo htmlspecialchars($family['family_id']); ?>" tabindex="-1" aria-labelledby="updateFamilyModalLabel<?php echo htmlspecialchars($family['family_id']); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controllers/bhw_update_family.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFamilyModalLabel<?php echo htmlspecialchars($family['family_id']); ?>">Update 4Ps Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="family_id" value="<?php echo htmlspecialchars($family['family_id']); ?>">
                    <input type="hidden" name="household_id" value="<?php echo htmlspecialchars($household_id); ?>">

                    <!-- 4Ps Status Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="4PsMember" id="4PsMember_<?php echo htmlspecialchars($family['family_id']); ?>" value="1" <?php echo $family['4PsMember'] == 1 ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="4PsMember_<?php echo htmlspecialchars($family['family_id']); ?>">4Ps Member</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
