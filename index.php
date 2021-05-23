<?php
require_once 'database/connection.php';
$task = '';

$select = "SELECT id,todo,done FROM todos ORDER BY id DESC LIMIT 5 ";
$stmt = $conn->prepare($select);
$stmt->execute();
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add'])) {
	if (!empty($_POST['task'])) {
		$task = trim($_POST['task']);

		$insert = "INSERT INTO todos (todo) VALUES(:todo)";
		$stmt = $conn->prepare($insert);
		$stmt->execute([':todo' => $task]);
		$task = '';
		header('location:index.php');
	}
}

?>

<?php include_once 'templates/header.php' ?>
<div class="container mt-5 p-5">
    <div class="card mx-auto">
        <div class="total-todos text-center p-2">
            <?php echo 'Total Todos: ' . count($todos); ?>
        </div>
        <div class="card-body">
            <h5 class="mb-4">Todo List: <span><?php echo date('d-M-Y'); ?></span> </h5>
            <form action="index.php" method="POST">
                <div class="input-group mb-3">
                    <input type="text" name="task" id="task" class="form-control shadow-none"
                        placeholder="what do you need to do?" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit" name="add">Add Todo</button>
                    </div>
                </div>
            </form>
        </div>

        <?php if (count($todos) > 0) : ?>

        <ul>
            <?php foreach ($todos as $todo) : ?>

            <li><span class="lead <?php echo $todo['done'] ? ' done' : ''; ?>"><?php echo $todo['todo']; ?></span>
                <?php if (!$todo['done']) : ?>
                <span><a class="btn-sm " href="done.php?task=done&id=<?php echo $todo['id']; ?>">X</a></span>
                <?php endif; ?>
                <?php if ($todo['done']) : ?>
                <span><a onclick="return confirm('Are you sure you want to delete?')"
                        href="delete.php?id=<?php echo $todo['id']; ?>">
                        <img src="public/images/delete.png" title="delete todo" alt="delete-icon">
                    </a></span>

                <?php endif; ?>
                <hr class="mr-3">

            </li>
            <?php endforeach; ?>
        </ul>
        <?php else : ?>
        <p class="text-danger text-center lead">No Available todos Today -(</p>
        <?php endif; ?>
    </div>

</div>

<?php include_once 'templates/footer.php' ?>