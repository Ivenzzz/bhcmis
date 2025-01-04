<div class="row mb-4 shadow">
    <div class="col-md-3 mb-3">
        <div class="card bg-orange-500 text-white shadow-sm p-2">
            <div class="card-body text-center">
                <h5 class="card-title wrap">Total Consultations</h5>
                <p class="card-text fs-4"><?php echo $total_consultations; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-sky-500 text-white shadow-sm p-2">
            <div class="card-body text-center">
                <h5 class="card-title">Today's Appointments</h5>
                <p class="card-text fs-4"><?php echo $total_todays_appointments; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-green-700 text-white shadow-sm p-2">
            <div class="card-body text-center">
                <h5 class="card-title">Completed Appointments</h5>
                <p class="card-text fs-4"><?php echo $total_completed_appointments; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-red-600 text-white shadow-sm p-2">
            <div class="card-body text-center">
                <h5 class="card-title">Cancelled Appointments</h5>
                <p class="card-text fs-4"><?php echo $total_cancelled_appointments; ?></p>
            </div>
        </div>
    </div>
</div>