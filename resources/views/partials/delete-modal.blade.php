{{-- Modal DELETE --}}
<div class="modal fade mt-5" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {{-- Heading --}}
            <div class="modal-header d-flex flex-column">
                {{-- Close pop-up --}}
                <div class="align-self-end">
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fa-lg" aria-hidden="true"></i>
                    </button>
                </div>
                {{-- Title modal --}}
                <i class="fa-solid fa-trash-can text-danger fa-lg my-3"></i>
                <h4 class="modal-title" id="deleteModalLabel">
                    Delete your apartment
                </h4>
            </div>

            {{-- Question --}}
            <div class="modal-body text-center py-5">
                <p class="text-center">
                    Are you sure you want to delete the apartment
                    <span id="modal-apartment-title" class="fw-bolder"></span> ?
                </p>
                <span class="fst-italic"> This action cannot be undone.</span>
            </div>

            {{-- Answers --}}
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No, keep it</button>
                <button type="button" class="btn btn-danger" id="delete">Yes, I want to cancel</button>
            </div>

        </div>
    </div>
</div>
