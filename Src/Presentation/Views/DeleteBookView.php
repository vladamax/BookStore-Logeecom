<?php
/**
 * @var $viewModel
 */
include __DIR__ . '/Forms/DeleteForm.php';
echo '<input type="hidden" name="bookId" value="' . $viewModel->getBookId() . '">';
?>

</form>
</body>
</html>
