<?php 
// Next bill #
// $last_bill_no = $conn->query("SELECT MAX(id + 1) AS bill_no FROM invoices");
// $bill_no = $last_bill_no->fetch_array();
    $invoice_id = '123456-'.uniqid();     // $bill_no['bill_no'].'-'.uniqid();
    $products = fetch_all_products();
?>

<style type="text/css">
td:nth-child(2) {
    width: 10%;
}
input {
    font-size: 10px;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="main.php?dir=customer_pos&page=list_porders">Customer POs</a></li>
    <li class="breadcrumb-item active">Barcode Demo Order</li>
</ol>

<div class="row">
    <div class="col-lg-12">
        <!-- Panel Standard Mode -->
        <div class="card my-2">
            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <h4 class="my-0">Add Product</h4>
                </div>
            </div>
            <div class="card-body" style="font-size: 14px;">

                <!-- Status Messages -->
                <div id="alert-msg"></div>

                <form class="form-horizontal00 bcioForm" action="ajax_sale.php" method="POST" 
                            name="barcodeInlineOrderForm" id="barcodeInlineOrderForm" autocomplete="off">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['userid'];?>" />
                    <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id; ?>" />

                    <table id="bcioList">
                        <thead>
                            <th width="12%">Barcode</th>
                            <th width="15%">Product</th>
                            <th width="10%">SKU</th>
                            <!-- <th width="8%">Brand</th> -->
                            <!-- <th width="8%">Category</th> -->
                            <th width="25%">Description</th>
                            <th width="8%">Unit</th>
                            <th width="8%">Quantity</th>
                            <th width="10%">MRP</th>
                            <th width="10%">Total</th>
                            <th width="5%" class="text-center">Action</th>
                        </thead>
                        <tbody style="font-size: 12px;">
                            <tr id="1">
                                <td>
                                    <input 
                                        type="text" 
                                        id="bar_code_1" 
                                        required 
                                        class="form-control form-control-sm" 
                                        onkeypress="return restrictSpace();" 
                                        onchange="getProductByBarcode(this.value, 1)" 
                                        name="bar_code[]" />
                                </td>
                                <td>
                                    <select name="product[]" id="product_1" class="form-control form-control-sm" 
                                        onchange="getProductById(this.value, 1)" >
                                        <option value="">Choose Product</option>
                                        <?php foreach ($products as $prod) { ?>
                                            <option value="<?= $prod['id']; ?>"><?= $prod['product_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input 
                                        type="text" 
                                        id="sku_1" 
                                        class="form-control form-control-sm" 
                                        onkeypress="return restrictSpace()" 
                                        onchange="getProductBySKU(this.value, 1)" 
                                        name="sku[]" />
                                </td>
                                <!-- <td>
                                    <input 
                                        type="text" 
                                        required 
                                        class="form-control form-control-sm" 
                                        readonly 
                                        id="brand_1" 
                                        name="brand[]" />
                                </td> -->
                                <!-- <td>
                                    <input 
                                        type="text" 
                                        required 
                                        class="form-control form-control-sm" 
                                        readonly 
                                        id="category_1" 
                                        name="category[]" />
                                </td> -->
                                <td>
                                    <input 
                                        type="text" 
                                        required 
                                        class="form-control form-control-sm" 
                                        readonly 
                                        id="descr_1" 
                                        name="descr[]" />
                                </td>
                                <td>
                                    <input 
                                        type="text" 
                                        required 
                                        class="form-control form-control-sm" 
                                        readonly 
                                        id="unit_1" 
                                        name="unit[]" />
                                </td>
                                <td>	
                                    <input 
                                        type="number" 
                                        class="form-control form-control-sm" 
                                        onkeyup="calculate_price(this.value,1)" 
                                        step="1" 
                                        id="quantity_1" 
                                        name="quantity[]" />
                                </td>
                                <td>
                                    <input 
                                        type="text" 
                                        required 
                                        class="form-control form-control-sm" 
                                        readonly 
                                        id="mrp_1" 
                                        name="mrp[]" />
                                </td>
                                <td>
                                    <input 
                                        type="number" 
                                        required 
                                        class="form-control form-control-sm" 
                                        onkeyup="get_quantity(this.value, 1)" 
                                        step="1" 
                                        id="total_1" 
                                        name="total[]" />
                                </td>
                            </tr>
                        </tbody>

                        <tfoot id="foot" style="margin-top:20px;">
                            <tr>
                                <td class="text-right"><b>Paid By : </b></td>
                                <td > 
                                    <select name="payment_method" class="form-control form-control-sm" id="payment_method">
                                        <option value='cash'>Cash</option>
                                        <option value='card'>Card</option>
                                        <option value='paytm'>Paytm</option>
                                        <option value='phone_pay'>Phone Pay</option>
                                        <option value='google_pay'>Google Pay</option>
                                        <option value='upi'>UPI</option>
                                        <option value='udhar'>UDHAR</option>
                                        <option value='other'>Other</option>
                                    </select>
                                </td>
                                <td   colspan="5" class='text-right'><b>Total : </b></td>
                                <td><input type="number" class="form-control" readonly name="total" value="0" id="getTotal" /></td>
                            </tr>
                        </tfoot>

                    </table>

                    <div class="text-right mt-4">
                        <button type="submit" name="make_print" class="btn btn-primary" id="validateButton2">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function restrictSpace() {
        if (event.keyCode == 32) {
            return false;
        }
    }

    function getProductByBarcode(b, n) {
        var nx = n+1;
        
        $.ajax({  
            type:"POST",  
            url: `${baseUrlMain}/core/ajax/main/products.php`,  
            data:{ bar_code: b, action_type: "get_product_by_barcode" },
            success:function(data) {
                // alert(data);
                var data = $.parseJSON(data);
                console.log(data);
                if(data.type == 'Success') {
                    
                    // Check Duplicate Value
                    var barCode = document.querySelectorAll("#barcodeInlineOrderForm input[name='bar_code[]']");
                    for(key=0; key < barCode.length - 1; key++)  {
                        if(barCode[key].value == data.bar_code){
                            alert("Already Exist");
                            document.getElementById('bar_code_'+n).value = '';
                            document.getElementById('bar_code_'+n).focus();
                            return false;
                        }					
                    }
                    
                    // Add a new row
                    var newRow = $('#bcioList tbody').append(`
                        <tr id="${nx}">
                            <td>
                                <input 
                                    type="text" class="form-control form-control-sm" 
                                    onkeypress="return restrictSpace()" 
                                    onchange="getProductByBarcode(this.value, ${nx})" 
                                    id="bar_code_${nx}" 
                                    name="bar_code[]" 
                                    required />
                            </td>
                            <td>
                                <select name="product[]" id="product_${nx}" class="form-control form-control-sm" 
                                    onchange="getProductById(this.value, ${nx})" required >
                                    <option value="">Choose Product</option>
                                    <?php foreach ($products as $prod) { ?>
                                        <option value="<?= $prod['id']; ?>"><?= $prod['product_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="sku_${nx}" class="form-control form-control-sm" 
                                    onkeypress="return restrictSpace()" 
                                    onchange="getProductBySKU(this.value, ${nx})" 
                                    name="sku[]" />
                            </td>
                            <!-- <td>
                                <input 
                                    type="text" 
                                    id="brand_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="brand[]" 
                                    required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="category_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="category[]" 
                                    required />
                            </td> -->
                            <td>
                                <input 
                                    type="text" 
                                    id="descr_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="descr[]" 
                                    required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="unit_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="unit[]" />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    id="quantity_${nx}" 
                                    step="1" 
                                    class="form-control form-control-sm" 
                                    onkeyup="calculate_price(this.value, ${nx})" 
                                    name="quantity[]" 
                                    required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="mrp_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="mrp[]" 
                                    required />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    id="total_'${nx}" 
                                    class="form-control form-control-sm" 
                                    onkeyup="get_quantity(this.value, ${nx})" 
                                    name="total[]" 
                                    step="1" 
                                    required />
                            </td>
                            <td>
                                <a href="#" onclick="remove_data(${nx})" 
                                    class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" 
                                    data-toggle="tooltip" 
                                    data-original-title="Remove">Delete
                                </a>
                            </td>
                        </tr>
                    `);
                    
                    // Fill the current row
                    document.getElementById('product_'+n).value = data.product_id;
                    document.getElementById('sku_'+n).value = data.sku;
                    // document.getElementById('brand_'+n).value = data.brand;
                    // document.getElementById('category_'+n).value = data.category;
                    document.getElementById('descr_'+n).value = data.description;
                    document.getElementById('unit_'+n).value = data.unit;
                    document.getElementById('quantity_'+n).value = 1;
                    document.getElementById('mrp_'+n).value = data.unit_price;   
                    document.getElementById('total_'+n).value = "0.00";
                    
                    // //Get Value For Total
                    // var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");
                    // var newA = [];
                    // for(key=0; key < salePrice.length; key++)  {
                    //     if(salePrice[key].value != ''){
                    //         newA.push(parseFloat(salePrice[key].value));
                    //     }
                    // }
                    // var aac = newA.reduce(getSum);
                    // document.getElementById('getTotal').value = Math.round(parseFloat(aac));
                    
                    document.getElementById('bar_code_'+nx).focus();
                } else{
                    alert("Barcode Not Found");
                    document.getElementById('bar_code_'+n).value = '';
                    document.getElementById('bar_code_'+n).focus();
                    return false;
                }
            }  
        });
    }

    function getProductById(i, n) {

        var nx = n+1;

        $.ajax({  
            type:"POST",  
            url: `${baseUrlMain}/core/ajax/main/products.php`,  
            data:{productid: i, action_type: "get_product_by_id"},
            success:function(data) { 
                // alert(data);
                var data = $.parseJSON(data);
                console.log(data);

                if (data.type == 'Success'){
                    //Check Duplicate Value
                    var barCode = document.querySelectorAll("#barcodeInlineOrderForm input[name='bar_code[]']");
                    for(key=0; key < barCode.length - 1; key++)  {
                        if(barCode[key].value == data.bar_code){
                            alert("Already Exist");
                            return false;
                        }					
                    }
                                    
                    //Appending New Row
                    var newRow = $('#bcioList tbody').append(`
                        <tr id="${nx}">
                            <td>
                                <input 
                                    type="text" class="form-control form-control-sm" 
                                    onkeypress="return RestrictSpace()" 
                                    onchange="getProductByBarcode(this.value, ${nx})" 
                                    id="bar_code_${nx}" 
                                    name="bar_code[]" 
                                    required />
                            </td>
                            <td>
                                <select name="product[]" id="product_${nx}" class="form-control form-control-sm" 
                                    onchange="getProductById(this.value, ${nx})" required >
                                    <option value="">Choose Product</option>
                                    <?php foreach ($products as $prod) { ?>
                                        <option value="<?= $prod['id']; ?>"><?= $prod['product_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="sku_${nx}" 
                                    class="form-control form-control-sm" 
                                    onkeypress="return restrictSpace()" 
                                    onchange="getProductBySKU(this.value, ${nx})" 
                                    name="sku[]" />
                            </td>
                            <!-- <td>
                                <input 
                                    type="text" 
                                    id="brand_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="brand[]" required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="category_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="category[]" required />
                            </td> -->
                            <td>
                                <input 
                                    type="text" 
                                    id="descr_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="descr[]" required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="unit_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="unit[]" />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    id="quantity_${nx}" 
                                    step="1" 
                                    class="form-control form-control-sm" 
                                    onkeyup="calculate_price(this.value, ${nx})" 
                                    name="quantity[]" required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="mrp_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="mrp[]" required />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    id="total_${nx}" 
                                    onkeyup="get_quantity(this.value, ${nx})" 
                                    class="form-control form-control-sm" 
                                    name="total[]" 
                                    step="1" 
                                    required />
                            </td>
                            <td>
                                <a href="#" 
                                    onclick="remove_data(${ nx })" 
                                    class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" 
                                    data-toggle="tooltip" 
                                    data-original-title="Remove">Delete
                                </a>
                            </td>
                        </tr>`);

                    // Fill the current row        
                    document.getElementById('bar_code_'+n).value = data.bar_code;
                    document.getElementById('sku_'+n).value = data.sku;
                    // document.getElementById('brand_'+n).value = data.brand;
                    // document.getElementById('category_'+n).value = data.category;
                    document.getElementById('descr_'+n).value = data.description;
                    document.getElementById('unit_'+n).value = data.unit;
                    document.getElementById('quantity_'+n).value = 1;
                    document.getElementById('mrp_'+n).value = data.unit_price;   
                    document.getElementById('total_'+n).value = "0.00";
                    
                    // //Get Value For Total
                    // var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");
                    // var newA = [];
                    // for(key=0; key < salePrice.length; key++)  {
                    //     if(salePrice[key].value != ''){
                    //         newA.push(parseFloat(salePrice[key].value));
                    //     }
                    // }
                    // var aac = newA.reduce(getSum);
                    // document.getElementById('getTotal').value = Math.round(parseFloat(aac));
                    
                    document.getElementById('product_'+nx).focus();
                } else{
                    alert("Product Not Found!");
                }
            }  
        });
    }

    function getProductBySKU(s, n) { 
        var nx = n+1;
        
        $.ajax({  
            type:"POST",  
            url: `${baseUrlMain}/core/ajax/main/products.php`,  
            data:{sku: s, action_type: "get_product_by_sku"},
            success:function(data){
                // alert(data);
                var data = $.parseJSON(data);
                console.log(data);

                if(data.type == 'Success'){
                    
                    // Check Duplicate Value
                    var skus = document.querySelectorAll("#barcodeInlineOrderForm input[name='sku[]']");
                    for(key=0; key < skus.length - 1; key++)  {
                        if(skus[key].value == data.sku){
                            alert("SKU Exist");
                            document.getElementById('sku_'+n).value = '';
                            document.getElementById('sku_'+n).focus();
                            return false;
                        }					
                    }
                    
                    // Appending New Row
                    var newRow = $('#bcioList tbody').append(`
                        <tr id=${nx}>
                            <td>
                                <input 
                                    type="text" 
                                    class="form-control form-control-sm" 
                                    onkeypress="return restrictSpace()" 
                                    onchange="getProductByBarcode(this.value, ${nx})" 
                                    id="bar_code_${nx}" 
                                    name="bar_code[]" 
                                    required />
                            </td>
                                <select name="product[]" id="product_${nx}" class="form-control form-control-sm" 
                                    onchange="getProductById(this.value, ${nx})" required >
                                    <option value="">Choose Product</option>
                                    <?php foreach ($products as $prod) { ?>
                                        <option value="<?= $prod['id']; ?>"><?= $prod['product_name']; ?></option>
                                    <?php } ?>
                                </select>
                            <td>
                                <input 
                                    type="text" 
                                    id="sku_${nx}" 
                                    class="form-control form-control-sm" 
                                    onkeypress="return restrictSpace()" 
                                    onchange="getProductBySKU(this.value, ${nx})" 
                                    name="sku[]" />
                            </td>
                            <!-- <td>
                                <input 
                                    type="text" 
                                    id="brand_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="brand[]" required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="category_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="category[]" required />
                            </td> -->
                            <td>
                                <input 
                                    type="text" 
                                    id="unit_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="unit[]" />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    id="quantity_${nx}" 
                                    step="1" 
                                    class="form-control form-control-sm" 
                                    onkeyup="calculate_price(this.value, ${nx})" 
                                    name="quantity[]" 
                                    required />
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    id="mrp_${nx}" 
                                    readonly 
                                    class="form-control form-control-sm" 
                                    name="mrp[]" 
                                    required />
                            </td>
                            <td>
                                <input 
                                    type="number" 
                                    id="total_${nx}" 
                                    class="form-control form-control-sm" 
                                    onkeyup="get_quantity(this.value, ${nx})" 
                                    name="total[]" 
                                    step="1" 
                                    required />
                            </td>
                            <td>
                                <a href="#" 
                                    onclick="remove_data(${nx})" 
                                    class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" 
                                    data-toggle="tooltip" 
                                    data-original-title="Remove">Delete
                                </a>
                            </td>
                        </tr>`);
                    
                    document.getElementById('bar_code_'+n).value = data.bar_code;
                    document.getElementById('product_'+n).value = data.product_id;
                    // document.getElementById('brand_'+n).value = data.brand;
                    // document.getElementById('category_'+n).value = data.category;
                    document.getElementById('descr_'+n).value = data.description;
                    document.getElementById('unit_'+n).value = data.unit;
                    document.getElementById('quantity_'+n).value = 1;
                    document.getElementById('mrp_'+n).value = data.unit_price;                    
                    document.getElementById('total_'+n).value = "0.00";
                    
                    // //Get Value For Total
                    // var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");
                    // var newA = [];
                    // for(key=0; key < salePrice.length; key++)  {
                    //     if(salePrice[key].value != ''){
                    //         newA.push(parseFloat(salePrice[key].value));
                    //     }
                    // }
                    // var aac = newA.reduce(getSum);
                    // document.getElementById('getTotal').value = Math.round(parseFloat(aac));
                    
                    document.getElementById('bar_code_'+nx).focus();
                } else {
                    alert("Alias Not Found");
                    document.getElementById('alias_'+n).value = '';
                    document.getElementById('alias_'+n).focus();
                    return false;
                }
            }  
        });
    }

    function calculate_price(q,n) {
    //     var sale_price_org = document.getElementById('sale_price_org_'+n).value;
    //     var sp = document.getElementById('sale_price_'+n).value;
    //     //var total = document.getElementById('getTotal').value;
    //     var gt = document.getElementById('sale_price_'+n).value = (sale_price_org * q).toFixed(2);
        
    //     var salePrice = document.querySelectorAll("#dd input[name='sale_price[]']");

    //     var newA = [];
    //     for(key=0; key < salePrice.length ; key++)  {
    //         if(salePrice[key].value != ''){
    //             newA.push(parseFloat(salePrice[key].value));
    //         }
    //     }
        
    //     //alert(newA);
    //     var aac = newA.reduce(getSum);
    //     document.getElementById('getTotal').value = Math.round(parseFloat(aac));
    //     //alert(aac);
    //     //document.getElementById('getTotal').value = Math.round((parseFloat(total) - parseFloat(sp)) + parseFloat(gt));
    }

    function getSum(total, num) {
        return parseFloat(total + num);
    }

    function get_quantity(p,n){
        
        //     var salePrice = document.querySelectorAll("#barcodeInlineOrderForm input[name='sale_price[]']");
    
        //     var newA = [];
        //     for(key=0; key < salePrice.length; key++)  {
        //         if(salePrice[key].value != ''){
        //             newA.push(parseFloat(salePrice[key].value));
        //         }
        //     }
            
        //     //alert(newA);
        //     var aac = newA.reduce(getSum);
        //     document.getElementById('getTotal').value = Math.round(parseFloat(aac));
        //     //alert(aac);
            
        //     var sale_price_org = document.getElementById('sale_price_org_'+n).value;
        //     var spgF = parseFloat(sale_price_org);
        //     var sp = document.getElementById('sale_price_'+n).value;
        //     var spF = parseFloat(sp);
        //     document.getElementById('quantity_'+n).value = (p/parseFloat(sale_price_org)).toFixed(3);
                
    }

    function remove_data(r){
        // $('#' + r).remove();
        // //Get Value For Total
        // var salePrice = document.querySelectorAll("#barcodeInlineOrderForm input[name='sale_price[]']");
        // var newA = [];
        // for(key=0; key < salePrice.length; key++)  {
        //     if(salePrice[key].value != ''){
        //         newA.push(parseFloat(salePrice[key].value));
        //     }
        // }
        // var aac = newA.reduce(getSum);
        // document.getElementById('getTotal').value = Math.round(parseFloat(aac));
    }

</script>

<script>
$(document).ready(function() {
    // const baseUrlMain = window.location.origin + '/imanager';

    $('.page-title').addClass('d-none');

    // Set focus to the barcode input
    default_focus(); 

    function default_focus(){
        document.getElementById('bar_code_1').focus();
    }

    $(".bcioForm").submit(function(e) {
    //     e.preventDefault(); // avoid to execute the actual submit of the form.
    //     var form = $(this);
    //     var url = form.attr('action');
    //     $.ajax({
    //         type: "POST",
    //         url: `${baseUrlMain}/core/ajax/main/products.php`,
    //         data: form.serializeArray(), // serializes the form's elements.
    //         success: function(data){
    //             if(data != "ERROR"){
    //                 var htmlToPrint = '' +
    //                     '<style type="text/css">' +
    //                     '#invoice_table th, #invoice_table td {' +
    //                     'font-size:12px;' +
    //                     'text-align:left;' +
    //                     '}' +

    //                     '.border_dotted {' +
    //                     'border-bottom:1px dashed #000' +
    //                     '}' +
                        
    //                     '.border_dotted_top {' +
    //                     'border-top:1px dashed #000' +
    //                     '}' +
                        
    //                     '#invoice_table td:last-child {' +
    //                     'text-align:right' +
    //                     '}' +
    //                     '</style>';
    //                 htmlToPrint += data;
                    
    //                 newWin= window.open("");
    //                 newWin.document.write(htmlToPrint);
    //                 newWin.print();
    //                 newWin.close();
    //                 window.location.reload(true);
    //             }else{
    //                 alert("Something Went Wrong, Please Try Again !");
    //             }
    //         }
    //     });
    });

});
</script>    