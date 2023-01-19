<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo "Profil " . $_SESSION['username'] ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../img/profile.png" alt="" class="img-fluid mb-3" width="100">
                <p><b><?php echo strtoupper($_SESSION['nama']);?></b></p>
                <span class="badge rounded-pill bg-danger mt-0" style="font-size: 16px;">
                    <a href="../logout.php" style="color: white; font-size: 13px;"><i class="fa-sharp fa-solid fa-power-off"></i>&nbsp; Logout</a>
                </span>
            </div>
        </div>
    </div>
</div>