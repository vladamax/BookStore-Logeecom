<?php
/**
 * @var BookListViewModel $viewModel
 */

use BookStore\Presentation\ViewModels\BookListViewModel;

include 'CssInclusion.php';
?>

<table class="table1">
    <thead>
    <tr>
        <th>Book</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach($viewModel->getBooks() as $book)
    {
        echo "<tr>";
        echo '<td class="titleTd"> ' . $viewModel->getLongTitle($book) . '</td>';
        echo '<form  action="' . $viewModel->getActionDelete() . '" method="get">';
        echo '<input type="hidden" name="bookId" value="' . $book->getId() . '">';
        echo '<input type="hidden" name="authorId" value="' . $book->getAuthorId() . '">';
        echo "<td><input width='20' class='delBtn' type='image' src='/Src/Resources/deleteSign.jpg' name='id' value='" . $book->getId() . "'></input></form></td>";
        echo '<form  action="' . $viewModel->getActionEdit() . '" method="get">';
        echo '<input type="hidden" name="bookId" value="' . $book->getId() . '">';
        echo '<input type="hidden" name="authorId" value="' . $book->getAuthorId() . '">';
        echo "<td><input width='20' class='delBtn' type='image' src='/Src/Resources/editSign.jpg' name='id' value='" . $book->getId() . "'></input></form></td>";
    }
    ?>
    <tr>
        <td class="lastTableRow">
            <form action="<?php echo $viewModel->getActionCreate() ?>" method="get">
                <input class="addBtn" name="id" type=image title="Add a book" height="30"  src="/Src/Resources/plus_Sign.png">
                <?php echo '<input type="hidden" name="authorId" value="' . $_GET['authorId'] . '">'; ?>
            </form>
        </td>
    </tr>
    </tbody>
</table>



</body>
</html>
