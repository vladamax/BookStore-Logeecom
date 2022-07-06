<?php
/**
 * @var AuthorListViewModel $viewModel
 */

use BookStore\Presentation\ViewModels\AuthorListViewModel;

include 'CssInclusion.php';
?>

<table class="table1">
    <thead>
    <tr>
        <th>Name</th>
        <th>Books</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach($viewModel->getAuthors() as $author)
    {
        echo "<tr>";
        echo '<form  action="' . $viewModel->getActionBooks() . '" method="get">';
        echo '<td class="titleTd imgAvat"> <img width="20" class="imgAvat" src="/Src/Resources/avatarSign.png"/><button
             style="alignment: left"   name="authorId" value='. $author->getId() .' >' .  $viewModel->getLongTitle($author) . '</button></form></td>';

        echo "<td>" . $author->getNumberOfBooks() . "</td>";
        echo '<form  action="' . $viewModel->getActionDelete() . '" method="get">';
        echo '<input type="hidden" name="authorId" value="' . $author->getId() . '">';
        echo "<td><input width='20' class='delBtn' type='image' src='/Src/Resources/deleteSign.jpg' name='id' value='" . $author->getId() . "'></input></form></td>";
        echo '<form  action="' . $viewModel->getActionEdit() . '" method="get">';
        echo '<input type="hidden" name="authorId" value="' . $author->getId() . '">';
        echo "<td><input width='20' class='delBtn' type='image' src='/Src/Resources/editSign.jpg' name='id' value='" . $author->getId() . "'></input></form></td>";
    }
    ?>
    <tr>
        <td class="lastTableRow">
            <form action="<?php echo $viewModel->getActionCreate();?>" method="post">
                <input  type=image title="Add an author" height="30" value="" src="/Src/Resources/plus_Sign.png">
            </form>
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
