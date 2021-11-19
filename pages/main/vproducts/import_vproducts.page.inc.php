<?php 
if (!empty($_GET['file'])) { // Sample Template Download
	$filename = basename($_GET['file']);
	$filepath = 'public/templates/' . $filename;
	if (!empty($filename) && file_exists($filepath)) {
		// Define headers
        header("Cache-Control: public");    // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');  
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=".$filename);
		// header('Content-Type: application/octet-stream');   
        header("Content-Type: application/zip");
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

            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <h3 class="my-0">Import Vendor Products</h3>
                </div>
            </div>

            <div class="card-body">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <h5>Please fill in the information below</h5>
                <div>
                    <div class="d-flex justify-content-between p-3" style="border:solid 1px #E9ECED;background:#FAFAF7;border-radius:5px">
                        <div class="pr-2">
                            <p style="font-size:14px">The first line in downloaded csv file should remain as it is. Please do not change the order 
                            of the columns. The correct column order for the mandatory items is (<b>Brand, Category, Product Name/Description, 
                            Product Feature, Product Unit, Lot, Quantity per Lot, Offer Price</b>) & you must follow this. Text formatting
                            must be in UTF-8.</p>
                        </div>
                        <div>
                            <a href="./main.php?dir=products&page=import_products&file=vproducts_sample.csv" class="btn btn-info btn-sm p-2 float-right" style="width:180px">Download Sample File</a>
                        </div>
                    </div>            
                </div>

                <form id="upload_csv_vproducts_form" method="post" enctype="multipart/form-data">

                    <div class="form-row my-4">
                        <input type="hidden" name="domainid" id="domainid">
                        <div class="col">
                            <label for="">Vendor</label>
                            <select name="vendorid" id="vendorid" class="custom-select custom-select-sm">
                                <!-- <option>Select Vendor</option> -->
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Sub-Unit</label>
                            <select name="subdomid" id="subdomid" class="custom-select custom-select-sm">
                                <!-- <option>Select Subdomain</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group my-4">
                        <label for="">Upload File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="vproduct_csv" name="vproduct_csv" onchange="fileSelectAction(this)" accept="text/csv">
                            <label class="custom-file-label" for="vproduct_csv">Choose file</label>
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

<div class="row" id="csv_vproducts_import" style="display:none">
    <div class="col-md-12">
        <div class="card my-2">
        
            <div class="card-body">

                <div id="csv_vproducts_file_data"></div>

            </div>
        </div>
    </div>
</div>

<script>

function fileSelectAction(input) {
    if (input.files && input.files[0]) {
		$('label[for = vproduct_csv]').text( input.files[0].name );
	}
    else {
        $('label[for = vproduct_csv]').text( 'Choose file' );
    }
}

$(document).ready(function() {

    $('.page-title').addClass('d-none');

    initializeVendorProductsSelect();


    $('#vendorid').on('change', function() {
        // alert( this.value );
        vendorChangeUpdateSubDomSelect( this.value );
    });

    $('#subdomid').on('change', function() {
        //alert( this.value );
        subdomChangeUpdateSubDomSelect( this.value );
    });

    $('#upload_csv_vproducts_form').submit(function(event) {
        event.preventDefault();
        var form_data = new FormData($(this)[0]);
        
        // validation if a file is selected can be done here (or in 'main_scripts.js')
        if ($('#vproduct_csv').get(0).files.length === 0) {
            // console.log("No files selected.");
        }

        uploadVProductsCsv(form_data);
    });

    $(document).on('click', '#import_data', function() {
        importVProductCsv();
    });
});
</script>    