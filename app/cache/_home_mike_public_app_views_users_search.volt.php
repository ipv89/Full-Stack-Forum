<?php $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo \Phalcon\Tag::linkTo(array("users/index", "Go Back")); ?>
        </td>
        <td align="right">
            <?php echo \Phalcon\Tag::linkTo(array("users/new", "Create users")); ?>
        </td>
    <tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>User</th>
            <th>Full Of Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Date Of Joined</th>
            <th>Username</th>
        </tr>
    </thead>
    <tbody>


    <?php




        if(isset($page->items)){
            foreach($page->items as $users){ ?>
        <tr>
            <td><?php echo $users->user_id ?></td>
            <td><?php echo $users->full_name ?></td>
            <td><?php echo $users->email ?></td>
            <td><?php echo $users->password ?></td>
            <td><?php echo $users->date_joined ?></td>
            <td><?php echo $users->username ?></td>
            <td><?php echo \Phalcon\Tag::linkTo(array("users/edit/".$users->user_id, "Edit")); ?></td>
            <td><?php echo \Phalcon\Tag::linkTo(array("users/delete/".$users->user_id, "Delete")); ?></td>
        </tr>
    <?php }
        } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="6" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo \Phalcon\Tag::linkTo("users/search", "First") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("users/search?page=".$page->before, "Previous") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("users/search?page=".$page->next, "Next") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("users/search?page=".$page->last, "Last") ?></td>
                        <td><?php echo $page->current, "/", $page->total_pages ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    <tbody>
</table>