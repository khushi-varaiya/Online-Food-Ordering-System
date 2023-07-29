<?php
include("db.php");

if (isset($_GET['hotel_id'])) {
  $hotelId = $_GET['hotel_id'];

  // Retrieve the hotel information based on the hotel_id
  $hotelQuery = mysqli_query($conn, "SELECT * FROM hotel WHERE hotel_id = $hotelId");
  $hotel = mysqli_fetch_assoc($hotelQuery);

  // Retrieve the items associated with the selected hotel
  $itemsQuery = mysqli_query($conn, "SELECT * FROM item WHERE hotel_id = $hotelId");
  $items = mysqli_fetch_all($itemsQuery, MYSQLI_ASSOC);
} else {
  // Redirect if no hotel_id is provided
  header("Location: index.php");
  exit();
}

// Function to generate PDF menu
function generatePDFMenu($hotelName, $items)
{
  // Include the necessary libraries
  require('fpdf/fpdf.php');

  // Create a new PDF instance
  $pdf = new FPDF();
  $pdf->AddPage();

  // Set font and size
  $pdf->SetFont('Times', 'B', 26);
  
  // Set background color for the whole page
  $pdf->SetFillColor(255, 242, 204); // Orange color
  $pdf->Rect(0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'F'); // Draw filled rectangle as background

  $imagePath = 'Images\logo.png';
  $pdf->Image($imagePath, 10, 7, 30);

  // Add hotel name as the title with a border
  $pdf->Cell(0, 10, $hotelName . ' MENU', 0, 1, 'C');

  // Draw a line using a cell
  $pdf->Cell(0, 5, '', 'B', 1, 'C');
  $pdf->SetLineWidth(1); 
  // Adjust the position to draw the line evenly
  $pdf->Ln(5);

  // Set font for the items
  $pdf->SetFont('Times', 'B', 20);

  // Add items to the PDF
  foreach ($items as $item) {
    // Set background color for the menu item
    $pdf->SetFillColor(255, 206, 254); // Set background color to RGB(255, 153, 0)
  
    // Set background color for the item name
    // $pdf->SetFillColor(255, 153, 0); // Orange color
    $pdf->Cell(80, 10, $item['item_name'], 0, 0, 'L'); // Display item name without border

    // Add space between item name and price
    $pdf->Cell(80, 10, '', 0, 0); // Empty cell for space

    // Display the item price without background color
    // $pdf->SetFillColor(255, 255, 255); // White color
    $pdf->Cell(30, 10, $item['price'] . ' Rs/-', 0, 1, 'L'); // Display item price without border
    
    // Add some spacing between menu items
    $pdf->Ln(5);
  }
  
  // Set the line width for the outer border
  $pdf->SetLineWidth(0.5); // Set the line width to 0.5
  // Draw the outer border
  $pdf->Rect(5, 5, $pdf->GetPageWidth() - 10, $pdf->GetPageHeight() - 10);
  // Set the line width for the inner border
  $pdf->SetLineWidth(1); // Set the line width to 0.25
  // Draw the inner border
  $pdf->Rect(2.5, 2.5, $pdf->GetPageWidth() - 5, $pdf->GetPageHeight() - 5);
  // Output the PDF
  $pdf->Output($hotelName . '_Menu.pdf', 'D');
}

// Check if the "Download Menu" button is clicked
if (isset($_POST['download_menu'])) {
  generatePDFMenu($hotel['hotel_name'], $items);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>TASTY TRACK
    <?php echo $hotel['hotel_name']; ?>
  </title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .red-heart {
      color: red;
    }
  </style>
</head>

<body>
  <?php include("header.php") ?>

  <!-- Items section -->

  <section class="my-5">
    <div class="py-4">
      <a href="home.php" style="text-decoration: none;">
        <h2 class="header_text text-center" style="padding-top: 35px">Menu -
          <?php echo $hotel['hotel_name']; ?> HOTEL
        </h2>
      </a>
     <?php include("menu_download.php");?>
    </div>
    <div class="container-fluid">
      <div class="row container-fluid">
        <?php foreach ($items as $item) {
           ?>
          <div class="col-lg-3 col-md-4 col-sm-6 col-12 container-fluid py-4 px-3">
            <div class="card card_customs">
              <img class="card-img-top" src="<?php echo $item['image'] ?>" height="200px" alt="Card image">
              <!-- <button class="heart-button" type="button"
                style="position: absolute; top:4px; right: 6px; padding: 2px; width: 50px; border-radius: 5px; background-color: white;">
                <i class="fa fa-heart" style="font-size: 25px; margin: 3px;"></i>
              </button> -->
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo $item['item_name']; ?>
                </h5>
                <p class="card-text">
                  <?php echo $item['about']; ?>
                </p>
                <h5>
                  <?php echo $item['price'] . " Rs/-"; ?>
                </h5>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var heartButtons = document.querySelectorAll('.heart-button');
    heartButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var heartIcon = this.querySelector('.fa-heart');
        heartIcon.classList.toggle('red-heart');
        if (heartIcon.classList.contains('red-heart')) {
          // Button is now red
          // Perform additional actions or logic
        } else {
          // Button is not red
          // Perform additional actions or logic
        }
      });
    });
  </script>
  <!-- footer -->
 
</body>

</html>