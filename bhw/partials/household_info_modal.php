<div class="modal fade" id="infoHouseholdModal<?php echo htmlspecialchars($household['household_id']); ?>" tabindex="-1" aria-labelledby="infoHouseholdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="infoHouseholdModalLabel">Household Information</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="d-inline"><strong>Household No.:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['household_id']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Address:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($assigned_area['assigned_area_name']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Year Resided:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['year_resided']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Housing Type:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['housing_type']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Construction Materials:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['construction_materials']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Lighting Facilities:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['lighting_facilities']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Water Source:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['water_source']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Toilet Facility:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['toilet_facility']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Created At:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['created_at']) ?></p>
                </div>

                <div class="mb-3">
                    <p class="d-inline"><strong>Updated At:</strong></p>
                    <p class="d-inline ms-2"><?= htmlspecialchars($household['updated_at']) ?></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
