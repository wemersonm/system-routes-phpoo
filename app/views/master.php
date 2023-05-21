<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->e($title) ?></title>
</head>

<body>
    <h1>MASTER</h1>
    <header>
        <?php $this->insert('partials/header') ?>
    </header>

    <div class="container">
        <?php echo $this->section('content') ?>
    </div>
</body>

</html>