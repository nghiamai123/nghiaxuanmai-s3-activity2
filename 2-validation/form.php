<?php

function validate_message($message1)
{
    // function to check if message is correct (must have at least 10 characters (after trimming))
    global $message, $message_error;
    if (strlen(trim($message1)) >= 10) {
        $message = $message1;
    } else {
        $message_error = "Message must be at least 10 caracters long";
    }
}

function validate_username($username1)
{
    // function to check if username is correct (must be alphanumeric => Use the function 'ctype_alnum()')
    global $username, $user_error;
    if (ctype_alnum($username1)) {
        $username = $username1;
    } else {
        $user_error = "Please enter a username and Username should contains only letters and numbers";
    }
}


function validate_email($email1)
{
    // function to check if email is correct (must contain '@')
    global $email_error, $email;
    if (strpos($email1, "@")) {
        $email = $email1;
    } else {
        $email_error = "Please enter an email and email must contain '@'";
    }
}


$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";

$form_valid = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Here is the list of error messages that can be displayed:
    // "Message must be at least 10 caracters long"
    validate_message($_POST["message"]);
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    validate_username($_POST["username"]);
    // "Please enter an email"
    // "email must contain '@'"
    validate_email($_POST["email"]);
   
    if (isset($_POST["terms"])) {
        $form_valid = true;
    } else {
        $terms_error = "You must accept the Terms of Service";
    }
}


?>

<form action="index.php" method="POST">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
            <small class="form-text text-danger"> <?php echo $user_error; ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email">
            <small class="form-text text-danger"> <?php echo $email_error; ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
        <small class="form-text text-danger"> <?php echo $message_error; ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms"> <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo $terms_error; ?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo htmlspecialchars($username); ?></p>
            <p><?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo htmlspecialchars($message); ?></p>
        </div>
    </div>
<?php
endif;
?>