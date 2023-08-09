document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("myModal");
    const closeModal = document.getElementById("closeModal");

    // Tampilkan modal saat halaman dimuat pertama kali
    modal.style.display = "flex";

    // Tutup modal saat tombol "close" diklik
    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Tutup modal saat mengklik di luar modal
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});