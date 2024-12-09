<div class="modal fade" id="addHouseholdModal" tabindex="-1" aria-labelledby="addHouseholdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addHouseholdModalLabel">Add Household for <?php echo $assigned_area['assigned_area_name']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addHouseholdForm" action="../controllers/bhw_add_household.php" method="POST">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <select id="address" name="address_id" class="form-select" required>
                            <option value="" selected>Select Address</option>
                            <?php foreach ($addresses as $address): ?>
                                <option value="<?= htmlspecialchars($address['address_id']) ?>"
                                    <?php if ($address['address_id'] == $assigned_area['assigned_area_id']) echo 'selected'; ?>>
                                    <?= htmlspecialchars($address['address_name']) ?> (<?= htmlspecialchars($address['address_type']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="year_resided" class="form-label">Year Resided</label>
                        <input type="number" id="year_resided" name="year_resided" class="form-control" min="1900" max="<?= date('Y') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="housing_type" class="form-label">Housing Type</label>
                        <select id="housing_type" name="housing_type" class="form-select" required>
                            <option value="Owned">Owned</option>
                            <option value="Rented">Rented</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="construction_materials" class="form-label">Construction Materials</label>
                        <select id="construction_materials" name="construction_materials" class="form-select" required>
                            <option value="light">Light</option>
                            <option value="strong">Strong</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="lighting_facilities" class="form-label">Lighting Facilities</label>
                        <select id="lighting_facilities" name="lighting_facilities" class="form-select" required>
                            <option value="electricity">Electricity</option>
                            <option value="kerosene">Kerosene</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="water_source" class="form-label">Water Source</label>
                        <select id="water_source" name="water_source" class="form-select" required>
                            <option value="Point Source">Point Source</option>
                            <option value="Communal Faucet">Communal Faucet</option>
                            <option value="Individual Connection">Individual Connection</option>
                            <option value="OTHERS">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="toilet_facility" class="form-label">Toilet Facility</label>
                        <select id="toilet_facility" name="toilet_facility" class="form-select" required>
                            <option value="Pointflush type">Pointflush type</option>
                            <option value="Ventilated Pit">Ventilated Pit</option>
                            <option value="Overhung Latrine">Overhung Latrine</option>
                            <option value="Without toilet">Without toilet</option>
                        </select>
                    </div>

                    <input type="hidden" name="recorded_by" value="<?= $current_bhw_id ?>">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Household</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>