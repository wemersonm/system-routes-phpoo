<?php $this->layout('master', ["title" => $title]) ?>
<?php foreach ($data['data'] as $user) : ?>
<ul class="list-group">
    <li class="list-group-item mt-1">
        <?php echo $user['id'].' - '.$user['first_name'].' '.$user['last_name']; ?>
    </li>
</ul>
<?php endforeach; ?>
<ul class="pagination mt-2" >
    <li class="page-item <?php echo $data['currentPage'] == 1? 'disabled': ''; ?>">
        <a class="page-link" href="/?page=<?php echo $data['currentPage'] - 1 ?>">Previous</a>
    </li>
    <?php for ($i = ($data['currentPage'] -5); $i <= ($data['currentPage'] +5); $i++) :
        if ($i > 0 && $i <= $data['totalPages']) : ?>
            <li class="page-item <?php echo $data['currentPage']==$i? 'active':''; ?> ">
                <a class="page-link" href="/?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>

    <?php endif; ?>
<?php endfor; ?>

<li class="page-item">
    <a class="page-link" href="/?page=<?php echo $data['currentPage']+ 1 ?>">Next</a>
</li>
</ul>
