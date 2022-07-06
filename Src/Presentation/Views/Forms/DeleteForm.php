<?php
/**
 * @var $viewModel
 */
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/Src/Resources/styles.css"
</head>
<body>
<h2>Are you sure you want to delete?
</h2>

<?php
echo '<form method="get" action=' . $viewModel->getAction() . '>';
echo '<input type="submit" name="answer" value="Delete" class="deleteDialogBtn" ><br>';
echo '<input type="hidden" name="authorId" value="' . $viewModel->getAuthorId() . '">';
echo '<br>';
echo '<input type="submit" name="answer" value="Cancel" class="deleteDialogBtn" ><br>';
?>

