
<div class="modal fade" id="updateHouseholdModal<?php echo htmlspecialchars($household['household_id']); ?>" tabindex="-1" aria-labelledby="updateHouseholdModalLabel<?php echo htmlspecialchars($household['household_id']); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controllers/admin_update_household.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateHouseholdModalLabel<?php echo htmlspecialchars($household['household_id']); ?>">Update Household</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="household_id" value="<?php echo htmlspecialchars($household['household_id']); ?>">

                    <div class="mb-3">
                        <label for="address_<?php echo htmlspecialchars($household['household_id']); ?>" class="form-label">Address</label>
                        <select class="form-select" name="address_id" id="address_<?php echo htmlspecialchars($household['household_id']); ?>" required>
                            <?php foreach ($addresses as $address): ?>
                                <option value="<?php echo htmlspecialchars($address['address_id']); ?>" <?php echo $household['address_id'] == $address['address_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($address['address_name'] . ' (' . ucfirst($address['address_type']) . ')'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="year_resided_<?php echo htmlspecialchars($household['household_id']); ?>" class="form-label">Year Resided</label>
                        <input type="number" class="form-control" name="year_resided" id="year_resided_<?php echo htmlspecialchars($household['household_id']); ?>" value="<?php echo htmlspecialchars($household['year_resided']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="housing_type_<?php echo htmlspecialchars($household['household_id']); ?>" class="form-label">Housing Type</label>
                        <select class="form-select" name="housing_type" id="housing_type_<?php echo htmlspecialchars($household['household_id']); ?>" required>
                            <option value="Owned" <?php echo $household['housing_type'] === 'Owned' ? 'selected' : ''; ?>>Owned</option>
                            <option value="Rented" <?php echo $household['housing_type'] === 'Rented' ? 'selected' : ''; ?>>Rented</option>
                            <option value="Other" <?php echo $household['housing_type'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="water_source_<?php echo htmlspecialchars($household['household_id']); ?>" class="form-label">Water Source</label>
                        <select class="form-select" name="water_source" id="water_source_<?php echo htmlspecialchars($household['household_id']); ?>" required>
                            <option value="Point Source" <?php echo $household['water_source'] === 'Point Source' ? 'selected' : ''; ?>>Point Source</option>
                            <option value="Communal Faucet" <?php echo $household['water_source'] === 'Communal Faucet' ? 'selected' : ''; ?>>Communal Faucet</option>
                            <option value="Individual Connection" <?php echo $household['water_source'] === 'Individual Connection' ? 'selected' : ''; ?>>Individual Connection</option>
                            <option value="OTHERS" <?php echo $household['water_source'] === 'OTHERS' ? 'selected' : ''; ?>>OTHERS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="toilet_facility_<?php echo htmlspecialchars($household['household_id']); ?>" class="form-label">Toilet Facility</label>
                        <select class="form-select" name="toilet_facility" id="toilet_facility_<?php echo htmlspecialchars($household['household_id']); ?>" required>
                            <option value="Pointflush type" <?php echo $household['toilet_facility'] === 'Pointflush type' ? 'selected' : ''; ?>>Pointflush type</option>
                            <option value="Ventilated Pit" <?php echo $household['toilet_facility'] === 'Ventilated Pit' ? 'selected' : ''; ?>>Ventilated Pit</option>
                            <option value="Overhung Latrine" <?php echo $household['toilet_facility'] === 'Overhung Latrine' ? 'selected' : ''; ?>>Overhung Latrine</option>
                            <option value="Without toilet" <?php echo $household['toilet_facility'] === 'Without toilet' ? 'selected' : ''; ?>>Without toilet</option>
                        </select>
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
