<?php
/**
 * @var $viewModel
 */

include __DIR__ . '/CssInclusion.php';
echo '<h2>Edit Book</h2>';
include __DIR__ . '/Forms/BookForm.php';
echo '<input type="hidden" name="bookId" value="' . $viewModel->getBookId() . '">';
echo '
<script>
    document.getElementById("title").placeholder= "' . $viewModel->getPlaceHolderFirst() . '";
</script>';
echo '
<script>
    document.getElementById("year").placeholder= "' . $viewModel->getPlaceHolderSecond() . '";
</script>';
?>

</form>
</body>
</html>