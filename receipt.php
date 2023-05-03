
<?php
session_start();
ob_start(); // Start output buffering

echo '<pre>';
print_r($_SESSION['cart']);
echo '</pre>';

require_once 'vendor/autoload.php';

// Generate the PDF file
require_once('tcpdf/tcpdf.php');

// Set the font
$pdf = new TCPDF('P', 'mm', 'A4');
$pdf->SetFont('times', '', 12);

// Set the page margins
$pdf->SetMargins(25, 25, 25);

// Add a new page
$pdf->AddPage();

// Set the content
$content = '<h1>Receipt</h1>';
$content .= '<table>';
$content .= '<tr><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';

$total = 0;
foreach ($_SESSION['cart'] as $product) {
  $name = $product['name'];
  $quantity = $product['quantity'];
  $price = $product['price'];
  $subtotal = $quantity * $price;
  $total += $subtotal;
  
  $content .= '<tr>';
  $content .= '<td>' . $name . '</td>';
  $content .= '<td>' . $quantity . '</td>';
  $content .= '<td>' . number_format($price, 2) . '</td>';
  $content .= '<td>' . number_format($subtotal, 2) . '</td>';
  $content .= '</tr>';
}

$content .= '<tr><td colspan="3" align="right">Total:</td><td>' . number_format($total, 2) . '</td></tr>';
$content .= '</table>';

$pdf->writeHTML($content, true, false, true, false, '');

// Output the PDF
$pdf->Output('receipt.pdf', 'D');

ob_end_clean(); // Clean the output buffer
?>