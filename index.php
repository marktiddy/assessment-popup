<?php 
include('config/db_connect.php');
$success = '';
$name = '';
$email = '';
$phone = '';
$message = '';
$errors = array('name'=>'','email'=>'','phone'=>'','message'=>'','submission'=>'');
//PHP to process our form on submission
if (isset($_POST['submit'])) {
  
  //Check for content
  if (empty($_POST['name'])) {
    $errors['name'] = 'A name is required <br />';
  } else {
    $name = htmlspecialchars($_POST['name']);
  }
  if (empty($_POST['email'])) {
    $errors['email'] = 'An email is required <br />';
  } else {
   $email = htmlspecialchars($_POST['email']);
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $errors['email'] = 'Your email address needs to be valid <br />';
   }
  }
  if (empty($_POST['phone'])) {
    $errors['phone'] = 'A telephone number is required <br />';
  } else {
    $phone = htmlspecialchars($_POST['phone']);
  }
  if (empty($_POST['message'])) {
    $errors['message'] = 'You need to include a message <br />';
  } else {
    $message = htmlspecialchars($_POST['message']);
  }
  //Check if we have errors
  if (array_filter($errors)) {
    //The form has errors
  } else {
    //We are ready to submit
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);
  
    $sql = "INSERT INTO form_submissions(name,email,phone,message) VALUES('$name','$email','$phone','$message')";
  
    if (mysqli_query($conn,$sql)) {
      //success
      $success = 'Thank you. We have received your message and will be in touch soon';
      header('Location: index.php');
    } else {
      $errors['submission'] = 'Sorry, we had a problem sending your message';
      header('Location: index.php');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Home - Assessment</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css" />
  </head>
  <body>
    <div class="container">
    <p id="success-message"><?php echo $success; ?></p>
      <p class="nectar-button" id="modal-open">Enquire<i class="fas fa-arrow-right nectar-button-icon"></i></p>
    </div>

    <div id="modal">
      <div id="modal-inner">
        <p id="modal-close">x</p>
        <div id="modal-content">
          <h2>Self Employed Accounts</h2>
        <p>
          Let us take care of your finances so you can focus on your business.
        <br />
        Get in touch to find out more.
        </p>
        <div id="modal-inner-form">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-element">
              <label for="name" hidden>Full Name</label>
              <input type="text" id="name" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>" required><br />
              <?php if ($errors['name']): ?>
                <p class="form-error"><?php echo $errors['name']; ?></p>
              <?php endif; ?>
            </div>
            <div class="form-element">
              <label for="phone" hidden>Phone</label>
              <input type="tel" id="phone" name="phone" placeholder="Phone" maxlength="40" value="<?php echo htmlspecialchars($phone); ?>" required><br />
              <?php if ($errors['phone']): ?>
                <p class="form-error"><?php echo $errors['phone']; ?></p>
              <?php endif; ?>
            </div>
            <div class="form-element">
              <label for="email" hidden>Email</label>
              <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
              <?php if ($errors['email']): ?>
                <p class="form-error"><?php echo $errors['email']; ?></p>
              <?php endif; ?>
            </div>
            <div class="form-element">
              <label for="message" hidden>Message</label>
              <textarea id="message" placeholder="Message" name="message" value="<?php echo htmlspecialchars($message); ?>" required></textarea>
              <?php if ($errors['message']): ?>
                <p class="form-error"><?php echo $errors['message']; ?></p>
              <?php endif; ?>
              <?php if ($errors['submission']): ?>
                <p class="form-error"><?php echo $errors['submission']; ?></p>
              <?php endif; ?>
            </div>
            <div class="form-element">
              <button type="submit" name="submit" class="nectar-button-submit">Send</button>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
    <script src="scripts.js"></script>
</html>
