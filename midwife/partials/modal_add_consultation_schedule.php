<!-- Modal for adding consultation -->
<div class="modal fade" id="addConsultationModal" tabindex="-1" aria-labelledby="addConsultationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addConsultationModalLabel">Add New Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="consultationForm">
                    <div class="mb-3">
                        <label for="consultationDate" class="form-label">Consultation Date</label>
                        <input type="datetime-local" class="form-control" id="consultationDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="consultationDetails" class="form-label">Details</label>
                        <textarea class="form-control" id="consultationDetails" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Consultation</button>
                </form>
            </div>
        </div>
    </div>
</div>