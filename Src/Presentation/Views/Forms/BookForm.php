<?php
/**
 * @var $viewModel
 *
 **/

    echo '<form method="get" action = ' . $viewModel->getAction() . '>';
    ?>

    Title:<br>

    <input type="text" id = "title" name="title" ><br>

    Year:<br>
    <input type="text" id = "year" name="year" ><br>

    <br>
    <input class="addValBtn" type="submit" value="Save">
    <br><br>

    <?php
    echo '<span>' . $viewModel->getErrorMessage() . '<br></span>';
    echo '<input type="hidden" name="authorId" value="' . $viewModel->getAuthorId() . '">'; ?>
