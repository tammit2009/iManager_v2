$(document).ready(function() {

    const baseUrl = window.location.origin;

    $("#order_req_create_orders_btn").click(function() {
        orderRequisitionId = $("#order_requisition_id").val();
        window.location = `${baseUrl}/imanager/admin/dashboard.php?page=add_orders&orid=${orderRequisitionId}`; 
    });   


    // // add the first row
    // addNewRow();

    // function addNewRow() {
    //     $.ajax({
    //         url: `${baseUrl}/imanager/core/services/process.php`, 
    //         method: "POST",
    //         data: { get_new_order_item: 1 },
    //         success: function(rsp) {
    //             //alert(rsp);
    //             $("#order_item").append(rsp);

    //             // set the number fields (auto-incrementing)
    //             var n = 0;
    //             $(".number").each(function() {
    //                 $(this).html(++n);  
    //             });

    //             // set the hidden input's id field programmatically
    //             n = 0;
    //             $(".vproduct_id").each(function() {
    //                 ++n; 
    //                 $(this).attr('id',   'vproduct_' + n); 
    //             });

    //             // set the select button's data-xdata attribute field
    //             n = 0;
    //             $(".select_vproduct").each(function() {
    //                 $(this).attr('data-xdata', ++n); 
    //             });
    //         }
    //     })
    // }
    
    // $("#add").click(function() {
    //     addNewRow();
    // });

    // $("#remove").click(function() {
    //     $("#order_item").children("tr:last").remove();
    //     calculate(0, 0, 0);
    // });

    // $("#order_item").delegate('.vproduct_id', "change", function() {
        
    //     var vproduct_id = $(this).val(); 
    //     var tr = $(this).parent().parent();

    //     // $(".overlay").show();

    //     $.ajax({
    //         url: `${baseUrl}/imanager/core/services/process.php`,
    //         method: "POST",
    //         dataType: "json",
    //         data: { get_order_item_details: 1, id: vproduct_id },
    //         success: function(rsp) {
    //             tr.find(".vproduct_name").val(rsp["product_name"]);
    //             tr.find(".vproduct_supplier_id").val(rsp["vendor_id"]);
    //             tr.find(".vproduct_supplier").html(rsp["vendor"]);
    //             tr.find(".vproduct_supplier").val(rsp["vendor"]);
    //             tr.find(".vproduct_descr").html(rsp["short_descr"]);
    //             tr.find(".vproduct_descr").val(rsp["short_descr"]);
    //             tr.find(".vproduct_rate").val(rsp["offer_price"]);
    //             tr.find(".vproduct_qty").val(1);
    //             tr.find(".vproduct_total").val( tr.find(".vproduct_qty").val() * tr.find(".vproduct_rate").val() );
    //             calculate(0, 0, 0);
    //         }
    //     });
    // });

    // $("#order_item").delegate(".vproduct_qty", "keyup", function() {
    //     var qty = $(this);
    //     var tr = $(this).parent().parent();
    //     //alert(tr.find(".vproduct_qty").val());
    //     if (isNaN(qty.val())) {
    //         alert("Please enter a valid quantity");
    //         qty.val(1);
    //     }
    //     else {
    //         //if ((qty.val() - 0) > (tr.find(".tqty").val() - 0)) {
    //         // if (parseInt(qty.val()) > parseInt(tr.find(".tqty").val())) {
    //         //     alert("Sorry, this required quantity exceeds available quantity");
    //         //     qty.val(1);
    //         // }
    //         // else {
    //             tr.find(".vproduct_total").val(qty.val() * tr.find(".vproduct_rate").val());
    //             calculate(0, 0, 0);
    //         //}
    //     }
    // });

    // function calculate(_discount, _paid, _shipping) {

    //     var sub_total = 0;
    //     var vat = 0;
    //     var total_amt = 0;
    //     var discount = _discount ? _discount : 0.0;
    //     var shipping = _shipping ? _shipping : 0.0;
    //     var grand_total = 0;
    //     var paid_amt = _paid ? _paid : 0.0;
    //     var due = 0;

    //     $(".vproduct_total").each(function() {
    //         sub_total = sub_total + ($(this).val() * 1);
    //     });

    //     vat = 0.075 * sub_total;
    //     vat = vat.toFixed(2);
    //     total_amt = sub_total + parseFloat(vat); 
    //     total_amt = total_amt - parseFloat(discount);
    //     total_amt = total_amt.toFixed(2);
    //     grand_total = parseFloat(total_amt) + parseFloat(shipping);
    //     paid_amt = parseFloat(paid_amt).toFixed(2);
    //     grand_total = parseFloat(grand_total).toFixed(2);
    //     due = grand_total - paid_amt;
    //     due = parseFloat(due).toFixed(2);

    //     $("#order_subtotal").val(sub_total);
    //     $("#order_vat").val(vat);
    //     $("#order_discount").val(discount);
    //     $("#order_total_amt").val(total_amt);
    //     $("#order_shipping").val(shipping);
    //     $("#order_grand_total").val(grand_total);
    //     $("#order_paid_amount").val(paid_amt);
    //     $("#order_due_amount").val(due);
    //     $("#order_payment_status").val("PENDING");
    // }

    // $("#order_discount").keyup(function() {
    //     var discount = $(this).val();
    //     var paid = $("#order_paid_amount").val();
    //     var shipping = $("#order_shipping").val();
    //     calculate(discount, paid, shipping);
    // });

    // $("#order_paid_amount").keyup(function() {
    //     var paid = $(this).val();
    //     var discount = $("#order_discount").val();
    //     var shipping = $("#order_shipping").val();
    //     calculate(discount, paid, shipping);
    // });

    // $("#order_shipping").keyup(function() {
    //     var shipping = $(this).val();
    //     var paid = $("#order_paid_amount").val();
    //     var discount = $("#order_discount").val();
    //     calculate(discount, paid, shipping);
    // });

    // // Order Accepting

    // $("#order_create_btn").click(function() {

    //     //var invoice = $("#order_form").serialize();

    //     if ($("#picker").val() === "") {
    //         alert("Please enter the date"); // not necessary
    //     }
    //     else if ($("#order_paid_amount").val() === "") {
    //         alert("Please enter paid amount");
    //     }
    //     else {

    //         $.ajax({
    //             url: `${baseUrl}/imanager/core/services/process.php`,
    //             method: "POST",
    //             data: $("#order_form").serialize(),
    //             success: function(rsp) {
    //                 //alert(rsp);
    //                 if (rsp < 0) {
    //                     alert("rsp");
    //                 }
    //                 else {

    //                     $("#order_form").trigger("reset");
    //                     window.location = `${baseUrl}/imanager/admin/dashboard.php?page=list_orders`;

    //                     // if (confirm("Do you want to print invoice?")) {
    //                     //     window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+ rsp +"&"+invoice;
    //                     // }
    //                 }
    //             }
    //         });

    //     }       
    // });    


    // $("#order_requisition_next_btn").click(function() {

    //     // //var invoice = $("#order_form").serialize();

    //     // if ($("#picker").val() === "") {
    //     //     alert("Please enter the date"); // not necessary
    //     // }
    //     // else if ($("#order_paid_amount").val() === "") {
    //     //     alert("Please enter paid amount");
    //     // }
    //     // else {

    //     //     $.ajax({
    //     //         url: `${baseUrl}/imanager/core/services/process.php`,
    //     //         method: "POST",
    //     //         data: $("#order_form").serialize(),
    //     //         success: function(rsp) {
    //     //             //alert(rsp);
    //     //             if (rsp < 0) {
    //     //                 alert("rsp");
    //     //             }
    //     //             else {

    //     //                 $("#order_form").trigger("reset");
    //     //                 window.location = `${baseUrl}/imanager/admin/dashboard.php?page=list_orders`;

    //     //                 // if (confirm("Do you want to print invoice?")) {
    //     //                 //     window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+ rsp +"&"+invoice;
    //     //                 // }
    //     //             }
    //     //         }
    //     //     });

    //     // }       
    // }); 


});

