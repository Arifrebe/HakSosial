<?php 
    $title = "Beranda";

    $carousel = [
        ["image" => "https://placehold.co/500x200?text=Promo+Spesial", "alt" => "Promo Spesial"],
        ["image" => "https://placehold.co/500x200?text=Akun+Rank+Tinggi", "alt" => "Akun Rank Tinggi"],
        ["image" => "https://placehold.co/500x200?text=Diskon+Terbatas", "alt" => "Diskon Terbatas"]
    ];
    $quicActionMenu = [
        [
            "icon"  => "images/diamond.png", 
            "alt"   => "Top up diamond",
            "text"  => "Top up",
        ],
        [
            "icon"  => "images/joystick-with-hand.png", 
            "alt"   => "Beli akun",
            "text"  => "Beli akun",
        ],
    ];

    include "layout/topper.view.php";
?>
<div id="carouselExampleInterval" class="carousel slide mb-3" data-bs-ride="carousel">
    <div class="carousel-inner" style="max-height:500px; overflow:hidden;">
        <?php foreach ($carousel as $index => $item) : ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-bs-interval="3000">
                <img src="<?= $item['image']; ?>" class="d-block w-100" alt="<?= $item['alt']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="container-fluid">
    <div class="row row-cols-auto justify-content-center gap-3 overflow-auto flex-nowrap">
        <?php foreach ($quicActionMenu as $act) : ?>
            <div class="col text-center">
                <div class="rounded-circle bg-primary shadow d-flex align-items-center justify-content-center actMenu">
                    <img src="<?= asset($act['icon']) ?>" style="width: 60%;" alt="<?= $act['alt'] ?>" srcset="">
                </div>
                <p class="mt-2 text-nowrap"><?= $act['text'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include "layout/bottom.view.php"; ?>
