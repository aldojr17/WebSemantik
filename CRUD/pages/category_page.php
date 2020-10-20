<form action="" method="post">
    <div class="form-group">
        <label for="catId">Name</label>
        <input type="text" class="form-control" id="catId" name="txtName">
    </div>
    <input type="submit" name="btnSubmit" class="btn btn-default">
</form>
<br>
<table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($categories as $category){
            echo '<tr>';
            echo '<td>'. $category->id .'</td>';
            echo '<td>'. $category->name .'</td>';
            echo '<td><button onclick="updateValue(\''.$category->id.'\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></button><button onclick="deleteValue(\''.$category->id.'\')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></button></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
