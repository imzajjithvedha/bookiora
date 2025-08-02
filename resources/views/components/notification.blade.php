<div class="modal fade notification-modal" id="success-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <i class="bi bi-check-circle-fill tick-icon"></i>
                <p class="title raleway">{{ session('success') }}</p>
                <p class="description">{{ session('message') }}</p>

                <button type="button" class="btn close-button" data-bs-dismiss="modal" title="Close">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade notification-modal" id="error-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <i class="bi bi-x-circle-fill close-icon"></i>
                <p class="title raleway">{{ session('error') }}</p>
                <p class="description">{{ session('message') }}</p>

                <button type="button" class="btn close-button" data-bs-dismiss="modal" title="Close">Close</button>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    @if(session('success'))
        <script>
            $(document).ready(function() {
                $('#success-modal').modal('show');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            $(document).ready(function() {
                $('#error-modal').modal('show');
            });
        </script>
    @endif
@endpush