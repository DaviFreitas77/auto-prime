<?php
include '../src/data/carrosel.php';    
function renderCarrosel($carousel) {
?>
<div class="swiper h-full">
    <div class="swiper-wrapper">
        <?php foreach ($carousel as $img): ?>
            <div class="swiper-slide">
                <img src="<?= $img['src'] ?>" alt="<?= $img['alt'] ?>" class="w-full h-full object-cover">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
<?php
}
?>
