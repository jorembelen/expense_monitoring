
       <script>
        window.addEventListener('show-form', function (event) {
            $('#addEmployee').modal('show');
        });

        window.addEventListener('show-user-form', function (event) {
            $('#addUser').modal('show');
        });

        window.addEventListener('show-wallet-form', function (event) {
            $('#addWallet').modal('show');
        });

        window.addEventListener('show-edit-form', function (event) {
            $('#editEmployee').modal('show');
        });

        window.addEventListener('show-edit-user-form', function (event) {
            $('#EditUser').modal('show');
        });

        window.addEventListener('show-ca-form', function (event) {
            $('#addCa').modal('show');
        });

        window.addEventListener('show-job-form', function (event) {
            $('#addJob').modal('show');
        });

        window.addEventListener('show-delete-form', function (event) {
            $('#deleteEmployee').modal('show');
        });
        window.addEventListener('hide-delete-form', function (event) {
            $('#deleteEmployee').modal('hide');
        });
        window.addEventListener('hide-form', function (event) {
            $('#addEmployee').modal('hide');
            $('#editEmployee').modal('hide');
            $('#deleteEmployee').modal('hide');
            $('#addCode').modal('hide');
            $('#editCode').modal('hide');
            $('#deleteCode').modal('hide');
            $('#addUser').modal('hide');
            $('#EditUser').modal('hide');
            $('#addWallet').modal('hide');
            $('#addCa').modal('hide');
            $('#addJob').modal('hide');
        });

        window.addEventListener('show-addCode-form', function (event) {
            $('#addCode').modal('show');
        });
        window.addEventListener('show-editCode-form', function (event) {
            $('#editCode').modal('show');
        });
        window.addEventListener('show-deleteCode-form', function (event) {
            $('#deleteCode').modal('show');
        });
    </script>

