<footer>
    <p>&copy; 2024 - University of Puerto Rico at Arecibo</p>
    <?php if (Auth::check()) { ?>
        <p> <i class="las la-user"></i> Logged in as: <?= Auth::user()->name ?> (<?= Auth::user()->username ?>) </p>
    <?php } ?>
</footer>