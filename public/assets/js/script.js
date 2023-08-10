
// // Mengubah epoch menjadi tanggal
// function convertEpochToDate(epoch) {
//   // Ubah dari milidetik ke detik
//   var date = new Date(epoch * 1000);
  
//   // Mendapatkan komponen tanggal
//   var year = date.getFullYear();
//   var month = ('0' + (date.getMonth() + 1)).slice(-2);
//   var day = ('0' + date.getDate()).slice(-2);
  
//   // Mendapatkan komponen waktu
//   var hours = ('0' + date.getHours()).slice(-2);
//   var minutes = ('0' + date.getMinutes()).slice(-2);
//   var seconds = ('0' + date.getSeconds()).slice(-2);
  
//   // Mengembalikan tanggal yang diformat
//   var formattedDate = day + '-' + month + '-' + year + ',' + hours + ':' + minutes + ':' + seconds;
//   return formattedDate;
// }

//     // Contoh penggunaan
//     var epochTime = 1688724017; // Epoch time yang ingin dikonversi
//     var convertedDate = convertEpochToDate(epochTime);
//     let text =  "Mohon segera melakukan pembayaran sesuai 'Total Bayar'";
//     document.getElementById("epoch").innerHTML='Mohon segera melakukan pembayaran sesuai "Total Bayar" ' +convertedDate;


 // Execute this code when the document is ready
 document.addEventListener('DOMContentLoaded', function() {
    // Find the modal element
    var modal = document.getElementById('exampleModalCenter');
    
    // Initialize the Bootstrap modal instance
    var bootstrapModal = new bootstrap.Modal(modal);
    
    // Show the modal
    bootstrapModal.show();
    
    // Close the modal when the Close button is clicked
    var closeButton = modal.querySelector('.modal-footer .btn-secondary');
    closeButton.addEventListener('click', function() {
      bootstrapModal.hide();
    });
  });

// produk.blade.php
