<?php 
// Sample Template Download
if (!empty($_GET['file'])) {
	$filename = basename($_GET['file']);
	$filepath = 'public/templates/' . $filename;
	if (!empty($filename) && file_exists($filepath)) {
		// Define headers
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');  //header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=".$filename);
		header('Content-Type: application/octet-stream');   //header("Content-Type: application/zip");
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
		ob_clean();
        flush();
		
		readfile($filepath);
		exit;
	}
	else {
		echo "This file does not exist.";
	}
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="dashboard card my-2">

            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <h5>Please fill in the information below</h5>
                <div>
                    <div class="d-flex justify-content-between p-3" style="border:solid 1px #E9ECED;background:#FAFAF7;border-radius:5px">
                        <div class="pr-2">
                            <p style="font-size:14px">The first line in downloaded csv file should remain as it is. Please do not change the order 
                            of the columns. The correct column order is (<b>Product Code, Product Name, Purchase Price,
                            Product Tax, Product Price, Category Code</b>) & you must follow this. If you are using any other 
                            language than English, please make sure that the csv file is UTF-8 encoded and not saved with 
                            byte-order mark (BOM).</p>
                        </div>
                        <div>
                            <a href="./main.php?dir=products&page=import_products&file=products_sample.csv" class="btn btn-info btn-sm p-2 float-right" style="width:180px">Download Sample File</a>
                        </div>
                    </div>            
                </div>

                <form id="upload_csv_products_form" method="post" enctype="multipart/form-data">
                    <div class="form-group my-4">
                        <label for="">Upload File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="product_csv" name="product_csv" onchange="fileSelectAction(this)" accept="text/csv">
                            <label class="custom-file-label" for="product_csv">Choose file</label>
                        </div>
                        <p style="font-size:14px">Please select .csv file (allowed file size 200KB)</p>
                    </div>

                    <button type="submit" class="btn btn-info btn-flat px-4 py-2">
                        Upload
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="row" id="csv_products_import" style="display:none">
    <div class="col-md-12">
        <div class="card my-2">
        
            <div class="card-body">

                <div id="csv_products_file_data"></div>

            </div>
        </div>
    </div>
</div>

<script>

function fileSelectAction(input) {
    if (input.files && input.files[0]) {
		$('label[for = product_csv]').text( input.files[0].name );
	}
    else {
        $('label[for = product_csv]').text( 'Choose file' );
    }
}

$(document).ready(function() {

    // $('#upload_csv_products_form').on('submit', function(event) {
    $('#upload_csv_products_form').submit(function(event) {
        event.preventDefault();
        var form_data = new FormData($(this)[0]);
        
        // validation if a file is selected can be done here (or in 'main_scripts.js')
        if ($('#product_csv').get(0).files.length === 0) {
            // console.log("No files selected.");
        }
        uploadProductsCsv(form_data);
    });

    $(document).on('click', '#import_data', function() {
        importProductCsv();
    });
});
</script>    