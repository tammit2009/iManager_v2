<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $product = fetchProductById($_GET['id']);
    foreach($product as $k => $v) {
        $$k = $v;  
        // echo "$$k : $v <br/>";
    }
} 
?>
<style>
    td {
        height: 30px;
        vertical-align: top;
    }
    td.field-key {
        width: 40%;
    }

    @media screen {
        body{
            height: calc(100%);
            width: calc(100%);
        }
    }

    .container-fluid {
        height: calc(100%);
    }
    
    div#display {
        display: flex;
        height: 100%;
        width: 100%;
        align-items: center;
    }

    @media print {
        div#display {
            display: flex;
            height: auto;
            width: 100%;
            align-items: center;
        }
    }

    #display #field, #display center {
        margin: auto;
    }

    #field img {
        height: 9vh;
        max-width: 100%
    }

    div#code {
        font-weight: 700;
        font-size: 17px;
        text-align: justify;
        text-align-last: justify;
    }

	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>


<div class="container-fluid">
	<!-- <div class="card"> -->
        <!-- <div class="card-body"> -->

            <table style="font-size:14px;width:100%;">
                <tr>
                    <td class="field-key">SKU:</td>
                    <td><b><span><?php echo $sku; ?></span></b></td>
                </tr> 
                <tr>
                    <td class="field-key">Brand Name:</td>
                    <td><b><span><?php echo $brand_id; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Category Name:</td>
                    <td><b><span><?php echo $category_id; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Product Name:</td>
                    <td><b><span><?php echo $product_name; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Product Short Descr:</td>
                    <td><b><span><?php echo $short_descr; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Product Long Descr:</td>
                    <td><b><span><?php echo $long_descr; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Features:</td>
                    <td><b><span><?php echo $features; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Attributes:</td>
                    <td><b><span><?php echo $attributes; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Unit:</td>
                    <td><b><span><?php echo $unit; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Lot:</td>
                    <td><b><span><?php echo $lot; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Per Lot:</td>
                    <td><b><span><?php echo $per_lot; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Unit Price:</td>
                    <td><b><span><?php echo $unit_price; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Created On:</td>
                    <td><b><span><?php echo $created_on; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Created By:</td>
                    <td><b><span><?php echo $created_by; ?></span></b></td>
                </tr>
                           
            </table>

            <div class=" card col-md-12 my-5" id='bcode-card'>
                <input type="hidden" name="the_barcode" id="the_barcode" value="<?php echo $barcode; ?>">
                <!-- 
                    Type Options:
                    Code 128    => "C128"
                    Code 128 A  => "C128A"
                    Code 128 B  => "C128B"
                    Code 39     => "C39"
                    Code 39 E   => "C39E"
                    Code 93     => "C93"
                    EAN 8       => "EAN8"
                    EAN 13      => "EAN13"
                 -->
                <input type="hidden" name="the_type" id="the_type" value="C128">
                <input type="hidden" name="the_label" id="the_label" value="<?php echo $product_name; ?>">
                <div class="card-body">
                    <div id="display">
                        <center>Barcode <?php echo $barcode; ?></center>
                    </div>
                </div>
                <div class="card-footer mb-3" style="display:none">
                    <center>
                        <button type="button" class=" btn-block btn btn-success btn-sm" id="print">Print</button>
                        <button type="button" class=" btn-block btn btn-primary btn-sm" id="save">Download</button>  
                    </center>
                </div>
            </div>

        <!-- </div> -->
	<!-- </div> -->

</div>
<div class="modal-footer display p-0 m-0">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script>

    displayBarcode();

    function displayBarcode() {
        if($('#the_barcode').val() != '') {
            $.ajax({
                url:`${baseUrlMain}/core/services/barcode.php`,
                method:"POST",
                data:{ 
                    code: $('#the_barcode').val(), 
                    type: $('#the_type').val(), 
                    label: $('#the_label').val()
                },
                error:err=>{
                    console.log(err)
                },
                success:function(resp){
                    $('#display').html(resp)
                    $('#bcode-card .card-footer').show('slideUp')
                }
            });
        }
    }

    $('#save').click(function(){
        html2canvas($('#field'), {
            onrendered: function(canvas) {                    
                var img = canvas.toDataURL("image/png");
          
                var uri = img.replace(/^data:image\/[^;]/, 'data:application/octet-stream');
          
                var link = document.createElement('a');
                if (typeof link.download === 'string') {
                    document.body.appendChild(link); 
                    link.download = 'barcode_'+$('#the_barcode').val()+'.png';
                    link.href = uri;
                    link.click();
                    document.body.removeChild(link);
                } else {
                    location.replace(uri);
                }
            }
        }); 
    })

    $('#print').click(function() {

        var style = `
            @media screen { body{ height: calc(100%); width: calc(100%);} }
            .container-fluid { height: calc(100%); }
            div#display { display: flex; height: 100%; width: 100%; align-items: center; }
            @media print { div#display { display: flex; height: auto; width: 100%; align-items: center; } }
            #display #field, #display center { margin: auto; }
            #field img { height: 9vh; max-width: 100% }
            div#code { font-weight: 700; font-size: 17px; text-align: justify; text-align-last: justify; }
        `;

        var openWindow = window.open("", "", "_blank");
        openWindow.document.write($('#display').parent().html());
        openWindow.document.write('<style>' + style + '</style>');
        openWindow.document.close();
        openWindow.focus();
        openWindow.print();
        // openWindow.close();
        setTimeout(function(){
            openWindow.close();
        }, 1000)
    })
</script>