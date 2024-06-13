<?php

include '../misc/auth.php';

function isActiveAdmin($page)
{
    $current_page = basename($_SERVER['REQUEST_URI'], ".php");
    return $current_page === $page ? 'active' : '';
}
?>

<div class="admin-menu">
    <ul>
        <li>
            <a href="/pages/admin.php" class="<?php echo isActiveAdmin('admin'); ?>">Korisnici</a>
        </li>
        <li>
            <a href="/pages/newsAdmin.php" class="<?php echo isActiveAdmin('newsAdmin'); ?>">Vijesti</a>
        </li>
        <li>
            <a href="/pages/galleryAdmin.php" class="<?php echo isActiveAdmin('galleryAdmin'); ?>">Galerija</a>
        </li>
    </ul>
</div>