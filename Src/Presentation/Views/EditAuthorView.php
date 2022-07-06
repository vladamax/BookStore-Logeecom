<?php
/**
 * @var $viewModel
 */


include __DIR__ . '/CssInclusion.php';
echo '<h2>Edit Book</h2>';
include __DIR__ . '/Forms/AuthorForm.php';
echo '<input type="hidden" name="authorId" value="' . $viewModel->getAuthorId() . '">';
echo '
<script>
    document.getElementById("firstName").placeholder= "' . $viewModel->getPlaceHolderFirst() . '";
</script>';
echo '
<script>
    document.getElementById("lastName").placeholder= "' . $viewModel->getPlaceHolderSecond() . '";
</script>';
?>

</form>

</body>
</html>