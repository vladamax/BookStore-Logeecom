<?php
/**
 * @var $viewModel
 *
 **/

echo '<form method="get" action = ' . $viewModel->getAction() . '>';
?>

First Name:<br>

<input type="text" id = "firstName" name="firstName" ><br>

Last Name:<br>
<input type="text" id = "lastName" name="lastName" ><br>

<br>
<input class="addValBtn" type="submit" value="Save">
<br><br>

<?php
echo '<span>' . $viewModel->getErrorMessage() . '<br></span>';
