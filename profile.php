<!-- <?php
      session_start();

      if (isset($_POST['view_item'])) {
        $image = $_POST['image'];
        $name = $_POST['name'];
        $about = $_POST['about'];
        $price = $_POST['price'];

        // Store the item details in a session variable
        $_SESSION['viewed_item'] = array(
          'image' => $image,
          'name' => $name,
          'about' => $about,
          'price' => $price
        );

        // Redirect to the profile.php page
        header('Location: prof.php');
        exit();
      }

      // Rest of the profile.php code...
      ?> -->