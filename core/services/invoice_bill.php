<?php 
include_once('../security.php');
include_once('../../inc/php_libs/fpdf/fpdf.php'); 

// Page Dimensions Note:
// A4 Width: 219mm
// Default Margin: 10mm each side
// Writable horizontal: 219 - (10*2) = 189mm

class PDF extends FPDF {

    function Header() {
        $this->SetFont('Arial', 'B', 15);
        // Dummy cell to put logo
        $this->Cell(12);    // is equivalent to "$this->Cell(12, 0, '', 0, 0);"
        // Put logo
        $this->Image('../../assets/imgs/logo.png', 10, 10, 10);
        $this->Cell(100, 10, 'Invoice', 0, 1);
        $this->Ln(5);
    }

    function Footer() {
        // Go to 1.5cm from bottom
        $this->setY(-15);
        $this->SetFont('Arial', '', 8);
        // width=0 means the cell is extended up to the right margin
        $this->Cell(0, 10, 'Page '.$this->PageNo()." / {pages}", 0, 0, 'C');
    }
}

// Order Invoice

if (isset($_GET["order_id"])) {
    //echo "INVOICE_BILL for order ". $_GET['order_id'];

    $opr = new DBOperation();

    // Order query
    $order_res = $opr->sqlSelect("SELECT orders.order_no, orders.order_date, 
                (SELECT vendors.company_name FROM vendors WHERE orders.vendor_id = vendors.id) as vendor, 
                (SELECT users.name FROM users WHERE orders.requester_id = users.id) as requester, 
                orders.status, orders.sub_total, orders.net_total, orders.paid, orders.payment_method, 
                orders.shipping_method, orders.shipping_cost, orders.vat, orders.due, orders.discount
                FROM orders WHERE orders.id = ".$_GET['order_id']);

    // Order line item query
    $order_line_res = $opr->sqlSelect("SELECT orders.order_no, (SELECT short_descr FROM vendors_products 
                        WHERE oli.vendor_product_id = vendors_products.id) as product_descr, 
                        (SELECT sku FROM vendors_products WHERE oli.vendor_product_id = vendors_products.id) as sku, 
                        oli.quantity, oli.unit_price, oli.total_cost 
                        FROM order_line_items as oli INNER JOIN orders ON oli.order_id = orders.id 
                        WHERE orders.id = ". $_GET['order_id']);

    $order = mysqli_fetch_assoc($order_res);

    $pdf = new PDF('p', 'mm', 'A4');   // use new class

    // Define new alias for total page numbers
    $pdf->AliasNbPages('{pages}');

    $pdf->SetAutoPageBreak(true, 15);

    $pdf->AddPage();

    $guideBorder = 0;

    // Set font to arial, bold, 14pt
    $pdf->SetFont('Arial', 'B', 14);

    // Cell (width, height, text, border, end line, (align))
    $pdf->Cell(130, 5, 'REILPPUS LTD', $guideBorder, 0);
    $pdf->Cell(59, 5, 'INVOICES', $guideBorder, 1); // end of line
    
    // Set font to arial, regular, 12pt
    $pdf->SetFont('Arial', '', 12);
    
    $pdf->Cell(130, 5, '[Street Address]', $guideBorder, 0);
    $pdf->Cell(59, 5, '', $guideBorder, 1); // end of line
    
    $pdf->Cell(130, 5, '[City, Country, Zip]', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Date', $guideBorder, 0); 
    $pdf->Cell(34, 5, '[dd/mm/yyyy]', $guideBorder, 1);    // end of line
    
    $pdf->Cell(130, 5, 'Phone [+12345678]', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Invoice #', $guideBorder, 0); 
    $pdf->Cell(34, 5, '[1234567]', $guideBorder, 1);       // end of line
    
    $pdf->Cell(130, 5, 'Fax [+12345678]', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Customer ID', $guideBorder, 0); 
    $pdf->Cell(34, 5, '[1234567]', $guideBorder, 1);       // end of line
    
    // Make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', $guideBorder, 1);              // end of line
    
    // Billing Address
    $pdf->Cell(100, 5, 'Bill to', $guideBorder, 1);       // end of line
    
    // Add dummy cell at beginning of each line for indentation
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Name]', $guideBorder, 1);         // end of line
    
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Company Name]', $guideBorder, 1); // end of line
    
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Address]', $guideBorder, 1);      // end of line
    
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Phone]', $guideBorder, 1);        // end of line
    
    // Make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', $guideBorder, 1);              // end of line
    
    // Invoice contents
    $pdf->SetFont('Arial', 'B', 12);
    
    $pdf->Cell(130, 5, 'Description', 1, 0);
    $pdf->Cell(25, 5, 'Taxable', 1, 0); 
    $pdf->Cell(34, 5, 'Amount', 1, 1);          // end of line
    
    $pdf->SetFont('Arial', '', 12);

    $i = 1;
    while ($row = mysqli_fetch_assoc($order_line_res)) {
        // Numbers are right aligned so we give 'R' after new line parameter
        $pdf->Cell(130, 5, $row['product_descr'], 1, 0);
        $pdf->Cell(25, 5, '-', 1, 0); 
        $pdf->Cell(34, 5, $row['total_cost'], 1, 1, 'R');       // end of line
    }
    $order_line_res->free_result();
    
    // Summary
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Subtotal', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, $order['sub_total'], 1, 1, 'R');       // end of line
    
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Taxable', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, '0', 1, 1, 'R');          // end of line
    
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Tax Rate', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, '7.5%', 1, 1, 'R');          // end of line
    
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Total Due', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, $order['net_total'], 1, 1, 'R');          // end of line

    $opr->close();

    // Flags: 
    //   "I": send file inline to browser (default); "D": send to browser and force a file download
    //   "F": save to a local file with the name given by name
    //   "S": return the document as a string
    $pdf->Output("../../public/invoices/PDF_INVOICE_". $_GET["order_id"] .".pdf", "F"); 
    $pdf->Output();

    exit;
}


// Purchase Order Invoice

if ($_GET["po_id"]) {
    //echo "INVOICE_BILL for po ". $_GET['po_id'];

    $opr = new DBOperation();

    // Order query
    $porder_res = $opr->sqlSelect("SELECT po.id, po.porder_no, po.porder_date, po.customer_id, c.name as customer_name, 
                                    c.contact_person, c.contact_email as email, c.contact_phone as phone, c.address, 
                                    po.sub_total, po.vat, po.discount, po.net_total, po.shipping_method, po.shipping_cost, 
                                    po.payment_method, po.paid, po.due, po.status 
                                    FROM `customer_porders` as po INNER JOIN `organizations` as c 
                                    ON po.customer_id = c.id WHERE po.id=".$_GET['po_id']);

    // Order line item query
    $porder_line_res = $opr->sqlSelect("SELECT pli.id, pli.porder_id, pli.catalog_product_id, p.sku, p.brand_id, 
                                        p.category_id, p.unit, p.short_descr, pli.quantity, pli.unit_price, pli.total_cost 
                                        FROM `customer_porder_line_items` as pli INNER JOIN products as p 
                                        ON pli.catalog_product_id = p.id WHERE pli.porder_id=". $_GET['po_id']);

    $porder = mysqli_fetch_assoc($porder_res);

    $pdf = new PDF('p', 'mm', 'A4');   // use new class

    // Define new alias for total page numbers
    $pdf->AliasNbPages('{pages}');

    $pdf->SetAutoPageBreak(true, 15);

    $pdf->AddPage();

    $guideBorder = 0;

    // Set font to arial, bold, 14pt
    $pdf->SetFont('Arial', 'B', 14);

    // Cell (width, height, text, border, end line, (align))
    $pdf->Cell(130, 5, 'REILPPUS LTD', $guideBorder, 0);
    $pdf->Cell(59, 5, 'INVOICES', $guideBorder, 1); // end of line
    
    // Set font to arial, regular, 12pt
    $pdf->SetFont('Arial', '', 12);
    
    $pdf->Cell(130, 5, '[Street Address]', $guideBorder, 0);
    $pdf->Cell(59, 5, '', $guideBorder, 1); // end of line
    
    $pdf->Cell(130, 5, '[City, Country, Zip]', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Date', $guideBorder, 0); 
    $pdf->Cell(34, 5, '[dd/mm/yyyy]', $guideBorder, 1);    // end of line
    
    $pdf->Cell(130, 5, 'Phone [+12345678]', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Invoice #', $guideBorder, 0); 
    $pdf->Cell(34, 5, '[1234567]', $guideBorder, 1);       // end of line
    
    $pdf->Cell(130, 5, 'Fax [+12345678]', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Customer ID', $guideBorder, 0); 
    $pdf->Cell(34, 5, '[1234567]', $guideBorder, 1);       // end of line
    
    // Make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', $guideBorder, 1);              // end of line
    
    // Billing Address
    $pdf->Cell(100, 5, 'Bill to', $guideBorder, 1);       // end of line
    
    // Add dummy cell at beginning of each line for indentation
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Name]', $guideBorder, 1);         // end of line
    
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Company Name]', $guideBorder, 1); // end of line
    
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Address]', $guideBorder, 1);      // end of line
    
    $pdf->Cell(10, 5, '', $guideBorder, 0);
    $pdf->Cell(90, 5, '[Phone]', $guideBorder, 1);        // end of line
    
    // Make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', $guideBorder, 1);              // end of line
    
    // Invoice contents
    $pdf->SetFont('Arial', 'B', 12);
    
    $pdf->Cell(130, 5, 'Description', 1, 0);
    $pdf->Cell(25, 5, 'Taxable', 1, 0); 
    $pdf->Cell(34, 5, 'Amount', 1, 1);          // end of line
    
    $pdf->SetFont('Arial', '', 12);

    $i = 1;
    while ($row = mysqli_fetch_assoc($porder_line_res)) {
        // Numbers are right aligned so we give 'R' after new line parameter
        $pdf->Cell(130, 5, $row['short_descr'], 1, 0);
        $pdf->Cell(25, 5, '-', 1, 0); 
        $pdf->Cell(34, 5, $row['total_cost'], 1, 1, 'R');       // end of line
    }
    $porder_line_res->free_result();
    
    // Summary
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Subtotal', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, $porder['sub_total'], 1, 1, 'R');       // end of line
    
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Taxable', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, '0', 1, 1, 'R');          // end of line
    
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Tax Rate', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, '7.5%', 1, 1, 'R');          // end of line
    
    $pdf->Cell(130, 5, '', $guideBorder, 0);
    $pdf->Cell(25, 5, 'Total Due', $guideBorder, 0); 
    $pdf->Cell(6, 5, 'N', 1, 0); 
    $pdf->Cell(28, 5, $porder['net_total'], 1, 1, 'R');          // end of line

    $opr->close();

    // Flags: 
    //   "I": send file inline to browser (default); "D": send to browser and force a file download
    //   "F": save to a local file with the name given by name
    //   "S": return the document as a string
    $pdf->Output("../../public/invoices/PDF_INVOICE_". $_GET["po_id"] .".pdf", "F"); 
    $pdf->Output();

    exit;

}

?>