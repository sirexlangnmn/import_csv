<body>
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <a href="index.html">
                        <span><img src="<?= base_url() ?>assets/worky/logo/worky.png" alt="Worky Logo" height="auto"></span>
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <h2 class="text-center">Upload CSV File</h2>
                            <p class="text-center font-weight-bold mb-3"></p>
                            <form action="javascript:void(0);" method="POST" id="input_csv_form" name="input_csv_form" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="form-group mb-2">
                                    <label>Upload CSV File <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="input_csv" name="input_csv">
                                    <ul class="parsley-errors-list filled" id="input_csv_alert"></ul>
                                </div>
                                <div class="form-group mb-3 text-center">
                                    <button class="btn btn-worky btn-block" type="submit" id="btnSubmit" onclick="" >Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="<?= base_url('assets/javascript/input_csv_form.js'); ?>"></script>



